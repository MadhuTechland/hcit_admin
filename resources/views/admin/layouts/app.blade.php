<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-layout="vertical">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - HC IT Solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="HC IT Solutions Admin Panel" name="description" />

    <!-- Layout setup (MUST be loaded first) -->
    <script type="module" src="{{ asset('admin-assets/js/layout-setup.js') }}"></script>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/k_favicon_32x.png') }}">

    <!-- Picker css -->
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/simplebar/simplebar.min.css') }}">

    <!-- Swiper Css -->
    <link href="{{ asset('admin-assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Nouislider Css -->
    <link href="{{ asset('admin-assets/libs/nouislider/nouislider.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="{{ asset('admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- App Css -->
    <link href="{{ asset('admin-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    @stack('styles')

    <style>
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .alert-fixed {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        }

        /* Fix header and sidebar layout issues */
        .main-content {
            margin-left: var(--pe-app-sidebar-width);
            padding-top: var(--pe-app-header-height);
            transition: margin-left 0.2s ease-in-out;
        }

        /* When sidebar is closed/minimized */
        [data-sidebar="icon"] .main-content {
            margin-left: 70px;
        }

        [data-sidebar="icon"] .app-header {
            left: 70px;
        }

        /* Mobile responsive */
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }

            .app-header {
                left: 0;
                right: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Header -->
        @include('admin.partials.header')

        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@yield('page-title', 'Dashboard')</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        @yield('breadcrumb')
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show alert-fixed" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show alert-fixed" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show alert-fixed" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')

                </div>
            </div>

            <!-- Footer -->
            @include('admin.partials.footer')
        </div>

    </div>

    <!-- jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('admin-assets/libs/simplebar/simplebar.min.js') }}"></script>

    <!-- Choices.js -->
    <script src="{{ asset('admin-assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin-assets/js/app.js') }}"></script>

    <!-- Global JavaScript -->
    <script>
        // CSRF Token Setup for AJAX
        if (typeof $ !== 'undefined') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert-fixed').fadeOut('slow');
        }, 5000);
    </script>

    @stack('scripts')
</body>

</html>
