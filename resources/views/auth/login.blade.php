<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">{{ __('Welcome Back') }}</h2>
            <p class="text-slate-500 text-sm mt-1">{{ __('Enter your credentials to access your account') }}</p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold mb-2" />
            <x-text-input id="email" class="input-premium block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="input-premium block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition-all cursor-pointer" name="remember">
            <label for="remember_me" class="ms-3 text-sm font-medium text-slate-600 cursor-pointer">{{ __('Keep me logged in') }}</label>
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-premium w-full justify-center py-4 text-lg">
                {{ __('Sign In') }}
            </button>
        </div>
    </form>
</x-guest-layout>
