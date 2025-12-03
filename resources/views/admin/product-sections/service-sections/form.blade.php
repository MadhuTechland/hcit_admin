<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Section Information</h5>
            </div>
            <div class="card-body">
                <!-- Section Type -->
                <div class="mb-3">
                    <label for="section_type" class="form-label">Section Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('section_type') is-invalid @enderror" id="section_type" name="section_type" required>
                        <option value="">Select Section Type</option>
                        @foreach($sectionTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('section_type', $section->section_type ?? '') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                           value="{{ old('title', $section->title ?? '') }}" placeholder="Enter section title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle"
                           value="{{ old('subtitle', $section->subtitle ?? '') }}" placeholder="Enter section subtitle">
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                              rows="3" placeholder="Enter short description">{{ old('description', $section->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                              rows="8" placeholder="Enter full content">{{ old('content', $section->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">You can use HTML here</small>
                </div>

                <!-- Additional Data (JSON) -->
                <div class="mb-3">
                    <label for="additional_data" class="form-label">Additional Data (JSON)</label>
                    <textarea class="form-control @error('additional_data') is-invalid @enderror" id="additional_data" name="additional_data"
                              rows="5" placeholder='{"key": "value"}'>{{ old('additional_data', json_encode($section->additional_data ?? null)) }}</textarea>
                    @error('additional_data')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Enter valid JSON for additional flexible data</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Image Upload -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Section Image</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Main Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(isset($section) && $section->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $section->image) }}" alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="background_image" class="form-label">Background Image</label>
                    <input type="file" class="form-control @error('background_image') is-invalid @enderror" id="background_image" name="background_image" accept="image/*">
                    @error('background_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(isset($section) && $section->background_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $section->background_image) }}" alt="Current background" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Settings</h5>
            </div>
            <div class="card-body">
                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                           value="{{ old('order', $section->order ?? 0) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Lower numbers appear first</small>
                </div>

                <!-- Active Status -->
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                           {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-check-lg"></i> {{ isset($section) ? 'Update Section' : 'Create Section' }}
                </button>
                <a href="{{ route('admin.services.sections.index', $service) }}" class="btn btn-secondary w-100">
                    <i class="bi bi-x-lg"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</div>
