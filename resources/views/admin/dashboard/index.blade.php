@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Total Blogs</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="badge bg-soft-success text-success fs-12">
                            <i class="bi bi-arrow-up"></i> Published
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span class="counter-value" data-target="{{ $stats['total_blogs'] }}">{{ $stats['total_blogs'] }}</span>
                        </h4>
                        <a href="{{ route('admin.blogs.index') }}" class="text-decoration-underline">View all blogs</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-info text-info rounded fs-3">
                            <i class="bi bi-journal-text"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Total Services</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="badge bg-soft-primary text-primary fs-12">
                            <i class="bi bi-check-circle"></i> Active
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span class="counter-value" data-target="{{ $stats['total_services'] }}">{{ $stats['total_services'] }}</span>
                        </h4>
                        <a href="{{ route('admin.services.index') }}" class="text-decoration-underline">View all services</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-warning text-warning rounded fs-3">
                            <i class="bi bi-gear"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Hero Sections</p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span class="counter-value" data-target="{{ $stats['total_hero_sections'] }}">{{ $stats['total_hero_sections'] }}</span>
                        </h4>
                        <a href="{{ route('admin.hero-sections.index') }}" class="text-decoration-underline">Manage sections</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-danger text-danger rounded fs-3">
                            <i class="bi bi-image"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Categories & Tags</p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span class="counter-value" data-target="{{ $stats['total_categories'] + $stats['total_tags'] }}">{{ $stats['total_categories'] + $stats['total_tags'] }}</span>
                        </h4>
                        <small class="text-muted">{{ $stats['total_categories'] }} Categories, {{ $stats['total_tags'] }} Tags</small>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-success text-success rounded fs-3">
                            <i class="bi bi-tags"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Recent Blogs</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg"></i> Add New Blog
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Published</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_blogs as $blog)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($blog->featured_image)
                                                <img src="{{ $blog->featured_image }}" alt="" class="avatar-xs rounded me-2">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ Str::limit($blog->title, 50) }}</h6>
                                                <small class="text-muted">{{ $blog->author_name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($blog->category)
                                            <span class="badge bg-soft-info text-info">{{ $blog->category->name }}</span>
                                        @else
                                            <span class="badge bg-soft-secondary">Uncategorized</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($blog->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif($blog->status === 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">Archived</span>
                                        @endif
                                    </td>
                                    <td>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-soft-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No blogs found. <a href="{{ route('admin.blogs.create') }}">Create your first blog</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Quick Actions</h4>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i> Create New Blog
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-gear me-2"></i> Manage Services
                    </a>
                    <a href="{{ route('admin.hero-sections.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-image me-2"></i> Manage Hero Sections
                    </a>
                    <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-images me-2"></i> Media Library
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-sliders me-2"></i> Settings
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title mb-0">System Info</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="py-2">
                        <i class="bi bi-server text-primary me-2"></i>
                        <strong>Laravel Version:</strong> {{ app()->version() }}
                    </li>
                    <li class="py-2">
                        <i class="bi bi-php text-success me-2"></i>
                        <strong>PHP Version:</strong> {{ PHP_VERSION }}
                    </li>
                    <li class="py-2">
                        <i class="bi bi-database text-info me-2"></i>
                        <strong>Database:</strong> MySQL
                    </li>
                    <li class="py-2">
                        <i class="bi bi-calendar text-warning me-2"></i>
                        <strong>Last Login:</strong> {{ now()->format('M d, Y H:i') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Counter animation
    document.querySelectorAll('.counter-value').forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 1000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    });
</script>
@endpush
