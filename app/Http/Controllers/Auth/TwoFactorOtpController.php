<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoginOtpNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TwoFactorOtpController extends Controller
{
    public function show(Request $request):View|RedirectResponse{
        if(! $request->session()->has('two_factor.user_id')){
            return redirect()->route('login');
        }
        return view('auth.two-factor-challenge');
    }

    public function verify(Request $request):RedirectResponse
    {
        $request->validate([
            'code' =>['required','digits:'.config('two_factor.length')],
        ]);
        $user = $this->pendingUser($request);
        $key = $this->throttlekey($request);

        if(RateLimiter::tooManyAttempts($key,5)){
            throw ValidateException::withMessages([
                'code' => 'Demasiados intentos. Intenta nuevamente en '.RateLimiter::availableIn($key).' segundos.',
            ]);
        }

        if(
            !$user ||
            !$user->two_factor_code ||
            !$user->two_factor_expires_at ||
            now()->greaterThan($user->two_factor_expires_at) ||
            ! Hash::check($request->input('code'),$user->two_factor_code)
        ){
            RateLimiter::hit($key, 60);
            throw ValidationException::withMessages([
                'code' =>'El codigo OTP no es valido o ya vencio.',
            ]);
        }

        RateLimiter::clear($key);

        $remember = $request->session()->pull('twofactor.remember',false);

        $request->session()->forget('two_facor.iser_id');

        $user->forceFill([
            'two_factor_code' => null,
            'two_factor_expires_at' =>null,
        ])->save();

        Auth::login($user,$remember);

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));

    }
    public function resent(Request $request): RedirectResponse{
        $user = $this->pendingUser($request);
        if(!$user){
            return redirect()->route('login');
        }

        $code = $this->generateCode();
        $user->forceFill([
            'two_factor_code' => Hash::make($code),
            'two_factor_expires_at' => now()->addMinutes(config('two_factor.expires_minute')),
        ])->save();
        return back()->with('status','Te enviamos un nuevo codigo OTP.');
    }
    private function generateCode():string{
        $max =(10 ** config('two_factor.length'))-1;
        return str_pad((string) reandom_int(0,$max),config('two_factor.length'),'0',STR_PAD_LEFT);
    }
    private function throttlekey(Request $request):string{
        return 'two-factor-otp|'.$request->ip().'|'.$request->session()->get('two_factor.user_id');
    }
    private function pendingUser(Request $request): ?User
    {
        $userId = $request->session()->get('two_factor.user_id');
        return $userId ? User::find($userId) : null;
    }
}
