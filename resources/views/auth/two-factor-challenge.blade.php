<x-layouts.guest>
    <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-md lg:p-8">
        <div class="flex items-center gap-3">
            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8" alt="brand-logo" />
            <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
        </div>
        <div>
            <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Two Factor Authentication</h3>
            <p class="text-base-content/80">Please confirm access to your account by entering the code provided by your
                authenticator application</p>
        </div>
        <div class="space-y-4">
            @session('status')
                <p class="text-success">
                    {{ $value }}
                </p>
            @endsession
            <form method="POST" action="{{ route('two-factor.login') }}" class="mb-4 space-y-4">
                @csrf

                {{-- Code --}}
                <x-form.input label="Code" name="code" required autofocus />

                <button class="btn btn-lg btn-primary btn-gradient btn-block">{{ __('Confirm') }}</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf

                <div class="group flex items-center justify-center gap-2">
                    <span
                        class="icon-[tabler--chevron-left] text-primary size-5 shrink-0 transition-transform group-hover:-translate-x-1 rtl:rotate-180"></span>
                    <button type="submit" class="link link-animated link-primary font-normal">Back to login</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
