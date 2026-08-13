<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - 99 Bakery Jember</title>

    <!-- Favicon / Logo -->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">

    <!-- Local Web Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">

    <!-- Bootstrap 5.3 CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

    <!-- Base Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Admin Style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/admin-style.css') }}">

    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            background:
                radial-gradient(circle at top right,
                    rgba(198, 40, 40, 0.08),
                    transparent 40%),
                radial-gradient(circle at bottom left,
                    rgba(255, 179, 0, 0.1),
                    transparent 40%),
                var(--bg-section-warm);

            padding: 1.5rem;
        }

        .login-card {
            background: #FFFFFF;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: 0 16px 40px rgba(198, 40, 40, 0.08);
            max-width: 420px;
            width: 100%;
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg,
                    var(--primary-red),
                    var(--primary-dark));

            color: #FFFFFF;
            padding: 2.25rem 2rem 2rem;
            text-align: center;
            position: relative;
        }

        .login-brand-img {
            width: 90px;
            height: auto;
            border-radius: 12px;
            border: 2px solid #FFFFFF;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .login-title {
            color: #fff;
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 2px;
        }

        .login-subtitle {
            font-size: 0.82rem;
            opacity: 0.9;
        }

        .login-body {
            padding: 2rem;
        }

        .login-alert {
            font-size: 0.82rem;
            border-radius: 10px;
        }

        .password-toggle {
            cursor: pointer;
        }

        .password-toggle:hover {
            background-color: #f8f9fa;
        }

        .login-input:focus {
            box-shadow: none;
        }
    </style>
</head>

<body class="admin-body">

    <div class="login-container">

        <div class="login-card">

            <!-- HEADER -->
            <div class="login-header">

                <img src="{{ asset('img/logo.jpeg') }}" alt="99 Bakery Logo" class="login-brand-img">

                <h4 class="login-title">
                    99 BAKERY JEMBER
                </h4>

                <p class="login-subtitle mb-0">
                    Portal Masuk Admin Landing Page
                </p>

            </div>


            <!-- BODY -->
            <div class="login-body">

                {{-- =========================================
                    SUCCESS MESSAGE
                ========================================== --}}
                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show login-alert d-flex align-items-center"
                        role="alert">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        <div>
                            {{ session('success') }}
                        </div>

                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
                        </button>

                    </div>
                @endif


                {{-- ERROR MESSAGE --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show login-alert d-flex align-items-center"
                        role="alert">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        <div>
                            {{ session('error') }}
                        </div>

                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close">
                        </button>

                    </div>
                @endif


                {{-- VALIDATION ERROR --}}
                @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show login-alert" role="alert">

                        <div class="fw-bold mb-1">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Terjadi kesalahan:
                        </div>

                        <ul class="mb-0 ps-3">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>

                    </div>

                @endif


                {{-- =========================================
                    LOGIN FORM
                ========================================== --}}
                <form action="{{ route('admin.login.process') }}" method="POST">

                    @csrf


                    {{-- EMAIL --}}
                    <div class="mb-3">

                        <label for="email" class="form-label small fw-bold text-dark">

                            Email / Username Admin

                        </label>


                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">

                                <i class="bi bi-person-fill text-muted"></i>

                            </span>


                            <input type="email" name="email" id="email"
                                class="form-control login-input border-start-0 ps-0 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="admin@99bakery.com" autocomplete="email"
                                required autofocus>

                        </div>


                        @error('email')
                            <div class="text-danger small mt-1">

                                <i class="bi bi-exclamation-circle me-1"></i>
                                {{ $message }}

                            </div>
                        @enderror

                    </div>


                    {{-- PASSWORD --}}
                    <div class="mb-3">

                        <label for="passwordInput" class="form-label small fw-bold text-dark">

                            Kata Sandi (Password)

                        </label>


                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">

                                <i class="bi bi-lock-fill text-muted"></i>

                            </span>


                            <input type="password" name="password" id="passwordInput"
                                class="form-control login-input border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror"
                                placeholder="Masukkan password" autocomplete="current-password" required>


                            <!-- BUTTON SHOW PASSWORD -->
                            <button class="btn btn-light border border-start-0 password-toggle" type="button"
                                id="togglePassword" aria-label="Tampilkan password">

                                <i class="bi bi-eye-fill text-muted" id="passwordIcon">
                                </i>

                            </button>

                        </div>


                        @error('password')
                            <div class="text-danger small mt-1">

                                <i class="bi bi-exclamation-circle me-1"></i>
                                {{ $message }}

                            </div>
                        @enderror

                    </div>


                    {{-- REMEMBER + FORGOT PASSWORD --}}
                    <div class="d-flex justify-content-between align-items-center mb-4" style="font-size: 0.83rem;">

                        {{-- <div class="form-check mb-0">

                            <input class="form-check-input" type="checkbox" name="remember" value="1"
                                id="rememberMe">

                            <label class="form-check-label text-muted" for="rememberMe">

                                Ingat Saya

                            </label>

                        </div> --}}


                        {{-- <a href="#"
                            onclick="alert('Silakan hubungi Super Admin untuk mereset kata sandi Anda.'); return false;"
                            class="text-danger fw-semibold text-decoration-none">

                            Lupa Password?

                        </a> --}}

                    </div>


                    {{-- LOGIN BUTTON --}}
                    <button type="submit" class="btn btn-danger w-100 py-2 rounded-pill fw-bold text-white shadow-sm"
                        style="
                            background-color: var(--primary-red);
                            border: none;
                        ">

                        <i class="bi bi-box-arrow-in-right me-1"></i>

                        Login

                    </button>

                </form>


                <!-- BACK TO PUBLIC WEBSITE -->
                <div class="mt-4 pt-3 border-top text-center" style="font-size: 0.8rem;">

                    <a href="{{ route('home') }}" class="text-muted text-decoration-none">

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali ke Website Publik

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap JS -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- PASSWORD TOGGLE -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const passwordInput = document.getElementById('passwordInput');
            const togglePassword = document.getElementById('togglePassword');
            const passwordIcon = document.getElementById('passwordIcon');

            togglePassword.addEventListener('click', function() {

                const isPassword =
                    passwordInput.type === 'password';

                if (isPassword) {

                    passwordInput.type = 'text';

                    passwordIcon.classList.remove(
                        'bi-eye-fill'
                    );

                    passwordIcon.classList.add(
                        'bi-eye-slash-fill'
                    );

                    togglePassword.setAttribute(
                        'aria-label',
                        'Sembunyikan password'
                    );

                } else {

                    passwordInput.type = 'password';

                    passwordIcon.classList.remove(
                        'bi-eye-slash-fill'
                    );

                    passwordIcon.classList.add(
                        'bi-eye-fill'
                    );

                    togglePassword.setAttribute(
                        'aria-label',
                        'Tampilkan password'
                    );

                }

            });

        });
    </script>

</body>

</html>
