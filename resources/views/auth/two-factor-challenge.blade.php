<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('two-factor.verify') }}">
        @csrf

        <div>
            <x-input-label for="code" value="Codigo OTP" />
            <x-text-input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="{{ config('two_factor.length') }}" class="mt-1 block w-full" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('code')" />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900" form="resend-otp-form">
                Reenviar codigo
            </button>

            <x-primary-button>
                Verificar
            </x-primary-button>
        </div>
    </form>

    <form id="resend-otp-form" method="POST" action="{{ route('two-factor.resend') }}" class="hidden">
        @csrf
    </form>
</x-guest-layout>
