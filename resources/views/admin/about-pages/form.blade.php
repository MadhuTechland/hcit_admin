<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Page Details</h5>
            </div>
            <div class="card-body">
                <!-- Page Type -->
                <div class="mb-3">
                    <label for="page_type" class="form-label">Page Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('page_type') is-invalid @enderror" id="page_type" name="page_type" required>
                        <option value="">Select Page Type</option>
                        <option value="who-we-are" {{ old('page_type', $aboutPage->page_type ?? '') == 'who-we-are' ? 'selected' : '' }}>Who We Are</option>
                        <option value="our-leadership" {{ old('page_type', $aboutPage->page_type ?? '') == 'our-leadership' ? 'selected' : '' }}>Our Leadership</option>
                        <option value="our-history" {{ old('page_type', $aboutPage->page_type ?? '') == 'our-history' ? 'selected' : '' }}>Our History</option>
                        <option value="careers" {{ old('page_type', $aboutPage->page_type ?? '') == 'careers' ? 'selected' : '' }}>Careers</option>
                        <option value="partners" {{ old('page_type', $aboutPage->page_type ?? '') == 'partners' ? 'selected' : '' }}>Partners</option>
                        <option value="newsroom" {{ old('page_type', $aboutPage->page_type ?? '') == 'newsroom' ? 'selected' : '' }}>Newsroom</option>
                    </select>
                    @error('page_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $aboutPage->title ?? '') }}"
                           placeholder="Enter page title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug', $aboutPage->slug ?? '') }}"
                           placeholder="auto-generated-from-title">
                    <small class="form-text text-muted">URL-friendly version. Leave blank to auto-generate.</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3"
                              placeholder="Brief summary of the page">{{ old('description', $aboutPage->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="12"
                              placeholder="Write your page content here...">{{ old('content', $aboutPage->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Meta Data (JSON) -->
                <div class="mb-3">
                    <label for="meta_data" class="form-label">Meta Data (JSON)</label>
                    <textarea class="form-control @error('meta_data') is-invalid @enderror"
                              id="meta_data" name="meta_data" rows="6"
                              placeholder='{"mission": "Our mission...", "vision": "Our vision..."}'
                    >{{ old('meta_data', $aboutPage && $aboutPage->meta_data ? json_encode($aboutPage->meta_data, JSON_PRETTY_PRINT) : '') }}</textarea>
                    <small class="form-text text-muted">Optional additional data in JSON format.</small>
                    @error('meta_data')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Images -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Featured Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                           id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Recommended: 800x600px</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($aboutPage && $aboutPage->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $aboutPage->image) }}" alt="Current image"
                             class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                @endif
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Banner Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="banner_image" class="form-label">Banner Image</label>
                    <input type="file" class="form-control @error('banner_image') is-invalid @enderror"
                           id="banner_image" name="banner_image" accept="image/*">
                    <small class="form-text text-muted">Recommended: 1920x400px</small>
                    @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($aboutPage && $aboutPage->banner_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $aboutPage->banner_image) }}" alt="Current banner"
                             class="img-fluid rounded" style="max-height: 200px;">
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
                <!-- Active Status -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                               {{ old('is_active', $aboutPage->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                           id="order" name="order" value="{{ old('order', $aboutPage->order ?? 0) }}"
                           min="0">
                    <small class="form-text text-muted">Lower numbers appear first.</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ $aboutPage ? 'Update' : 'Create' }} Page
                    </button>
                    <a href="{{ route('admin.about-pages.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
