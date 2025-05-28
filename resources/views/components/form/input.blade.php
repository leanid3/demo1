@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
    'error' => null
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input 
        type="{{ $type }}"
        class="form-control @error($name) is-invalid @enderror {{ $class }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        {{ $attributes }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 