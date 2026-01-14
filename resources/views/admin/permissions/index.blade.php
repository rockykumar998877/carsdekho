@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">Permissions</h2>
            <p class="text-muted">Manage system permissions</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add New Permission
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr><th>Name</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                    <tr>
                        <td><strong>{{ $permission->name }}</strong></td>
                        <td>
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-edit"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center py-4"><p class="text-muted">No permissions found</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $permissions->links() }}</div>
</div>
@endsection
