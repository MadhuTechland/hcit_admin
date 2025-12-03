@extends('admin.layouts.app')

@section('title', 'Manage Industry Sections')
@section('page-title', 'Industry Sections - ' . $industry->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.index') }}">Industries</a></li>
    <li class="breadcrumb-item active">Sections</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Sections for {{ $industry->title }}</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.industries.sections.create', $industry) }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Add New Section
                    </a>
                    <a href="{{ route('admin.industries.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Industries
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Section Type</th>
                                <th scope="col">Title</th>
                                <th scope="col">Order</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sections as $section)
                                <tr>
                                    <td>
                                        <span class="badge bg-soft-primary text-primary">{{ ucwords(str_replace('_', ' ', $section->section_type)) }}</span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $section->title ?? 'No Title' }}</h6>
                                        @if($section->subtitle)
                                            <small class="text-muted">{{ Str::limit($section->subtitle, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $section->order }}</td>
                                    <td>
                                        @if($section->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.industries.sections.edit', [$industry, $section]) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.industries.sections.destroy', [$industry, $section]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this section?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-0">No sections found. Add your first section!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($sections->hasPages())
                    <div class="mt-3">
                        {{ $sections->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
