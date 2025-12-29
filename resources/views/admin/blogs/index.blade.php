@extends('admin.layouts.app')

@section('title', 'Manage Blogs')
@section('page-title', 'Blogs')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Blogs</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All Blogs</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Add New Blog
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Filters -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search blogs...">
                    </div>
                    <div class="col-md-3">
                        <select id="categoryFilter" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Author</th>
                                <th scope="col">Status</th>
                                <th scope="col">Published</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="blogsTableBody">
                            @forelse($blogs as $blog)
                                <tr data-category-id="{{ $blog->category_id ?? '' }}" data-status="{{ $blog->status }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($blog->featured_image)
                                                <img src="{{ $blog->featured_image }}" alt="" class="avatar-sm rounded me-3">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ Str::limit($blog->title, 60) }}</h6>
                                                <small class="text-muted">{{ $blog->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($blog->category)
                                            @php
                                                // Generate consistent color based on category ID
                                                $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
                                                $colorIndex = $blog->category->id % count($colors);
                                                $color = $colors[$colorIndex];
                                            @endphp
                                            <span class="badge bg-{{ $color }}">{{ $blog->category->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">Uncategorized</span>
                                        @endif
                                    </td>
                                    <td>
                                        @forelse($blog->tags as $tag)
                                            <span class="badge bg-soft-primary text-primary me-1">{{ $tag->name }}</span>
                                        @empty
                                            <span class="text-muted">-</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $blog->author_name ?? '-' }}</td>
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
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ url('/insights/blogs/' . $blog->slug) }}" target="_blank"
                                               class="btn btn-sm btn-soft-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                               class="btn btn-sm btn-soft-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-soft-danger" title="Delete"
                                                    onclick="deleteBlog({{ $blog->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No blogs found. <a href="{{ route('admin.blogs.create') }}">Create your first blog</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this blog? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function deleteBlog(id) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/blogs/${id}`;
        deleteModal.show();
    }

    // Search and filter functionality
    document.getElementById('searchInput').addEventListener('keyup', filterBlogs);
    document.getElementById('categoryFilter').addEventListener('change', filterBlogs);
    document.getElementById('statusFilter').addEventListener('change', filterBlogs);

    function filterBlogs() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const category = document.getElementById('categoryFilter').value;
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#blogsTableBody tr');

        rows.forEach(row => {
            // Skip empty rows (no data-category-id attribute)
            if (!row.hasAttribute('data-category-id') && !row.hasAttribute('data-status')) {
                return;
            }

            const title = row.cells[0]?.textContent.toLowerCase() || '';
            const rowCategoryId = row.getAttribute('data-category-id') || '';
            const rowStatus = row.getAttribute('data-status') || '';

            const matchesSearch = title.includes(search);
            const matchesCategory = !category || rowCategoryId === category;
            const matchesStatus = !status || rowStatus === status;

            row.style.display = (matchesSearch && matchesCategory && matchesStatus) ? '' : 'none';
        });
    }
</script>
@endpush
