@extends('frontend.layouts.app')

@section('content')
<div class="booking-page">
    <section class="booking-section">
        <div class="container">
            <div class="booking-header">
                <h1 class="page-title">Book Your <span class="gradient-text">Dream Car</span></h1>
                <p class="page-subtitle">Fill out the form below and we'll get back to you shortly</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="booking-form-container">
                <form action="{{ route('booking.store') }}" method="POST" class="booking-form">
                    @csrf

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="customer_name" class="form-label">Full Name <span class="required">*</span></label>
                            <input 
                                type="text" 
                                id="customer_name" 
                                name="customer_name" 
                                class="form-input @error('customer_name') error @enderror" 
                                value="{{ old('customer_name') }}"
                                placeholder="Enter your full name"
                                required
                            >
                            @error('customer_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_phone" class="form-label">Phone Number <span class="required">*</span></label>
                            <input 
                                type="tel" 
                                id="customer_phone" 
                                name="customer_phone" 
                                class="form-input @error('customer_phone') error @enderror" 
                                value="{{ old('customer_phone') }}"
                                placeholder="+1 (555) 123-4567"
                                required
                            >
                            @error('customer_phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_email" class="form-label">Email Address <span class="required">*</span></label>
                            <input 
                                type="email" 
                                id="customer_email" 
                                name="customer_email" 
                                class="form-input @error('customer_email') error @enderror" 
                                value="{{ old('customer_email') }}"
                                placeholder="your@email.com"
                                required
                            >
                            @error('customer_email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Car Categories <span class="required">*</span></label>
                            <div class="category-checkbox-grid">
                                @foreach($categories as $category)
                                    <div class="form-check custom-checkbox">
                                        <input 
                                            class="form-check-input category-checkbox" 
                                            type="checkbox" 
                                            name="category_ids[]" 
                                            value="{{ $category->id }}" 
                                            id="category_{{ $category->id }}"
                                            {{ (is_array(old('category_ids')) && in_array($category->id, old('category_ids'))) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="category_{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('category_ids')
                                <span class="error-message d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="car_id" class="form-label">Select Car (Optional)</label>
                            <select 
                                id="car_id" 
                                name="car_id" 
                                class="form-select @error('car_id') error @enderror"
                                disabled
                            >
                                <option value="">First select a category</option>
                            </select>
                            @error('car_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input 
                                type="date" 
                                id="start_date" 
                                name="start_date" 
                                class="form-input @error('start_date') error @enderror" 
                                value="{{ old('start_date') }}"
                                min="{{ date('Y-m-d') }}"
                            >
                            @error('start_date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="form-label">End Date</label>
                            <input 
                                type="date" 
                                id="end_date" 
                                name="end_date" 
                                class="form-input @error('end_date') error @enderror" 
                                value="{{ old('end_date') }}"
                                min="{{ date('Y-m-d') }}"
                            >
                            @error('end_date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-group-full">
                            <label for="customer_address" class="form-label">Address <span class="required">*</span></label>
                            <textarea 
                                id="customer_address" 
                                name="customer_address" 
                                rows="3"
                                class="form-textarea @error('customer_address') error @enderror" 
                                placeholder="Enter your complete address"
                                required
                            >{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-large">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Submit Booking
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-secondary btn-large">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    .category-checkbox-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
    }
    .custom-checkbox {
        padding: 10px;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .custom-checkbox:hover {
        border-color: #3b82f6;
        background-color: #f8fafc;
    }
    .form-check-input:checked + .form-check-label {
        font-weight: 600;
        color: #3b82f6;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const carSelect = document.getElementById('car_id');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    // Handle category change
    function updateCars() {
        const selectedCategories = Array.from(categoryCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        
        if (selectedCategories.length === 0) {
            carSelect.disabled = true;
            carSelect.innerHTML = '<option value="">First select a category</option>';
            return;
        }

        // Fetch cars for selected categories
        const categoryQuery = selectedCategories.join(',');
        fetch(`{{ route('get.cars') }}?category_id=${categoryQuery}`)
            .then(response => response.json())
            .then(cars => {
                carSelect.disabled = false;
                carSelect.innerHTML = '<option value="">Select a car (Optional)</option>';
                
                cars.forEach(car => {
                    const option = document.createElement('option');
                    option.value = car.id;
                    option.textContent = `${car.name} - ${car.model} ($${car.price_per_day}/day)`;
                    carSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching cars:', error);
                carSelect.innerHTML = '<option value="">Error loading cars</option>';
            });
    }

    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCars);
    });

    // Set minimum end date based on start date
    startDateInput.addEventListener('change', function() {
        const startDate = new Date(this.value);
        startDate.setDate(startDate.getDate() + 1);
        const minEndDate = startDate.toISOString().split('T')[0];
        endDateInput.min = minEndDate;
        
        if (endDateInput.value && endDateInput.value < minEndDate) {
            endDateInput.value = minEndDate;
        }
    });
});
</script>
@endpush
@endsection
