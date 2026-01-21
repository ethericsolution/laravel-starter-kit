<x-layouts.guest>
    <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-md lg:p-8">
        <div class="flex items-center gap-3">
            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8" alt="brand-logo" />
            <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
        </div>
        <div>
            <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Confirm Password</h3>
            <p class="text-base-content/80">This is a secure area of the application. Please confirm your
                password before continuing.</p>
        </div>
        <div class="space-y-4">
            @session('status')
                <p class="text-success">
                    {{ $value }}
                </p>
            @endsession
            <form method="POST" action="{{ route('password.confirm') }}" class="mb-4 space-y-4">
                @csrf
                {{-- Password --}}
                <x-form.password label="Password" name="password" required />

                <button class="btn btn-lg btn-primary btn-gradient btn-block">Confirm</button>
            </form>
        </div>
    </div>
</x-layouts.guest>
