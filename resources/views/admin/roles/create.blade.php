@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Create New Role</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">e.g., Admin, Manager, Editor</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign Permissions</label>
                            <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                @forelse($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" class="form-check-input" {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                        <label for="perm_{{ $permission->id }}" class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">No permissions available</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Create Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
