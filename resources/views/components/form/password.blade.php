@props(['label', 'name' => 'password', 'id' => null, 'required' => false])

@php
    $inputId = $id ?? $name;
@endphp

<div class="space-y-1">
    <label class="label-text {{ $required ? 'required' : '' }}" for="{{ $inputId }}">
        {{ $label }}
    </label>

    <div class="input @error($name) is-invalid @enderror">
        <input id="{{ $inputId }}" type="password" name="{{ $name }}" autocomplete="new-password"
            {{ $attributes }} />

        <button type="button" data-toggle-password='{ "target": "#{{ $inputId }}" }' class="block cursor-pointer"
            aria-label="Toggle password visibility">
            <span class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
            <span class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
        </button>
    </div>

    @error($name)
        <span class="helper-text">{{ $message }}</span>
    @enderror
</div>
