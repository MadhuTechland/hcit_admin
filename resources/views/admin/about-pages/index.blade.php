@extends('admin.layouts.app')

@section('title', 'Manage About Pages')
@section('page-title', 'About Pages')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">About Pages</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All About Pages</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.about-pages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Add New Page
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Search -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search pages...">
                    </div>
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Page Type</th>
                                <th scope="col">Created</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="aboutPagesTableBody">
                            @forelse($aboutPages as $page)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($page->image)
                                                <img src="{{ asset('storage/' . $page->image) }}" alt="" class="avatar-sm rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ Str::limit($page->title, 50) }}</h6>
                                                <small class="text-muted">{{ $page->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-info text-info">{{ $page->page_type }}</span>
                                    </td>
                                    <td>{{ $page->created_at ? $page->created_at->format('M d, Y') : '-' }}</td>
                                    <td>
                                        @if($page->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $page->order }}</td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.about-pages.edit', $page->id) }}"
                                               class="btn btn-sm btn-soft-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-soft-danger" title="Delete"
                                                    onclick="deletePage({{ $page->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        No about pages found. <a href="{{ route('admin.about-pages.create') }}">Create your first page</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $aboutPages->links() }}
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
                <p>Are you sure you want to delete this page? This action cannot be undone.</p>
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
    function deletePage(id) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/about-pages/${id}`;
        deleteModal.show();
    }

    // Search and filter functionality
    document.getElementById('searchInput').addEventListener('keyup', filterPages);
    document.getElementById('statusFilter').addEventListener('change', filterPages);

    function filterPages() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#aboutPagesTableBody tr');

        rows.forEach(row => {
            const title = row.cells[0]?.textContent.toLowerCase() || '';
            const statusText = row.cells[3]?.textContent.toLowerCase() || '';

            const matchesSearch = title.includes(search);
            const matchesStatus = !status || statusText.includes(status);

            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }
</script>
@endpush
