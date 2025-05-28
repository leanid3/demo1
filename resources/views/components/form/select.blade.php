@props([
    'name',
    'label',
    'options' => [],
    'value' => '',
    'empty_option' => null,
    'required' => false,
    'disabled' => false,
    'class' => '',
    'error' => null
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select 
        class="form-select @error($name) is-invalid @enderror {{ $class }}"
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes }}
    >
        @if($empty_option)
            <option value="">{{ $empty_option }}</option>
        @endif
        
        @foreach($options as $optionValue => $optionLabel)
            <option 
                value="{{ $optionValue }}" 
                {{ old($name, $value) == $optionValue ? 'selected' : '' }}
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 