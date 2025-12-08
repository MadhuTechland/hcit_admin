@extends('admin.layouts.app')

@section('title', 'View Role')
@section('page-title', 'Role Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">{{ $role->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Role Information</h5>
            </div>
            <div class="card-body">
                <h4>{{ $role->name }}</h4>
                <p class="text-muted">{{ $role->slug }}</p>

                @if($role->is_system)
                    <span class="badge bg-warning mb-3">System Role</span>
                @endif

                <p>{{ $role->description ?? 'No description provided.' }}</p>

                <hr>

                <div class="d-flex justify-content-between mb-2">
                    <span>Total Users:</span>
                    <strong>{{ $role->users->count() }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total Permissions:</span>
                    <strong>{{ $role->permissions->count() }}</strong>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-1"></i> Edit Role
                    </a>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Assigned Permissions</h5>
            </div>
            <div class="card-body">
                @if($role->permissions->count() > 0)
                    @foreach($role->permissions->groupBy('group') as $group => $permissions)
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted">{{ $group ?: 'General' }}</h6>
                            <div>
                                @foreach($permissions as $permission)
                                    <span class="badge bg-secondary me-1 mb-1">{{ $permission->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted mb-0">No permissions assigned to this role.</p>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Users with this Role</h5>
            </div>
            <div class="card-body">
                @if($role->users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role->users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-info">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">No users assigned to this role.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
