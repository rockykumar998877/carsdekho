@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">Manage Bookings</h2>
            <p class="text-muted">View and manage all customer bookings</p>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group">
                <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    Filter by Status
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?status=">All</a></li>
                    <li><a class="dropdown-item" href="?status=pending">Pending</a></li>
                    <li><a class="dropdown-item" href="?status=confirmed">Confirmed</a></li>
                    <li><a class="dropdown-item" href="?status=completed">Completed</a></li>
                    <li><a class="dropdown-item" href="?status=cancelled">Cancelled</a></li>
                </ul>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Booking #</th>
                            <th>Customer</th>
                            <th>Car</th>
                            <th>Category</th>
                            <th>Booking Date</th>
                            <th>Rental Period</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->booking_number }}</strong></td>
                            <td>
                                <div>{{ $booking->customer_name }}</div>
                                <small class="text-muted">{{ $booking->customer_phone }}</small>
                            </td>
                            <td>
                                @if($booking->car)
                                    {{ $booking->car->name }}
                                @else
                                    <span class="text-muted">Not selected</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $booking->category->name }}</span>
                            </td>
                            <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                            <td>
                                @if($booking->start_date && $booking->end_date)
                                    {{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d, Y') }}
                                    <br><small class="text-muted">{{ $booking->total_days }} days</small>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->total_price)
                                    <strong>${{ number_format($booking->total_price, 2) }}</strong>
                                @else
                                    <span class="text-muted">TBD</span>
                                @endif
                            </td>
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
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <button class="btn btn-danger" onclick="deleteBooking({{ $booking->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <p class="text-muted mb-0">No bookings found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>

<script>
function deleteBooking(id) {
    if (confirm('Are you sure you want to delete this booking?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/bookings/${id}`;
        
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
