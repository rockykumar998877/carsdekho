<div class="{{ $wrapperClass ?? 'col-md-6' }}">
    @if($label)
        <label class="required">{{ $label }}</label>
    @endif
    <div>
        @foreach($options as $optionLabel)

            <div class="form-check form-check-inline">
                <input 
                    class="form-check-input" 
                    type="radio" 
                    id="{{ $name . '_' . $optionLabel->value }}" 
                    value="{{ $optionLabel->value  }}" 
                    wire:model.defer="{{ $model }}"
                >
                <label class="form-check-label" for="{{ $name . '_' . $optionLabel->value }}">
                    {{ ucfirst($optionLabel->name) }}
                </label>
            </div>
        @endforeach
    </div>
    @error($model)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
