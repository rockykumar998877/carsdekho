@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back to Cars
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Car</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Car Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="model" class="form-label">Model <span class="text-danger">*</span></label>
                                <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}" required>
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price_per_day" class="form-label">Price Per Day ($) <span class="text-danger">*</span></label>
                                <input type="number" name="price_per_day" id="price_per_day" class="form-control @error('price_per_day') is-invalid @enderror" value="{{ old('price_per_day') }}" step="0.01" min="0" required>
                                @error('price_per_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="seats" class="form-label">Number of Seats <span class="text-danger">*</span></label>
                                <input type="number" name="seats" id="seats" class="form-control @error('seats') is-invalid @enderror" value="{{ old('seats', 5) }}" min="1" max="20" required>
                                @error('seats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="transmission" class="form-label">Transmission <span class="text-danger">*</span></label>
                                <select name="transmission" id="transmission" class="form-select @error('transmission') is-invalid @enderror" required>
                                    <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                                </select>
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fuel_type" class="form-label">Fuel Type <span class="text-danger">*</span></label>
                                <select name="fuel_type" id="fuel_type" class="form-select @error('fuel_type') is-invalid @enderror" required>
                                    <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                                    <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Electric</option>
                                    <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                                @error('fuel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label">Car Image</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="is_available" id="is_available" class="form-check-input" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                                    <label for="is_available" class="form-check-label">Available for Booking</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label for="is_featured" class="form-check-label">Featured Car</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="is_most_searched" id="is_most_searched" class="form-check-input" value="1" {{ old('is_most_searched') ? 'checked' : '' }}>
                                    <label for="is_most_searched" class="form-check-label">Most Searched</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Save Car
                            </button>
                            <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
