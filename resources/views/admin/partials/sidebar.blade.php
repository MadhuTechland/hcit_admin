<div class="pe-app-sidebar" id="sidebar">
    <div class="pe-app-sidebar-logo">
        <a href="{{ route('admin.dashboard') }}" class="fs-18 fw-semibold">
            <img height="30" class="pe-app-sidebar-logo-default d-none" alt="Logo"
                src="https://hc-it-solutions.netlify.app/assets/img/logo.jpeg">
            <img height="30" class="pe-app-sidebar-logo-light d-none" alt="Logo"
                src="https://hc-it-solutions.netlify.app/assets/img/logo.jpeg">
            <img height="30" class="pe-app-sidebar-logo-minimize d-none" alt="Logo"
                src="https://hc-it-solutions.netlify.app/assets/img/logo.jpeg">
        </a>
    </div>

    <nav class="pe-app-sidebar-menu nav nav-pills" data-simplebar id="sidebar-simplebar">
        <ul class="pe-main-menu list-unstyled">
            <li class="pe-menu-title">Main Navigation</li>

            <!-- Dashboard -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 pe-nav-icon"></i>
                    <span class="pe-nav-content">Dashboard</span>
                </a>
            </li>

            <!-- Hero Sections -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}"
                   href="{{ route('admin.hero-sections.index') }}">
                    <i class="bi bi-image pe-nav-icon"></i>
                    <span class="pe-nav-content">Hero Sections</span>
                </a>
            </li>

            <!-- Services -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                   href="{{ route('admin.services.index') }}">
                    <i class="bi bi-gear pe-nav-icon"></i>
                    <span class="pe-nav-content">Services</span>
                </a>
            </li>

            <!-- Blog Management -->
            <li class="pe-slide pe-has-sub">
                <a href="#collapseBlog" class="pe-nav-link {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*') ? 'true' : 'false' }}"
                   aria-controls="collapseBlog">
                    <i class="bi bi-journal-text pe-nav-icon"></i>
                    <span class="pe-nav-content">Blog Management</span>
                    <i class="ri-arrow-down-s-line pe-nav-arrow"></i>
                </a>
                <ul class="pe-slide-menu collapse {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*') ? 'show' : '' }}" id="collapseBlog">
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.blogs.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                            All Blogs
                        </a>
                    </li>
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.blog-categories.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                            Categories
                        </a>
                    </li>
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.blog-tags.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}">
                            Tags
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pe-menu-title">Homepage Management</li>

            <!-- News -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
                   href="{{ route('admin.news.index') }}">
                    <i class="bi bi-newspaper pe-nav-icon"></i>
                    <span class="pe-nav-content">News</span>
                </a>
            </li>

            <!-- Case Studies -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.case-studies.*') ? 'active' : '' }}"
                   href="{{ route('admin.case-studies.index') }}">
                    <i class="bi bi-briefcase pe-nav-icon"></i>
                    <span class="pe-nav-content">Case Studies</span>
                </a>
            </li>

            <!-- Industries -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.industries.*') ? 'active' : '' }}"
                   href="{{ route('admin.industries.index') }}">
                    <i class="bi bi-building pe-nav-icon"></i>
                    <span class="pe-nav-content">Industries</span>
                </a>
            </li>

            <!-- Events -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"
                   href="{{ route('admin.events.index') }}">
                    <i class="bi bi-calendar-event pe-nav-icon"></i>
                    <span class="pe-nav-content">Events</span>
                </a>
            </li>

            <!-- Testimonials -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                   href="{{ route('admin.testimonials.index') }}">
                    <i class="bi bi-chat-quote pe-nav-icon"></i>
                    <span class="pe-nav-content">Testimonials</span>
                </a>
            </li>

            <!-- Contact Info -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}"
                   href="{{ route('admin.contact-info.index') }}">
                    <i class="bi bi-telephone pe-nav-icon"></i>
                    <span class="pe-nav-content">Contact Info</span>
                </a>
            </li>

            <li class="pe-menu-title">Settings</li>

            <!-- Settings -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                   href="{{ route('admin.settings.index') }}">
                    <i class="bi bi-sliders pe-nav-icon"></i>
                    <span class="pe-nav-content">Settings</span>
                </a>
            </li>

            <!-- Media Library -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}"
                   href="{{ route('admin.media.index') }}">
                    <i class="bi bi-images pe-nav-icon"></i>
                    <span class="pe-nav-content">Media Library</span>
                </a>
            </li>

            <li class="pe-menu-title">Account</li>

            <!-- Logout -->
            <li class="pe-slide-item">
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                    @csrf
                    <a class="pe-nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right pe-nav-icon"></i>
                        <span class="pe-nav-content">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</div>
