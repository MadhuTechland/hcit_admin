@extends('admin.layouts.app')

@section('title', 'View User')
@section('page-title', 'User Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                         class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 120px; height: 120px;">
                        <span class="text-white" style="font-size: 48px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                @endif

                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-2">{{ $user->email }}</p>

                @if($user->is_admin)
                    <span class="badge bg-success">Admin</span>
                @endif

                <hr>

                <div class="text-start">
                    <p class="mb-2"><strong>Phone:</strong> {{ $user->phone ?? 'Not provided' }}</p>
                    <p class="mb-2"><strong>Created:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                    <p class="mb-0"><strong>Updated:</strong> {{ $user->updated_at->format('M d, Y') }}</p>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-1"></i> Edit User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Assigned Roles</h5>
            </div>
            <div class="card-body">
                @forelse($user->roles as $role)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">{{ $role->name }}</h6>
                                <p class="text-muted small mb-2">{{ $role->description ?? 'No description' }}</p>
                            </div>
                            @if($role->is_system)
                                <span class="badge bg-warning">System</span>
                            @endif
                        </div>

                        @if($role->permissions->count() > 0)
                            <div class="mt-2">
                                <small class="text-muted">Permissions:</small>
                                <div class="mt-1">
                                    @foreach($role->permissions as $permission)
                                        <span class="badge bg-light text-dark me-1 mb-1">{{ $permission->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted mb-0">No roles assigned to this user.</p>
                @endforelse
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">All Permissions</h5>
            </div>
            <div class="card-body">
                @php $allPermissions = $user->getAllPermissions(); @endphp
                @if($allPermissions->count() > 0)
                    @foreach($allPermissions->groupBy('group') as $group => $permissions)
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted small">{{ $group ?: 'General' }}</h6>
                            <div>
                                @foreach($permissions as $permission)
                                    <span class="badge bg-secondary me-1 mb-1">{{ $permission->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @elseif($user->isSuperAdmin())
                    <p class="text-success mb-0"><i class="bi bi-shield-check me-1"></i> Super Admin has all permissions.</p>
                @else
                    <p class="text-muted mb-0">No permissions assigned.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
