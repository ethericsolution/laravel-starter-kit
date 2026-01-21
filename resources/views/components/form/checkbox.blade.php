@props(['label', 'name', 'id' => null, 'checked' => false, 'value' => 1])

@php
    $inputId = $id ?? $name;
@endphp

<div class="flex items-center gap-2">
    <input type="checkbox" class="checkbox checkbox-primary" id="{{ $inputId }}" name="{{ $name }}"
        value="{{ $value }}" @checked(old($name, $checked)) {{ $attributes }} />

    <label class="label-text text-base-content/80 p-0 text-base" for="{{ $inputId }}">
        {{ $label }}
    </label>
</div>
