<div class="pe-app-sidebar" id="sidebar">
    <div class="pe-app-sidebar-logo">
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
            <div class="sidebar-logo-icon me-2">
                <i class="bi bi-hexagon-fill text-white" style="font-size: 1.75rem;"></i>
            </div>
            <div class="sidebar-logo-text">
                <span class="text-white fw-bold" style="font-size: 1.1rem;">HC IT</span>
                <span class="d-block text-white-50" style="font-size: 0.7rem; margin-top: -4px;">Solutions</span>
            </div>
        </a>
    </div>

    <nav class="pe-app-sidebar-menu nav nav-pills" data-simplebar id="sidebar-simplebar">
        <ul class="pe-main-menu list-unstyled">
            <li class="pe-menu-title">Main Navigation</li>

            <!-- Dashboard -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Dashboard</span>
                </a>
            </li>

            <!-- Hero Sections -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}"
                   href="{{ route('admin.hero-sections.index') }}">
                    <i class="bi bi-collection-play-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Hero Sections</span>
                </a>
            </li>

            <!-- Services -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                   href="{{ route('admin.services.index') }}">
                    <i class="bi bi-gear-wide-connected pe-nav-icon"></i>
                    <span class="pe-nav-content">Services</span>
                </a>
            </li>

            <!-- Products -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                   href="{{ route('admin.products.index') }}">
                    <i class="bi bi-box-seam-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Products</span>
                </a>
            </li>

            <!-- Blog Management -->
            <li class="pe-slide pe-has-sub">
                <a href="#collapseBlog" class="pe-nav-link {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*') ? 'true' : 'false' }}"
                   aria-controls="collapseBlog">
                    <i class="bi bi-journal-richtext pe-nav-icon"></i>
                    <span class="pe-nav-content">Blog</span>
                    <i class="bi bi-chevron-down pe-nav-arrow ms-auto" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="pe-slide-menu collapse {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*') ? 'show' : '' }}" id="collapseBlog">
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.blogs.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                            <i class="bi bi-circle-fill pe-nav-icon" style="font-size: 0.4rem;"></i>
                            All Posts
                        </a>
                    </li>
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.blog-categories.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                            <i class="bi bi-circle-fill pe-nav-icon" style="font-size: 0.4rem;"></i>
                            Categories
                        </a>
                    </li>
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.blog-tags.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}">
                            <i class="bi bi-circle-fill pe-nav-icon" style="font-size: 0.4rem;"></i>
                            Tags
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pe-menu-title">Content Management</li>

            <!-- News -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
                   href="{{ route('admin.news.index') }}">
                    <i class="bi bi-megaphone-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">News</span>
                </a>
            </li>

            <!-- Case Studies -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.case-studies.*') ? 'active' : '' }}"
                   href="{{ route('admin.case-studies.index') }}">
                    <i class="bi bi-briefcase-fill pe-nav-icon"></i>
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
                    <i class="bi bi-calendar-event-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Events</span>
                </a>
            </li>

            <!-- Testimonials -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                   href="{{ route('admin.testimonials.index') }}">
                    <i class="bi bi-chat-quote-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Testimonials</span>
                </a>
            </li>

            <li class="pe-menu-title">About Section</li>

            <!-- About Pages -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.about-pages.*') ? 'active' : '' }}"
                   href="{{ route('admin.about-pages.index') }}">
                    <i class="bi bi-info-circle-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">About Pages</span>
                </a>
            </li>

            <!-- Leadership -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.leadership-members.*') ? 'active' : '' }}"
                   href="{{ route('admin.leadership-members.index') }}">
                    <i class="bi bi-person-badge-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Leadership</span>
                </a>
            </li>

            <!-- Partners -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}"
                   href="{{ route('admin.partners.index') }}">
                    <i class="bi bi-people-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Partners</span>
                </a>
            </li>

            <!-- Contact Info -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}"
                   href="{{ route('admin.contact-info.index') }}">
                    <i class="bi bi-telephone-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Contact Info</span>
                </a>
            </li>

            <li class="pe-menu-title">Administration</li>

            <!-- Users -->
            <li class="pe-slide-item">
                <a class="pe-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}">
                    <i class="bi bi-person-lines-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Users</span>
                </a>
            </li>

            <!-- Roles & Permissions -->
            <li class="pe-slide pe-has-sub">
                <a href="#collapseRoles" class="pe-nav-link {{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   aria-expanded="{{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') ? 'true' : 'false' }}"
                   aria-controls="collapseRoles">
                    <i class="bi bi-shield-lock-fill pe-nav-icon"></i>
                    <span class="pe-nav-content">Access Control</span>
                    <i class="bi bi-chevron-down pe-nav-arrow ms-auto" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="pe-slide-menu collapse {{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') ? 'show' : '' }}" id="collapseRoles">
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.roles.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                            <i class="bi bi-circle-fill pe-nav-icon" style="font-size: 0.4rem;"></i>
                            Roles
                        </a>
                    </li>
                    <li class="pe-slide-item">
                        <a href="{{ route('admin.permissions.index') }}"
                           class="pe-nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                            <i class="bi bi-circle-fill pe-nav-icon" style="font-size: 0.4rem;"></i>
                            Permissions
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pe-menu-title">System</li>

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

            <!-- Spacer for Logout -->
            <li style="margin-top: auto; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 2rem;">
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                    @csrf
                    <a class="pe-nav-link text-danger-subtle" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left pe-nav-icon"></i>
                        <span class="pe-nav-content">Sign Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</div>
