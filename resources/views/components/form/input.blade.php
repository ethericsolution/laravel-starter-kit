@props(['label', 'name', 'id' => null, 'type' => 'text', 'value' => null, 'required' => false])

@php
    $inputId = $id ?? $name;
@endphp

<div class="space-y-1">
    <label for="{{ $inputId }}" class="label-text {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>

    <input
        {{ $attributes->merge([
            'class' => 'input ' . ($errors->has($name) ? 'is-invalid' : ''),
        ]) }}
        type="{{ $type }}" id="{{ $inputId }}" name="{{ $name }}" value="{{ old($name, $value) }}" />

    @error($name)
        <span class="helper-text">{{ $message }}</span>
    @enderror
</div>
