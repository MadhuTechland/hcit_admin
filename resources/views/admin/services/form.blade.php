<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Service Details</h5>
            </div>
            <div class="card-body">
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $service->title ?? '') }}"
                           placeholder="Enter service title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug', $service->slug ?? '') }}"
                           placeholder="auto-generated-from-title">
                    <small class="form-text text-muted">URL-friendly version. Leave blank to auto-generate.</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description (for navigation menu) -->
                <div class="mb-3">
                    <label for="description" class="form-label">Short Description (Navigation Menu) <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="2"
                              placeholder="Brief description shown in navigation dropdown" required>{{ old('description', $service->description ?? '') }}</textarea>
                    <small class="form-text text-muted">Shown in navigation menu dropdown</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control @error('tags') is-invalid @enderror"
                           id="tags" name="tags" value="{{ old('tags', $service->tags ?? '') }}"
                           placeholder="e.g., Cloud, Digital, Commerce (comma-separated)">
                    <small class="form-text text-muted">Comma-separated tags</small>
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Detail Page Section -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Page Content</h5>
            </div>
            <div class="card-body">
                <!-- Breadcrumb Title -->
                <div class="mb-3">
                    <label for="breadcrumb_title" class="form-label">Breadcrumb Title</label>
                    <input type="text" class="form-control @error('breadcrumb_title') is-invalid @enderror"
                           id="breadcrumb_title" name="breadcrumb_title"
                           value="{{ old('breadcrumb_title', $service->breadcrumb_title ?? '') }}"
                           placeholder="e.g., Digital Commerce">
                    <small class="form-text text-muted">Title shown in breadcrumb navigation</small>
                    @error('breadcrumb_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                           id="subtitle" name="subtitle" value="{{ old('subtitle', $service->subtitle ?? '') }}"
                           placeholder="e.g., E-Commerce Solutions">
                    <small class="form-text text-muted">Small text above main title on detail page</small>
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Detail Title -->
                <div class="mb-3">
                    <label for="detail_title" class="form-label">Detail Page Title</label>
                    <textarea class="form-control @error('detail_title') is-invalid @enderror"
                              id="detail_title" name="detail_title" rows="2"
                              placeholder="Main heading on detail page">{{ old('detail_title', $service->detail_title ?? '') }}</textarea>
                    @error('detail_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Detail Description -->
                <div class="mb-3">
                    <label for="detail_description" class="form-label">Detail Page Description</label>
                    <textarea class="form-control @error('detail_description') is-invalid @enderror"
                              id="detail_description" name="detail_description" rows="3"
                              placeholder="Paragraph below the main title">{{ old('detail_description', $service->detail_description ?? '') }}</textarea>
                    @error('detail_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Full Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Full Content (HTML)</label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="12"
                              placeholder="Full HTML content for the detail page...">{{ old('content', $service->content ?? '') }}</textarea>
                    <small class="form-text text-muted">You can use HTML for formatting</small>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Publish Settings -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Publish</h5>
            </div>
            <div class="card-body">
                <!-- Active Status -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                               {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                           id="order" name="order" value="{{ old('order', $service->order ?? 0) }}"
                           placeholder="0">
                    <small class="form-text text-muted">Lower numbers appear first</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ isset($service) ? 'Update Service' : 'Create Service' }}
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Image Upload (for listing/navigation) -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Service Image (Navigation)</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                           id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Used in navigation and listings</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(isset($service) && $service->image)
                    <div class="mb-2">
                        <label class="form-label">Current Image:</label>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Current Image"
                             class="img-fluid rounded image-preview">
                    </div>
                @endif

                <div id="new-image-preview" class="mb-2" style="display: none;">
                    <label class="form-label">Preview:</label>
                    <img src="" alt="Preview" class="img-fluid rounded image-preview" id="preview-img">
                </div>
            </div>
        </div>

        <!-- Detail Image Upload -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Page Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="file" class="form-control @error('detail_image') is-invalid @enderror"
                           id="detail_image" name="detail_image" accept="image/*">
                    <small class="form-text text-muted">Main image on detail page</small>
                    @error('detail_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(isset($service) && $service->detail_image)
                    <div class="mb-2">
                        <label class="form-label">Current Detail Image:</label>
                        <img src="{{ asset('storage/' . $service->detail_image) }}" alt="Current Detail Image"
                             class="img-fluid rounded image-preview">
                    </div>
                @endif

                <div id="new-detail-image-preview" class="mb-2" style="display: none;">
                    <label class="form-label">Preview:</label>
                    <img src="" alt="Preview" class="img-fluid rounded image-preview" id="detail-preview-img">
                </div>
            </div>
        </div>

        <!-- Shape Image Upload -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Shape/Icon Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="file" class="form-control @error('shape_image') is-invalid @enderror"
                           id="shape_image" name="shape_image" accept="image/*">
                    <small class="form-text text-muted">Decorative shape or icon</small>
                    @error('shape_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(isset($service) && $service->shape_image)
                    <div class="mb-2">
                        <label class="form-label">Current Shape Image:</label>
                        <img src="{{ asset('storage/' . $service->shape_image) }}" alt="Current Shape Image"
                             class="img-fluid rounded image-preview">
                    </div>
                @endif

                <div id="new-shape-image-preview" class="mb-2" style="display: none;">
                    <label class="form-label">Preview:</label>
                    <img src="" alt="Preview" class="img-fluid rounded image-preview" id="shape-preview-img">
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    });

    // Main image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('new-image-preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Detail image preview
    document.getElementById('detail_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('detail-preview-img').src = e.target.result;
                document.getElementById('new-detail-image-preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Shape image preview
    document.getElementById('shape_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('shape-preview-img').src = e.target.result;
                document.getElementById('new-shape-image-preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
