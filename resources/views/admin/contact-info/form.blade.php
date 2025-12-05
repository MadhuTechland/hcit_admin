<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Contact Information Details</h5>
            </div>
            <div class="card-body">
                <!-- Type -->
                <div class="mb-3">
                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="phone" {{ old('type', $contactInfo->type ?? '') == 'phone' ? 'selected' : '' }}>Phone</option>
                        <option value="email" {{ old('type', $contactInfo->type ?? '') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="address" {{ old('type', $contactInfo->type ?? '') == 'address' ? 'selected' : '' }}>Address</option>
                        <option value="social" {{ old('type', $contactInfo->type ?? '') == 'social' ? 'selected' : '' }}>Social Media</option>
                        <option value="hours" {{ old('type', $contactInfo->type ?? '') == 'hours' ? 'selected' : '' }}>Business Hours</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Label -->
                <div class="mb-3">
                    <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('label') is-invalid @enderror"
                           id="label" name="label" value="{{ old('label', $contactInfo->label ?? '') }}"
                           placeholder="e.g., Main Office, Support Email" required>
                    @error('label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Value -->
                <div class="mb-3">
                    <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('value') is-invalid @enderror"
                              id="value" name="value" rows="3"
                              placeholder="Enter the contact information value" required>{{ old('value', $contactInfo->value ?? '') }}</textarea>
                    <small class="form-text text-muted">E.g., phone number, email address, or full address</small>
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon Class</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror"
                           id="icon" name="icon" value="{{ old('icon', $contactInfo->icon ?? '') }}"
                           placeholder="e.g., bi bi-telephone, bi bi-envelope">
                    <small class="form-text text-muted">Bootstrap icon class or font awesome class</small>
                    @error('icon')
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
                <h5 class="card-title mb-0">Settings</h5>
            </div>
            <div class="card-body">
                <!-- Active Status -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                               {{ old('is_active', $contactInfo->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                           id="order" name="order" value="{{ old('order', $contactInfo->order ?? 0) }}"
                           min="0">
                    <small class="form-text text-muted">Lower numbers appear first.</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ $contactInfo ? 'Update' : 'Create' }} Contact Info
                    </button>
                    <a href="{{ route('admin.contact-info.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
