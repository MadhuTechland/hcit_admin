<header class="app-header" id="appHeader">
    <div class="container-fluid w-100">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <div class="d-inline-flex align-items-center gap-5">
                    <a href="{{ route('admin.dashboard') }}" class="fs-18 fw-semibold">
                        <img height="30" class="header-sidebar-logo-default d-none" alt="Logo"
                            src="https://hc-it-solutions.netlify.app/assets/img/logo.jpeg">
                        <img height="30" class="header-sidebar-logo-light d-none" alt="Logo"
                            src="https://hc-it-solutions.netlify.app/assets/img/logo.jpeg">
                        <img height="30" class="header-sidebar-logo-small d-none" alt="Logo"
                            src="https://hc-it-solutions.netlify.app/assets/img/logo.jpeg">
                    </a>
                    <button class="btn btn-sm px-3 pe-app-sidebar-toggle fs-20 text-body" id="sidebar-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex gap-1 ms-auto">
                <!-- View Website -->
                <div class="dropdown">
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-ghost-primary">
                        <i class="bi bi-globe me-1"></i> View Website
                    </a>
                </div>

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-ghost-primary dropdown-toggle" type="button" id="userMenuDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                <i class="bi bi-sliders me-2"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
