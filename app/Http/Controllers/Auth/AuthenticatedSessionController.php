<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Notifications\LoginOtpNotification;
use Illuminate\Support\Facades\Hash;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = $request->user();

        if(config('two_factor.enabled') && $user->two_factor_enabled){
            $code = $this->generateOtpCode();
            $user->forceFill([
                'two_factor_code' => Hash::make($code),
                'two_factor_expires_at' => now()->addMinutes(config('two_factor.expires_minute')),
            ])->save();

            $user->notify(new LoginOtpNotification($code));

            Auth::guard('web')->logout();

            $request->session()->put('two_factor.user_id',$user->id);
            $request->session()->put('two_factor.remember',$request->boolean('remember'));
            return redirect()->route('two-factor.challenge')->with('status','Te enviamos un codigo OTP a tu correo.');
        }
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    private function generateOtpCode():string{
        $max =(10 ** config('two_factor.length'))-1;
        return str_pad((string) random_int(0,$max),config('two_factor.length'),'0',STR_PAD_LEFT);
    }
}
