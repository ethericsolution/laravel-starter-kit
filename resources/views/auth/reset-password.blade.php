<x-layouts.guest>
    <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-md lg:p-8">
        <div class="flex items-center gap-3">
            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8" alt="brand-logo" />
            <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
        </div>
        <div>
            <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Reset Password</h3>
            <p class="text-base-content/80">Please enter your current password and choose a new password to update your
                account security.</p>
        </div>
        <div class="space-y-4">
            <form method="POST" action="{{ route('password.update') }}" class="mb-4 space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">


                {{-- Email --}}
                <x-form.input label="Email Address" name="email" type="email" :value="$request->email" readonly required />

                {{-- Password --}}
                <x-form.password label="Password" name="password" required />

                {{-- Confirm Password --}}
                <x-form.password label="Confirm Password" name="password_confirmation" required />

                <button class="btn btn-lg btn-primary btn-gradient btn-block">Set new password</button>
            </form>

            <div class="group flex items-center justify-center gap-2">
                <span
                    class="icon-[tabler--chevron-left] text-primary size-5 shrink-0 transition-transform group-hover:-translate-x-1 rtl:rotate-180"></span>
                <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">Back to login</a>
            </div>
        </div>
    </div>
</x-layouts.guest>
