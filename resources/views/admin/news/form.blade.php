<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">News Details</h5>
            </div>
            <div class="card-body">
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $news->title ?? '') }}"
                           placeholder="Enter news title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug', $news->slug ?? '') }}"
                           placeholder="auto-generated-from-title">
                    <small class="form-text text-muted">URL-friendly version. Leave blank to auto-generate.</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                           id="category" name="category" value="{{ old('category', $news->category ?? '') }}"
                           placeholder="e.g., Technology, Business">
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror"
                              id="excerpt" name="excerpt" rows="3"
                              placeholder="Brief summary of the news">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="12"
                              placeholder="Write your news content here...">{{ old('content', $news->content ?? '') }}</textarea>
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
                               {{ old('is_active', $news->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>

                <!-- Published Date -->
                <div class="mb-3">
                    <label for="published_date" class="form-label">Published Date</label>
                    <input type="date" class="form-control @error('published_date') is-invalid @enderror"
                           id="published_date" name="published_date"
                           value="{{ old('published_date', $news && $news->published_date ? $news->published_date->format('Y-m-d') : now()->format('Y-m-d')) }}">
                    @error('published_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Author -->
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                           id="author" name="author"
                           value="{{ old('author', $news->author ?? 'Admin') }}"
                           placeholder="Admin">
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                           id="order" name="order" value="{{ old('order', $news->order ?? 0) }}"
                           placeholder="0">
                    <small class="form-text text-muted">Lower numbers appear first</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $news ? 'Update News' : 'Create News' }}
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>

        <!-- Image Upload -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Featured Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                           id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Recommended size: 1200x630px</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($news && $news->image)
                    <div class="mb-2">
                        <label class="form-label">Current Image:</label>
                        <img src="{{ asset('storage/' . $news->image) }}" alt="Current Image"
                             class="img-fluid rounded image-preview">
                    </div>
                @endif

                <div id="new-image-preview" class="mb-2" style="display: none;">
                    <label class="form-label">Preview:</label>
                    <img src="" alt="Preview" class="img-fluid rounded image-preview" id="preview-img">
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

    // Image preview
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
</script>
@endpush
