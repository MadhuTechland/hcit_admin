<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Partner Details</h5>
            </div>
            <div class="card-body">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Partner Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $partner->name ?? '') }}"
                           placeholder="Enter partner name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug', $partner->slug ?? '') }}"
                           placeholder="auto-generated-from-name">
                    <small class="form-text text-muted">URL-friendly version. Leave blank to auto-generate.</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Partner Type -->
                <div class="mb-3">
                    <label for="partner_type" class="form-label">Partner Type</label>
                    <select class="form-select @error('partner_type') is-invalid @enderror" id="partner_type" name="partner_type">
                        <option value="">Select Type</option>
                        <option value="technology" {{ old('partner_type', $partner->partner_type ?? '') == 'technology' ? 'selected' : '' }}>Technology</option>
                        <option value="strategic" {{ old('partner_type', $partner->partner_type ?? '') == 'strategic' ? 'selected' : '' }}>Strategic</option>
                        <option value="consulting" {{ old('partner_type', $partner->partner_type ?? '') == 'consulting' ? 'selected' : '' }}>Consulting</option>
                        <option value="integration" {{ old('partner_type', $partner->partner_type ?? '') == 'integration' ? 'selected' : '' }}>Integration</option>
                    </select>
                    @error('partner_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Website URL -->
                <div class="mb-3">
                    <label for="website_url" class="form-label">Website URL</label>
                    <input type="url" class="form-control @error('website_url') is-invalid @enderror"
                           id="website_url" name="website_url" value="{{ old('website_url', $partner->website_url ?? '') }}"
                           placeholder="https://www.example.com">
                    @error('website_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="6"
                              placeholder="Brief description of the partnership...">{{ old('description', $partner->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Partner Logo -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Partner Logo</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                           id="logo" name="logo" accept="image/*">
                    <small class="form-text text-muted">Recommended: 400x200px (PNG with transparency)</small>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($partner && $partner->logo)
                    <div class="text-center p-3 bg-light rounded">
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="Current logo"
                             class="img-fluid" style="max-width: 200px; max-height: 100px;">
                    </div>
                @endif
            </div>
        </div>

        <!-- Publish Settings -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Publish Settings</h5>
            </div>
            <div class="card-body">
                <!-- Featured -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                               {{ old('is_featured', $partner->is_featured ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Featured Partner
                        </label>
                    </div>
                    <small class="form-text text-muted">Featured partners appear prominently on the website.</small>
                </div>

                <!-- Active Status -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                               {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                           id="order" name="order" value="{{ old('order', $partner->order ?? 0) }}"
                           min="0">
                    <small class="form-text text-muted">Lower numbers appear first.</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ $partner ? 'Update' : 'Create' }} Partner
                    </button>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
