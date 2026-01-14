<div class="{{ $divClass ?? '' }}">
    <label for="{{ $id }}" class="form-label {{ $labelClass }}">{{ $label }}</label>
@php
    // Determine whether to add wire:model.defer (if caller didn't pass any wire:model.* attribute)
    $shouldBindWire = ! ($attributes->has('wire:model') || $attributes->has('wire:model.defer') || $attributes->has('wire:model.lazy'));

    // Ensure $value is defined so old() won't blow up
    $value = isset($value) ? $value : null;

    // Prepare a safe class string by combining component's class with any class passed in attributes
    $attrClass = $attributes->get('class') ?? '';
    $finalClass = trim('form-select ' . ($class ?? '') . ($errors->has($errorField ?? $name) ? ' is-invalid' : '') . ' ' . $attrClass);

    // Remove attributes that have array values (these will break __toString when rendering attributes)
    $rawAttributes = method_exists($attributes, 'getAttributes') ? $attributes->getAttributes() : $attributes->toArray();
    $safeKeys = collect($rawAttributes)->reject(fn($v) => is_array($v))->keys()->toArray();
    $safeAttributes = $attributes->only($safeKeys);
@endphp
<select id="{{ $id }}" name="{{ $name }}" class="{{ $finalClass }}" {{ $safeAttributes }} @if($shouldBindWire) wire:model.defer="{{ $name }}" @endif>
        <option value="" {{ old($name, $value) === null || old($name, $value) === '' ? 'selected' : '' }}>
            {{ $placeholder ?? __('labels.select') }}
        </option>
        @foreach ($options as $option)
            <option value="{{ $option['id'] }}" {{ old($name, $value) == $option['id'] ? 'selected' : '' }}>
                {{ $option['label'] }}
            </option>
        @endforeach
    </select>
    @error($errorField ?? $name)
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
</div>
