<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Testimonial Details</h5>
            </div>
            <div class="card-body">
                <!-- Client Name -->
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('client_name') is-invalid @enderror"
                           id="client_name" name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}"
                           placeholder="Enter client name" required>
                    @error('client_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Client Title -->
                <div class="mb-3">
                    <label for="client_title" class="form-label">Client Title/Position</label>
                    <input type="text" class="form-control @error('client_title') is-invalid @enderror"
                           id="client_title" name="client_title" value="{{ old('client_title', $testimonial->client_title ?? '') }}"
                           placeholder="e.g., CEO, CTO, Project Manager">
                    @error('client_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Testimonial Content <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="8"
                              placeholder="Write the testimonial content here..." required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rating -->
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating">
                        <option value="">Select Rating</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Client Image -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Client Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="client_image" class="form-label">Photo</label>
                    <input type="file" class="form-control @error('client_image') is-invalid @enderror"
                           id="client_image" name="client_image" accept="image/*">
                    <small class="form-text text-muted">Recommended: 200x200px (square)</small>
                    @error('client_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($testimonial && $testimonial->client_image)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $testimonial->client_image) }}" alt="Client photo"
                             class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px;">
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
                               {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                           id="order" name="order" value="{{ old('order', $testimonial->order ?? 0) }}"
                           min="0">
                    <small class="form-text text-muted">Lower numbers appear first.</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ $testimonial ? 'Update' : 'Create' }} Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
