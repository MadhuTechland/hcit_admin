<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Blog Details</h5>
            </div>
            <div class="card-body">
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $blog->title ?? '') }}"
                           placeholder="Enter blog title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug', $blog->slug ?? '') }}"
                           placeholder="auto-generated-from-title" required>
                    <small class="form-text text-muted">URL-friendly version of the title. Leave blank to auto-generate.</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror"
                              id="excerpt" name="excerpt" rows="3"
                              placeholder="Brief summary of the blog post (optional)">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="15"
                              placeholder="Write your blog content here..." required>{{ old('content', $blog->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">You can use HTML tags for formatting.</small>
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
                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="draft" {{ old('status', $blog->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $blog->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ old('status', $blog->status ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Published Date -->
                <div class="mb-3">
                    <label for="published_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                           id="published_at" name="published_at"
                           value="{{ old('published_at', $blog && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> {{ $blog ? 'Update Blog' : 'Create Blog' }}
                    </button>
                    @if($blog)
                        <a href="{{ url('/insights/blogs/' . $blog->slug) }}" target="_blank" class="btn btn-outline-info">
                            <i class="bi bi-eye me-1"></i> Preview
                        </a>
                    @endif
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Featured Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="featured_image" class="form-label">Image URL</label>
                    <input type="text" class="form-control @error('featured_image') is-invalid @enderror"
                           id="featured_image" name="featured_image"
                           value="{{ old('featured_image', $blog->featured_image ?? '') }}"
                           placeholder="/assets/img/blog/image.jpg">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Or upload an image:</small>
                </div>

                <div class="mb-3">
                    <input type="file" class="form-control" id="featured_image_upload" name="featured_image_upload" accept="image/*">
                </div>

                @if($blog && $blog->featured_image)
                    <div class="mb-2">
                        <img src="{{ $blog->featured_image }}" alt="Current Image" class="img-fluid rounded" id="image-preview">
                    </div>
                @endif

                <div id="new-image-preview" class="mb-2" style="display: none;">
                    <img src="" alt="Preview" class="img-fluid rounded" id="preview-img">
                </div>
            </div>
        </div>

        <!-- Category -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Category</h5>
            </div>
            <div class="card-body">
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Tags -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Tags</h5>
            </div>
            <div class="card-body">
                <div class="form-check-list">
                    @foreach($tags as $tag)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                   id="tag-{{ $tag->id }}"
                                   {{ $blog && $blog->tags->contains($tag->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tag-{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('tags')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Author -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Author</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="author_name" class="form-label">Author Name</label>
                    <input type="text" class="form-control @error('author_name') is-invalid @enderror"
                           id="author_name" name="author_name"
                           value="{{ old('author_name', $blog->author_name ?? Auth::user()->name ?? '') }}"
                           placeholder="John Doe">
                    @error('author_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="author_image" class="form-label">Author Image URL</label>
                    <input type="text" class="form-control @error('author_image') is-invalid @enderror"
                           id="author_image" name="author_image"
                           value="{{ old('author_image', $blog->author_image ?? '') }}"
                           placeholder="/assets/img/authors/author.jpg">
                    @error('author_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    });

    // Image preview
    document.getElementById('featured_image_upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('new-image-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
