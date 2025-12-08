<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Permission Details</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $permission->name ?? '') }}"
                   placeholder="e.g., View Users" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Permission Slug <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                   id="slug" name="slug" value="{{ old('slug', $permission->slug ?? '') }}"
                   placeholder="e.g., users.view" required>
            <small class="text-muted">Unique identifier used in code (e.g., users.view, blogs.create)</small>
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="group" class="form-label">Group</label>
            <input type="text" class="form-control @error('group') is-invalid @enderror"
                   id="group" name="group" value="{{ old('group', $permission->group ?? '') }}"
                   placeholder="e.g., Users, Blogs, Settings"
                   list="group-suggestions">
            <datalist id="group-suggestions">
                @foreach($groups as $group)
                    <option value="{{ $group }}">
                @endforeach
            </datalist>
            <small class="text-muted">Group permissions for easier management</small>
            @error('group')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                      id="description" name="description" rows="2"
                      placeholder="Brief description of what this permission allows">{{ old('description', $permission->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> {{ $permission ? 'Update' : 'Create' }} Permission
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '.')
            .replace(/\.+/g, '.');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
