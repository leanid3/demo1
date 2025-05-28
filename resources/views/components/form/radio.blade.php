@props([
    'name',
    'label',
    'options' => [],
    'value' => '',
    'required' => false,
    'disabled' => false,
    'class' => '',
    'error' => null
])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <div class="form-check-group">
        @foreach($options as $optionValue => $optionLabel)
            <div class="form-check">
                <input 
                    class="form-check-input @error($name) is-invalid @enderror {{ $class }}"
                    type="radio"
                    name="{{ $name }}"
                    id="{{ $name }}_{{ $optionValue }}"
                    value="{{ $optionValue }}"
                    {{ old($name, $value) == $optionValue ? 'checked' : '' }}
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    {{ $attributes }}
                >
                <label class="form-check-label" for="{{ $name }}_{{ $optionValue }}">
                    {{ $optionLabel }}
                </label>
            </div>
        @endforeach
    </div>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 