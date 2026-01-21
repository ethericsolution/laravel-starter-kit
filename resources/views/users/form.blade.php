<x-layouts.app>
    @php
        $breadcrumbLinks = [
            ['url' => route('dashboard'), 'text' => 'Dashboard'],
            ['url' => route('users.index'), 'text' => 'Users'],
            ['text' => $user->id ? 'Edit' : 'Create'],
        ];

        $title = $user->id ? "Edit {$user->name}" : 'Create User';
    @endphp

    <div class="max-w-7xl mx-auto space-y-6">
        <x-partials.breadcrumb :links="$breadcrumbLinks" :title="$title" :goBackAction="route('users.index')" />

        <x-partials.validation-errors />

        <form method="post" action="{{ $user->id ? route('users.update', $user) : route('users.store') }}">
            @csrf
            @isset($user->id)
                @method('put')
            @endisset

            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4 py-2">

                        {{-- Name --}}
                        <x-form.input label="Name" name="name" :value="$user->name" required autofocus />

                        {{-- Email --}}
                        <x-form.input label="Email Address" name="email" type="email" :value="$user->email" required />

                        {{-- Password --}}
                        <x-form.password label="New Password" name="password" :required="!$user->id" />

                        {{-- Confirm Password --}}
                        <x-form.password label="Confirm Password" name="password_confirmation" :required="!$user->id" />
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-soft">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
