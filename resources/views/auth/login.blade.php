
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - BOOKSPACE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #172b45;
            --orange: #e98b50;
            --cream: #faf8f3;
            --text: #263449;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            font-family: "Segoe UI", sans-serif;
            color: var(--text);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border: none;
            border-radius: 20px;
            padding: 38px;
            box-shadow: 0 15px 45px rgba(23, 43, 69, 0.10);
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: var(--navy);
            color: var(--orange);
            font-size: 34px;
        }

        .brand-title {
            color: var(--navy);
            font-size: 29px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            color: #8993a1;
            font-size: 14px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: var(--navy);
        }

        .input-group {
            border: 1px solid #e4e8ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .input-group-text {
            background: #fff;
            border: none;
            color: #8b96a5;
            padding-left: 14px;
        }

        .form-control {
            border: none;
            box-shadow: none !important;
            padding: 12px 10px;
            font-size: 14px;
        }

        .input-group:focus-within {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(233, 139, 80, 0.12);
        }

        .password-toggle {
            border: none;
            background: #fff;
            color: #8993a1;
            padding: 0 14px;
        }

        .password-toggle:hover {
            color: var(--orange);
        }

        .form-check-input:checked {
            background-color: var(--orange);
            border-color: var(--orange);
        }

        .btn-login {
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: var(--orange);
            color: #fff;
            transform: translateY(-2px);
        }

        .alert {
            border: none;
            border-radius: 10px;
            font-size: 13px;
        }

        .register-link {
            color: var(--orange);
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .register-link:hover {
            color: var(--navy);
            text-decoration: underline;
        }

        .login-footer {
            font-size: 12px;
            color: #a0a8b3;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 28px 22px;
            }

            .brand-title {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        {{-- Logo dan Identitas --}}
        <div class="text-center mb-4">

            <div class="brand-icon">
                <i class="bi bi-journal-richtext"></i>
            </div>

            <h2 class="brand-title mb-1">
                BOOKSPACE
            </h2>

            <p class="brand-subtitle mb-0">
                Sistem Informasi Toko Buku
            </p>

            <div class="mt-3">
                <span class="text-muted small">
                    Silakan masuk ke akun Anda
                </span>
            </div>

        </div>

        {{-- Pesan Berhasil --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan Kesalahan --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-3">

                <label for="email" class="form-label">
                    Alamat Email
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

            </div>

            {{-- Password --}}
            <div class="mb-3">

                <label for="password" class="form-label">
                    Password
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                    >
                        <i class="bi bi-eye" id="passwordIcon"></i>
                    </button>

                </div>

            </div>

            {{-- Ingat Saya --}}
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="form-check">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="form-check-input"
                        id="remember"
                    >

                    <label class="form-check-label small" for="remember">
                        Ingat saya
                    </label>
                </div>

            </div>

            {{-- Tombol Login --}}
            <button type="submit" class="btn btn-login w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Masuk ke BOOKSPACE
            </button>

        </form>

        {{-- Link Pendaftaran --}}
        <div class="text-center mt-4">
            <p class="text-muted small mb-0">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="register-link">
                    Daftar sekarang
                </a>
            </p>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-4">
            <p class="login-footer mb-0">
                BOOKSPACE &copy; {{ date('Y') }}
                <br>
                Sistem Informasi Manajemen Toko Buku
            </p>
        </div>

    </div>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    togglePassword.addEventListener('click', function () {

        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        passwordIcon.classList.toggle('bi-eye', !isPassword);
        passwordIcon.classList.toggle('bi-eye-slash', isPassword);

        togglePassword.setAttribute(
            'aria-label',
            isPassword ? 'Sembunyikan password' : 'Tampilkan password'
        );

    });
</script>

</body>
</html>
