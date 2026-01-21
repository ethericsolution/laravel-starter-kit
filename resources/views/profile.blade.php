<x-layouts.app>
    <div class="max-w-7xl mx-auto space-y-6">
        <h1 class="text-base-content text-3xl font-semibold">Profile</h1>

        <form method="POST" action="{{ route('user-profile-information.update') }}">
            @csrf
            @method('PUT')
            <div class="card">

                <div class="card-body">
                    <div class="text-base-content text-lg font-medium">Profile</div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <x-form.input label="Name" name="name" :value="Auth::user()->name" required />

                        {{-- Email --}}
                        <x-form.input label="Email Address" name="email" type="email" :value="Auth::user()->email" required />

                        <div class="col-span-full">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if (auth()->user()->two_factor_secret)
            <div class="card">
                <div class="card-body">
                    <div class="text-base-content text-lg font-medium mb-4">2 Factor Authentication</div>
                    <div class="flex col">
                        {{-- 2FA Enabled --}}
                        <div class="mb-4">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            <p class="text-sm mt-2">Scan with Google Authenticator or similar app.</p>
                        </div>

                        {{-- Recovery Codes --}}
                        @if (auth()->user()->two_factor_recovery_codes)
                            <div>
                                <label>Recovery Codes (one-time use):</label>
                                <ul>
                                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                        <li>{{ $code }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    {{-- Confirm 2FA --}}
                    @if (!auth()->user()->two_factor_confirmed_at)
                        <form method="POST" action="{{ route('two-factor.confirm') }}" class="mb-4">
                            @csrf
                            <input type="text" name="code" placeholder="Enter 6-digit code" required
                                class="border p-2">
                            @error('code')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Confirm</button>
                        </form>
                    @endif

                    {{-- Disable 2FA --}}
                    <form method="POST" action="{{ route('two-factor.disable') }}">
                        @csrf
                        @method('DELETE')
                        <confirm-password-modal> {{-- Use Fortify's ConfirmPassword or custom modal --}}
                            <button type="submit" class="btn btn-error">Disable 2FA</button>
                        </confirm-password-modal>
                    </form>
                </div>
            </div>
        @else
            {{-- Enable 2FA --}}
            <form method="POST" action="{{ route('two-factor.enable') }}">
                @csrf
                <button type="submit" class="btn btn-success">Enable 2FA</button>
            </form>
        @endif

        <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <h5 class="text-base-content text-lg font-medium">Change Password</h5>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Current Password --}}
                        <x-form.password label="Current Password" name="current_password" required />

                        {{-- New Password --}}
                        <x-form.password label="New Password" name="password" required />

                        {{-- Confirm New Password --}}
                        <x-form.password label="Confirm New Password" name="password_confirmation" required />

                        <div class="col-span-full">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
