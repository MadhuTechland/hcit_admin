@extends('admin.layouts.app')

@section('title', 'Manage Partners')
@section('page-title', 'Partners')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Partners</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All Partners</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Add New Partner
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Search -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search partners...">
                    </div>
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="featuredFilter" class="form-select">
                            <option value="">All Partners</option>
                            <option value="featured">Featured</option>
                            <option value="non-featured">Non-Featured</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Website</th>
                                <th scope="col">Featured</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="partnersTableBody">
                            @forelse($partners as $partner)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($partner->logo)
                                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="" class="avatar-sm rounded me-3" style="width: 50px; height: 50px; object-fit: contain;">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $partner->name }}</h6>
                                                <small class="text-muted">{{ $partner->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($partner->partner_type)
                                            <span class="badge bg-soft-info text-info">{{ $partner->partner_type }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank">
                                                <i class="bi bi-link-45deg"></i> Visit
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($partner->is_featured)
                                            <span class="badge bg-warning">Featured</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($partner->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $partner->order }}</td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                               class="btn btn-sm btn-soft-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-soft-danger" title="Delete"
                                                    onclick="deletePartner({{ $partner->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No partners found. <a href="{{ route('admin.partners.create') }}">Create your first partner</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $partners->links() }}
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
                <p>Are you sure you want to delete this partner? This action cannot be undone.</p>
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
    function deletePartner(id) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/partners/${id}`;
        deleteModal.show();
    }

    // Search and filter functionality
    document.getElementById('searchInput').addEventListener('keyup', filterPartners);
    document.getElementById('statusFilter').addEventListener('change', filterPartners);
    document.getElementById('featuredFilter').addEventListener('change', filterPartners);

    function filterPartners() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const featured = document.getElementById('featuredFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#partnersTableBody tr');

        rows.forEach(row => {
            const name = row.cells[0]?.textContent.toLowerCase() || '';
            const statusText = row.cells[4]?.textContent.toLowerCase() || '';
            const featuredText = row.cells[3]?.textContent.toLowerCase() || '';

            const matchesSearch = name.includes(search);
            const matchesStatus = !status || statusText.includes(status);
            const matchesFeatured = !featured ||
                (featured === 'featured' && featuredText.includes('featured')) ||
                (featured === 'non-featured' && !featuredText.includes('featured'));

            row.style.display = (matchesSearch && matchesStatus && matchesFeatured) ? '' : 'none';
        });
    }
</script>
@endpush
