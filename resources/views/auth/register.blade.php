<x-layouts.guest>
    <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:min-w-md lg:p-8">
        <div class="flex items-center gap-3">
            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8" alt="brand-logo" />
            <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
        </div>
        <div>
            <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Sign Up to {{ config('app.name') }}</h3>
            <p class="text-base-content/80">Ship Faster and Focus on Growth.</p>
        </div>
        <div class="space-y-4">
            <form class="mb-4 space-y-4" method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <x-form.input label="Name" name="name" required autofocus />

                {{-- Email --}}
                <x-form.input label="Email Address" name="email" type="email" required />

                {{-- Password --}}
                <x-form.password label="Password" name="password" required />

                {{-- Confirm Password --}}
                <x-form.password label="Confirm Password" name="password_confirmation" required />

                <button class="btn btn-lg btn-primary btn-gradient btn-block">Sign Up to
                    {{ config('app.name') }}</button>
            </form>

            <p class="text-base-content/80 mb-4 text-center">
                Already have an account?
                <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">Sign in instead</a>
            </p>
        </div>
    </div>
</x-layouts.guest>
