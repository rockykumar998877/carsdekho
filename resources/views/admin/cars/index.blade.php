@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">Manage Cars</h2>
            <p class="text-muted">View and manage all rental cars</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add New Car
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Price/Day</th>
                            <th>Seats</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                        <tr>
                            <td>
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 60px; height: 40px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-car text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $car->name }}</strong>
                                @if($car->is_featured)
                                    <span class="badge bg-warning text-dark ms-1">Featured</span>
                                @endif
                                @if($car->is_most_searched)
                                    <span class="badge bg-info ms-1">Popular</span>
                                @endif
                            </td>
                            <td><span class="badge bg-secondary">{{ $car->category->name }}</span></td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->year }}</td>
                            <td><strong>${{ number_format($car->price_per_day, 2) }}</strong></td>
                            <td>{{ $car->seats }}</td>
                            <td>
                                @if($car->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-danger">Not Available</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" onclick="deleteCar({{ $car->id }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <p class="text-muted mb-3">No cars found</p>
                                <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i> Add Your First Car
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $cars->links() }}
    </div>
</div>

<script>
function deleteCar(id) {
    if (confirm('Are you sure you want to delete this car?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/cars/${id}`;
        
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
