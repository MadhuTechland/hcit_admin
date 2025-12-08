<header class="app-header" id="appHeader">
    <div class="container-fluid w-100">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <div class="d-inline-flex align-items-center gap-3">
                    <button class="btn btn-sm px-3 pe-app-sidebar-toggle" id="sidebar-toggle">
                        <i class="bi bi-list fs-5"></i>
                    </button>

                    <!-- Search Bar -->
                    <div class="d-none d-md-block">
                        <div class="position-relative">
                            <input type="text" class="form-control form-control-sm ps-4" placeholder="Search..."
                                   style="width: 280px; background: var(--elegant-gray-100); border-color: transparent;">
                            <i class="bi bi-search position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 0.85rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <!-- Quick Actions -->
                <div class="dropdown d-none d-lg-block">
                    <button class="btn btn-sm btn-light rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-plus-lg me-1"></i> Quick Add
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                        <li class="px-3 py-2 border-bottom">
                            <small class="text-uppercase text-muted fw-semibold">Create New</small>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.blogs.create') }}"><i class="bi bi-journal-plus me-2 text-primary"></i> Blog Post</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.news.create') }}"><i class="bi bi-megaphone me-2 text-info"></i> News Article</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.events.create') }}"><i class="bi bi-calendar-plus me-2 text-success"></i> Event</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.users.create') }}"><i class="bi bi-person-plus me-2 text-warning"></i> User</a></li>
                    </ul>
                </div>

                <!-- Notifications -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-light rounded-circle position-relative" type="button" data-bs-toggle="dropdown"
                            style="width: 40px; height: 40px;">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                            3
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" style="width: 320px; max-height: 400px; overflow-y: auto;">
                        <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-semibold">Notifications</h6>
                            <a href="#" class="text-primary small">Mark all read</a>
                        </div>
                        <div class="px-3 py-3 border-bottom notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-plus text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1 fw-medium">New user registered</p>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-3 border-bottom notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-success-subtle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-check-circle text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1 fw-medium">Blog post published</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-3 notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-exclamation-triangle text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1 fw-medium">System update available</p>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-2 border-top text-center">
                            <a href="#" class="text-primary small fw-medium">View all notifications</a>
                        </div>
                    </div>
                </div>

                <!-- View Website -->
                <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-light rounded-circle d-none d-md-flex align-items-center justify-content-center"
                   style="width: 40px; height: 40px;" title="View Website">
                    <i class="bi bi-globe"></i>
                </a>

                <!-- Divider -->
                <div class="vr mx-2 d-none d-lg-block" style="height: 30px;"></div>

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-sm d-flex align-items-center gap-2 rounded-pill px-2 pe-3 border" type="button"
                            id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            style="background: linear-gradient(135deg, var(--elegant-gray-100) 0%, var(--elegant-white) 100%);">
                        @if(Auth::check() && Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""
                                 class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 32px; height: 32px; background: var(--elegant-gradient-primary);">
                                <span class="text-white fw-semibold" style="font-size: 0.8rem;">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        <div class="text-start d-none d-lg-block">
                            <div class="fw-semibold lh-1" style="font-size: 0.85rem;">{{ Auth::user()->name ?? 'Admin' }}</div>
                            <small class="text-muted" style="font-size: 0.7rem;">
                                @if(Auth::check() && Auth::user()->roles->count() > 0)
                                    {{ Auth::user()->roles->first()->name }}
                                @else
                                    Administrator
                                @endif
                            </small>
                        </div>
                        <i class="bi bi-chevron-down text-muted ms-1" style="font-size: 0.7rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userMenuDropdown" style="min-width: 240px;">
                        <li class="px-3 py-3 border-bottom">
                            <div class="d-flex align-items-center">
                                @if(Auth::check() && Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""
                                         class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                         style="width: 50px; height: 50px; background: var(--elegant-gradient-primary);">
                                        <span class="text-white fw-bold" style="font-size: 1.25rem;">
                                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ Auth::user()->name ?? 'Admin' }}</div>
                                    <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.profile.index') }}">
                                <i class="bi bi-person me-2 text-primary"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.profile.edit') }}">
                                <i class="bi bi-pencil-square me-2 text-info"></i> Edit Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.profile.change-password') }}">
                                <i class="bi bi-key me-2 text-warning"></i> Change Password
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.settings.index') }}">
                                <i class="bi bi-gear me-2 text-secondary"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-2"></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
