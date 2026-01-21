<x-layouts.guest>
    <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:min-w-md lg:p-8">
        <div class="flex items-center gap-3">
            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8" alt="brand-logo" />
            <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
        </div>
        <div>
            <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Sign in to {{ config('app.name') }}</h3>
            <p class="text-base-content/80">Ship Faster and Focus on Growth.</p>
        </div>
        <div class="space-y-4">
            <form method="POST" action="{{ route('login') }}" class="mb-4 space-y-4">
                @csrf

                {{-- Email --}}
                <x-form.input label="Email Address" name="email" type="email" required autofocus />

                {{-- Password --}}
                <x-form.password label="Password" name="password" required />

                <div class="flex items-center justify-between gap-y-2">
                    <x-form.checkbox name="remember" id="rememberMe" label="Remember Me" />

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="link link-animated link-primary font-normal">Forgot Your Password?</a>
                    @endif
                </div>

                <button class="btn btn-lg btn-primary btn-gradient btn-block">Sign in to
                    {{ config('app.name') }}</button>
            </form>

            @if (Route::has('register'))
                <p class="text-base-content/80 mb-4 text-center">
                    Don't have an account? <a class="link link-animated link-primary font-normal"
                        href="{{ route('register') }}">Register</a>
                </p>
            @endif
        </div>
    </div>
</x-layouts.guest>
