<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - HC IT Solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="HC IT Solutions Admin Panel" name="description" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/k_favicon_32x.png') }}">

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --elegant-primary: #6366f1;
            --elegant-primary-dark: #4f46e5;
            --elegant-secondary: #8b5cf6;
            --elegant-accent: #a855f7;
            --elegant-dark: #1e1b4b;
            --elegant-darker: #0f0d24;
            --elegant-gray-100: #f8fafc;
            --elegant-gray-200: #f1f5f9;
            --elegant-gray-300: #e2e8f0;
            --elegant-gray-400: #94a3b8;
            --elegant-gray-500: #64748b;
            --elegant-gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            --elegant-gradient-dark: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            --elegant-shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --elegant-shadow-glow: 0 0 40px rgba(99, 102, 241, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            position: relative;
        }

        /* Left Side - Branding */
        .auth-branding {
            flex: 1;
            background: var(--elegant-gradient-dark);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .auth-branding::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 50%);
            animation: pulse-bg 8s ease-in-out infinite;
        }

        .auth-branding::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -30%;
            width: 60%;
            height: 60%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 60%);
            animation: pulse-bg 10s ease-in-out infinite reverse;
        }

        @keyframes pulse-bg {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(5deg); }
        }

        .branding-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 450px;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            background: var(--elegant-gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: var(--elegant-shadow-glow);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .brand-logo i {
            font-size: 2.5rem;
            color: white;
        }

        .branding-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
        }

        .branding-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 3rem;
        }

        .features-list {
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            backdrop-filter: blur(10px);
        }

        .feature-icon i {
            color: var(--elegant-secondary);
            font-size: 1.1rem;
        }

        .feature-text {
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Right Side - Login Form */
        .auth-form-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            background: var(--elegant-gray-100);
            position: relative;
        }

        .auth-form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--elegant-gradient-primary);
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--elegant-shadow-lg);
            position: relative;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: var(--elegant-gradient-primary);
            border-radius: 26px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .auth-card:hover::before {
            opacity: 0.1;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--elegant-dark);
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: var(--elegant-gray-500);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--elegant-dark);
            margin-bottom: 0.5rem;
        }

        .input-group-elegant {
            position: relative;
        }

        .input-group-elegant i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--elegant-gray-400);
            font-size: 1.1rem;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .form-control-elegant {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            font-size: 0.95rem;
            border: 2px solid var(--elegant-gray-200);
            border-radius: 12px;
            background: var(--elegant-gray-100);
            color: var(--elegant-dark);
            transition: all 0.3s ease;
        }

        .form-control-elegant:focus {
            outline: none;
            border-color: var(--elegant-primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .form-control-elegant:focus + i,
        .input-group-elegant:focus-within i {
            color: var(--elegant-primary);
        }

        .form-control-elegant.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .form-check-elegant {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check-input-elegant {
            width: 18px;
            height: 18px;
            border: 2px solid var(--elegant-gray-300);
            border-radius: 4px;
            margin-right: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-input-elegant:checked {
            background: var(--elegant-gradient-primary);
            border-color: var(--elegant-primary);
        }

        .form-check-label-elegant {
            color: var(--elegant-gray-500);
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        .btn-login {
            width: 100%;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: var(--elegant-gradient-primary);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--elegant-shadow-glow);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* Alerts */
        .alert-elegant {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success-elegant {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger-elegant {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-elegant .btn-close {
            margin-left: auto;
            opacity: 0.5;
            transition: opacity 0.2s ease;
        }

        .alert-elegant .btn-close:hover {
            opacity: 1;
        }

        /* Footer */
        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            color: var(--elegant-gray-400);
            font-size: 0.85rem;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--elegant-gray-400);
            cursor: pointer;
            padding: 0;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--elegant-primary);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .auth-wrapper {
                flex-direction: column;
            }

            .auth-branding {
                padding: 2rem;
                min-height: auto;
            }

            .branding-title {
                font-size: 1.75rem;
            }

            .branding-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .features-list {
                display: none;
            }

            .auth-form-section {
                padding: 2rem 1.5rem;
            }

            .auth-form-section::before {
                width: 100%;
                height: 4px;
                top: 0;
                left: 0;
            }

            .auth-card {
                padding: 2rem;
                border-radius: 20px;
            }
        }

        @media (max-width: 575.98px) {
            .auth-branding {
                padding: 1.5rem;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                margin-bottom: 1.5rem;
            }

            .brand-logo i {
                font-size: 2rem;
            }

            .branding-title {
                font-size: 1.5rem;
            }

            .auth-card {
                padding: 1.5rem;
            }

            .auth-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="brand-logo">
                    <i class="bi bi-hexagon-fill"></i>
                </div>
                <h1 class="branding-title">HC IT Solutions</h1>
                <p class="branding-subtitle">
                    Welcome to the admin dashboard. Manage your content, users, and settings with our powerful and intuitive control panel.
                </p>
                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <span class="feature-text">Secure Authentication System</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <span class="feature-text">Real-time Analytics Dashboard</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-gear-wide-connected"></i>
                        </div>
                        <span class="feature-text">Complete Content Management</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <span class="feature-text">User & Role Management</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="auth-form-section">
            <div class="auth-card">
                <div class="auth-header">
                    <h2>Welcome Back</h2>
                    <p>Sign in to access your dashboard</p>
                </div>

                @if(session('success'))
                    <div class="alert-elegant alert-success-elegant">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-elegant alert-danger-elegant">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-elegant alert-danger-elegant">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-group-elegant">
                            <input type="email"
                                   class="form-control-elegant @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email"
                                   required
                                   autofocus>
                            <i class="bi bi-envelope"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group-elegant">
                            <input type="password"
                                   class="form-control-elegant @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="Enter your password"
                                   required>
                            <i class="bi bi-lock"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check-elegant">
                        <input type="checkbox"
                               class="form-check-input-elegant"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label-elegant" for="remember">
                            Keep me signed in
                        </label>
                    </div>

                    <button type="submit" class="btn-login">
                        <span>Sign In</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>&copy; {{ date('Y') }} HC IT Solutions. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>

</html>
