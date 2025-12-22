@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@push('styles')
<style>
    .settings-sidebar {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .settings-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .settings-nav-item {
        border-bottom: 1px solid var(--elegant-gray-100);
    }

    .settings-nav-item:last-child {
        border-bottom: none;
    }

    .settings-nav-link {
        display: flex;
        align-items: center;
        padding: 1rem 1.25rem;
        color: var(--elegant-gray-600);
        text-decoration: none;
        transition: all 0.2s ease;
        gap: 0.75rem;
    }

    .settings-nav-link:hover {
        background: var(--elegant-gray-50);
        color: var(--elegant-primary);
    }

    .settings-nav-link.active {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
        color: var(--elegant-primary);
        border-left: 3px solid var(--elegant-primary);
    }

    .settings-nav-link i {
        font-size: 1.25rem;
        width: 24px;
        text-align: center;
    }

    .settings-nav-link .nav-text {
        flex: 1;
    }

    .settings-nav-link .nav-title {
        font-weight: 600;
        font-size: 0.9rem;
        display: block;
    }

    .settings-nav-link .nav-desc {
        font-size: 0.75rem;
        color: var(--elegant-gray-400);
        display: block;
        margin-top: 2px;
    }

    .settings-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .settings-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--elegant-gray-100);
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
    }

    .settings-header h4 {
        margin: 0;
        font-weight: 700;
        color: var(--elegant-dark);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .settings-header h4 i {
        color: var(--elegant-primary);
    }

    .settings-header p {
        margin: 0.5rem 0 0;
        color: var(--elegant-gray-500);
        font-size: 0.9rem;
    }

    .settings-body {
        padding: 1.5rem;
    }

    .setting-group {
        margin-bottom: 1.5rem;
    }

    .setting-group:last-child {
        margin-bottom: 0;
    }

    .setting-label {
        font-weight: 600;
        color: var(--elegant-dark);
        margin-bottom: 0.5rem;
        display: block;
    }

    .setting-help {
        font-size: 0.8rem;
        color: var(--elegant-gray-400);
        margin-top: 0.25rem;
    }

    .image-preview-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .image-preview {
        max-width: 200px;
        max-height: 120px;
        border-radius: 8px;
        border: 2px solid var(--elegant-gray-200);
        object-fit: contain;
        background: var(--elegant-gray-50);
        padding: 0.5rem;
    }

    .image-preview-delete {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ef4444;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        transition: all 0.2s ease;
    }

    .image-preview-delete:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    .color-input-wrapper {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .color-input-wrapper input[type="color"] {
        width: 50px;
        height: 40px;
        padding: 0;
        border: 2px solid var(--elegant-gray-200);
        border-radius: 8px;
        cursor: pointer;
    }

    .color-input-wrapper input[type="text"] {
        flex: 1;
    }

    .settings-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--elegant-gray-100);
        background: var(--elegant-gray-50);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    @media (max-width: 991.98px) {
        .settings-sidebar {
            margin-bottom: 1.5rem;
        }

        .settings-nav-link .nav-desc {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="row">
    <!-- Settings Navigation Sidebar -->
    <div class="col-lg-3">
        <div class="settings-sidebar">
            <ul class="settings-nav">
                @foreach($settingsSchema as $groupKey => $group)
                    <li class="settings-nav-item">
                        <a href="{{ route('admin.settings.index', ['group' => $groupKey]) }}"
                           class="settings-nav-link {{ $activeGroup === $groupKey ? 'active' : '' }}">
                            <i class="bi {{ $group['icon'] }}"></i>
                            <span class="nav-text">
                                <span class="nav-title">{{ $group['title'] }}</span>
                                <span class="nav-desc">{{ $group['description'] }}</span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="col-lg-9">
        <div class="settings-content">
            @php $currentGroup = $settingsSchema[$activeGroup]; @endphp

            <div class="settings-header">
                <h4><i class="bi {{ $currentGroup['icon'] }}"></i> {{ $currentGroup['title'] }}</h4>
                <p>{{ $currentGroup['description'] }}</p>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="{{ $activeGroup }}">

                <div class="settings-body">
                    <div class="row">
                        @foreach($currentGroup['fields'] as $fieldKey => $field)
                            <div class="col-md-{{ in_array($field['type'], ['textarea']) ? '12' : '6' }}">
                                <div class="setting-group">
                                    <label class="setting-label" for="{{ $fieldKey }}">{{ $field['label'] }}</label>

                                    @switch($field['type'])
                                        @case('text')
                                        @case('email')
                                        @case('url')
                                            <input type="{{ $field['type'] }}"
                                                   class="form-control @error($fieldKey) is-invalid @enderror"
                                                   id="{{ $fieldKey }}"
                                                   name="{{ $fieldKey }}"
                                                   value="{{ old($fieldKey, $settingsData[$fieldKey] ?? '') }}"
                                                   placeholder="{{ $field['placeholder'] ?? '' }}">
                                            @break

                                        @case('textarea')
                                            <textarea class="form-control @error($fieldKey) is-invalid @enderror"
                                                      id="{{ $fieldKey }}"
                                                      name="{{ $fieldKey }}"
                                                      rows="3"
                                                      placeholder="{{ $field['placeholder'] ?? '' }}">{{ old($fieldKey, $settingsData[$fieldKey] ?? '') }}</textarea>
                                            @break

                                        @case('select')
                                            <select class="form-select @error($fieldKey) is-invalid @enderror"
                                                    id="{{ $fieldKey }}"
                                                    name="{{ $fieldKey }}">
                                                @foreach($field['options'] as $optionKey => $optionLabel)
                                                    <option value="{{ $optionKey }}"
                                                            {{ (old($fieldKey, $settingsData[$fieldKey] ?? '') == $optionKey) ? 'selected' : '' }}>
                                                        {{ $optionLabel }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @break

                                        @case('color')
                                            <div class="color-input-wrapper">
                                                <input type="color"
                                                       id="{{ $fieldKey }}_picker"
                                                       value="{{ old($fieldKey, $settingsData[$fieldKey] ?? ($field['placeholder'] ?? '#000000')) }}"
                                                       onchange="document.getElementById('{{ $fieldKey }}').value = this.value">
                                                <input type="text"
                                                       class="form-control @error($fieldKey) is-invalid @enderror"
                                                       id="{{ $fieldKey }}"
                                                       name="{{ $fieldKey }}"
                                                       value="{{ old($fieldKey, $settingsData[$fieldKey] ?? '') }}"
                                                       placeholder="{{ $field['placeholder'] ?? '#000000' }}"
                                                       onchange="document.getElementById('{{ $fieldKey }}_picker').value = this.value">
                                            </div>
                                            @break

                                        @case('image')
                                            @php $currentImage = $settingsData[$fieldKey] ?? null; @endphp

                                            @if($currentImage)
                                                <div class="image-preview-container" id="{{ $fieldKey }}_preview_container">
                                                    <img src="{{ asset('storage/' . $currentImage) }}"
                                                         alt="{{ $field['label'] }}"
                                                         class="image-preview"
                                                         id="{{ $fieldKey }}_preview">
                                                    <button type="button"
                                                            class="image-preview-delete"
                                                            onclick="deleteImage('{{ $fieldKey }}')"
                                                            title="Delete image">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </div>
                                            @endif

                                            <input type="file"
                                                   class="form-control @error($fieldKey) is-invalid @enderror"
                                                   id="{{ $fieldKey }}"
                                                   name="{{ $fieldKey }}"
                                                   accept="image/*"
                                                   onchange="previewImage(this, '{{ $fieldKey }}')">
                                            @break

                                        @case('checkbox')
                                            <div class="form-check form-switch">
                                                <input type="checkbox"
                                                       class="form-check-input"
                                                       id="{{ $fieldKey }}"
                                                       name="{{ $fieldKey }}"
                                                       value="1"
                                                       {{ old($fieldKey, $settingsData[$fieldKey] ?? false) ? 'checked' : '' }}>
                                            </div>
                                            @break
                                    @endswitch

                                    @if(isset($field['help']))
                                        <small class="setting-help">{{ $field['help'] }}</small>
                                    @endif

                                    @error($fieldKey)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="settings-footer">
                    <button type="reset" class="btn btn-light">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview image before upload
    function previewImage(input, fieldKey) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                let container = document.getElementById(fieldKey + '_preview_container');
                let preview = document.getElementById(fieldKey + '_preview');

                if (!container) {
                    // Create preview container if it doesn't exist
                    container = document.createElement('div');
                    container.className = 'image-preview-container';
                    container.id = fieldKey + '_preview_container';

                    preview = document.createElement('img');
                    preview.className = 'image-preview';
                    preview.id = fieldKey + '_preview';

                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = 'button';
                    deleteBtn.className = 'image-preview-delete';
                    deleteBtn.innerHTML = '<i class="bi bi-x"></i>';
                    deleteBtn.title = 'Remove image';
                    deleteBtn.onclick = function() {
                        container.remove();
                        input.value = '';
                    };

                    container.appendChild(preview);
                    container.appendChild(deleteBtn);
                    input.parentNode.insertBefore(container, input);
                }

                preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Delete existing image
    function deleteImage(fieldKey) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch('{{ route("admin.settings.delete-image") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ key: fieldKey })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById(fieldKey + '_preview_container');
                    if (container) {
                        container.remove();
                    }
                } else {
                    alert('Failed to delete image: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the image.');
            });
        }
    }
</script>
@endpush
