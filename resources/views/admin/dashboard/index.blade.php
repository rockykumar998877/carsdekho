@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Dashboard</h2>
            <p class="text-muted">Welcome back! Here's what's happening with your car rental business today.</p>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-4 mb-4">
        {{-- Total Cars --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Cars</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalCars }}</h2>
                            <small class="text-success"><i class="fa fa-check-circle"></i> {{ $availableCars }} Available</small>
                        </div>
                        <div class="text-primary" style="font-size: 3rem; opacity: 0.3;">
                            <i class="fa-solid fa-car"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Bookings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Bookings</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalBookings }}</h2>
                            <small class="text-warning"><i class="fa fa-clock"></i> {{ $pendingBookings }} Pending</small>
                        </div>
                        <div class="text-success" style="font-size: 3rem; opacity: 0.3;">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Categories</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalCategories }}</h2>
                            <small class="text-info"><i class="fa fa-list"></i> Active Categories</small>
                        </div>
                        <div class="text-warning" style="font-size: 3rem; opacity: 0.3;">
                            <i class="fa-solid fa-list-ul"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Featured Cars --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Featured Cars</h6>
                            <h2 class="mb-0 fw-bold">{{ $featuredCars }}</h2>
                            <small class="text-primary"><i class="fa fa-star"></i> On Homepage</small>
                        </div>
                        <div class="text-danger" style="font-size: 3rem; opacity: 0.3;">
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Status Overview --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">Booking Status Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="p-3">
                                <div class="text-warning mb-2" style="font-size: 2rem;">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $bookingStats['pending'] }}</h4>
                                <small class="text-muted">Pending</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3">
                                <div class="text-primary mb-2" style="font-size: 2rem;">
                                    <i class="fa-solid fa-check-circle"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $bookingStats['confirmed'] }}</h4>
                                <small class="text-muted">Confirmed</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3">
                                <div class="text-success mb-2" style="font-size: 2rem;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $bookingStats['completed'] }}</h4>
                                <small class="text-muted">Completed</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3">
                                <div class="text-danger mb-2" style="font-size: 2rem;">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $bookingStats['cancelled'] }}</h4>
                                <small class="text-muted">Cancelled</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">Cars by Category</h5>
                </div>
                <div class="card-body">
                    @forelse($carsByCategory as $category)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">{{ $category->name }}</h6>
                            <small class="text-muted">{{ $category->slug }}</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $category->cars_count }} cars</span>
                    </div>
                    @empty
                    <p class="text-muted text-center">No categories found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Latest Bookings and Popular Cars --}}
    <div class="row g-4 mb-4">
        {{-- Latest Bookings --}}
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Latest Bookings</h5>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Booking #</th>
                                    <th>Customer</th>
                                    <th>Car</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestBookings as $booking)
                                <tr>
                                    <td><strong>{{ $booking->booking_number }}</strong></td>
                                    <td>
                                        <div>{{ $booking->customer_name }}</div>
                                        <small class="text-muted">{{ $booking->customer_phone }}</small>
                                    </td>
                                    <td>
                                        {{ $booking->car ? $booking->car->name : 'No car selected' }}
                                    </td>
                                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($booking->status) {
                                                'pending' => 'warning',
                                                'confirmed' => 'primary',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                                    </td>
                                    <td>
                                        @if($booking->total_price)
                                            <strong>${{ number_format($booking->total_price, 2) }}</strong>
                                        @else
                                            <span class="text-muted">TBD</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">No bookings yet</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Popular/Most Searched Cars--}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">Most Popular Cars</h5>
                </div>
                <div class="card-body">
                    @forelse($popularCars as $car)
                    <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                        <div style="width: 80px; height: 60px; flex-shrink: 0;">
                            @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100%; height: 100%;">
                                <i class="fa-solid fa-car text-muted"></i>
                            </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $car->name }}</h6>
                            <small class="text-muted d-block mb-1">{{ $car->model }} ({{ $car->year }})</small>
                            <div>
                                <span class="badge bg-success me-1">${{ number_format($car->price_per_day, 0) }}/day</span>
                                <span class="badge bg-info">{{ $car->search_count }} searches</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">No popular cars yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Cars --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Recent Cars</h5>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse($recentCars as $car)
                        <div class="col-md-4 col-lg-2">
                            <div class="card h-100">
                                @if($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="card-img-top" style="height: 120px; object-fit: cover;">
                                @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 120px;">
                                    <i class="fa-solid fa-car fa-2x text-muted"></i>
                                </div>
                                @endif
                                <div class="card-body p-2">
                                    <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ Str::limit($car->name, 20) }}</h6>
                                    <p class="card-text small text-muted mb-1">{{ $car->category->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">${{ number_format($car->price_per_day, 0) }}</span>
                                        @if($car->is_available)
                                        <span class="badge bg-success">Available</span>
                                        @else
                                        <span class="badge bg-secondary">Booked</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <p class="text-muted text-center">No cars added yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
