@extends('admin.layouts.app')

@section('title', 'Manage Testimonials')
@section('page-title', 'Testimonials')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Testimonials</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All Testimonials</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Add New Testimonials
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Search -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search testimonials...">
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
                                <th scope="col">Client</th>
                                <th scope="col">Position</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Created</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="testimonialsTableBody">
                            @forelse($testimonials as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->client_image)
                                                <img src="{{ asset('storage/' . $item->client_image) }}" alt="" class="avatar-sm rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="avatar-sm rounded-circle bg-primary me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <span class="text-white fw-bold">{{ strtoupper(substr($item->client_name ?? 'U', 0, 1)) }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $item->client_name ?? 'Unknown' }}</h6>
                                                <small class="text-muted">{{ Str::limit($item->content, 50) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->client_title ?? '-' }}</td>
                                    <td>
                                        @if($item->rating)
                                            <span class="badge bg-warning text-dark">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $item->rating ? '-fill' : '' }}"></i>
                                                @endfor
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at ? $item->created_at->format('M d, Y') : '-' }}</td>
                                    <td>
                                        @if($item->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->order }}</td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.testimonials.edit', $item->id) }}"
                                               class="btn btn-sm btn-soft-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-soft-danger" title="Delete"
                                                    onclick="deleteTestimonials({{ $item->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No testimonials found. <a href="{{ route('admin.testimonials.create') }}">Create your first testimonials</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $testimonials->links() }}
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
                <p>Are you sure you want to delete this testimonials? This action cannot be undone.</p>
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
    function deleteTestimonials(id) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/testimonials/${id}`;
        deleteModal.show();
    }

    // Search and filter functionality
    document.getElementById('searchInput').addEventListener('keyup', filterTestimonials);
    document.getElementById('statusFilter').addEventListener('change', filterTestimonials);

    function filterTestimonials() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#testimonialsTableBody tr');

        rows.forEach(row => {
            const title = row.cells[0]?.textContent.toLowerCase() || '';
            const statusText = row.cells[4]?.textContent.toLowerCase() || '';

            const matchesSearch = title.includes(search);
            const matchesStatus = !status || statusText.includes(status);

            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }
</script>
@endpush
