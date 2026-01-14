@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Bookings
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Booking Details - {{ $booking->booking_number }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Customer Information</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $booking->customer_name }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $booking->customer_email }}</p>
                            <p class="mb-1"><strong>Address:</strong> {{ $booking->customer_address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Booking Information</h6>
                            <p class="mb-1"><strong>Booking Date:</strong> {{ $booking->booking_date->format('M d, Y') }}</p>
                            <p class="mb-1"><strong>Category:</strong> 
                                <span class="badge bg-info">{{ $booking->category->name }}</span>
                            </p>
                            @if($booking->car)
                            <p class="mb-1"><strong>Car:</strong> {{ $booking->car->name }} - {{ $booking->car->model }}</p>
                            @else
                            <p class="mb-1"><strong>Car:</strong> <span class="text-muted">Not selected</span></p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Rental Period</h6>
                            @if($booking->start_date && $booking->end_date)
                                <p class="mb-1"><strong>Start Date:</strong> {{ $booking->start_date->format('M d, Y') }}</p>
                                <p class="mb-1"><strong>End Date:</strong> {{ $booking->end_date->format('M d, Y') }}</p>
                                <p class="mb-1"><strong>Total Days:</strong> {{ $booking->total_days }}</p>
                            @else
                                <p class="text-muted">Rental period not specified</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Pricing</h6>
                            @if($booking->total_price)
                                <h4 class="text-primary">${{ number_format($booking->total_price, 2) }}</h4>
                            @else
                                <p class="text-muted">Price to be determined</p>
                            @endif
                        </div>
                    </div>

                    @if($booking->notes)
                    <hr>
                    <div>
                        <h6 class="text-muted">Notes</h6>
                        <p>{{ $booking->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Update Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Current Status</label>
                            @php
                                $statusClass = match($booking->status) {
                                    'pending' => 'warning',
                                    'confirmed' => 'primary',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <div>
                                <span class="badge bg-{{ $statusClass }} fs-6">{{ ucfirst($booking->status) }}</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Change To</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0">Danger Zone</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">Delete this booking permanently</p>
                    <button class="btn btn-danger w-100" onclick="deleteBooking()">
                        <i class="fas fa-trash"></i> Delete Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteBooking() {
    if (confirm('Are you sure you want to delete this booking? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.bookings.destroy", $booking->id) }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
