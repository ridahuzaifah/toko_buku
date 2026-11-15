
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun - BOOKSPACE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #172b45;
            --orange: #e98b50;
            --cream: #faf8f3;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            font-family: "Segoe UI", sans-serif;
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .register-card {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 38px;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(23, 43, 69, .10);
        }

        .brand-icon {
            width: 65px;
            height: 65px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            border-radius: 18px;
            background: var(--navy);
            color: var(--orange);
            font-size: 32px;
        }

        .brand-title {
            color: var(--navy);
            font-weight: 800;
            letter-spacing: 1px;
        }

        .form-label {
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
        }

        .form-control {
            padding: 11px 13px;
            border-radius: 9px;
            border: 1px solid #e1e5ea;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(233, 139, 80, .12);
        }

        .btn-register {
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 12px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-register:hover {
            background: var(--orange);
            color: white;
            transform: translateY(-2px);
        }

        .login-link {
            color: var(--orange);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover {
            color: var(--navy);
        }

        .alert {
            border: none;
            border-radius: 9px;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

<div class="register-wrapper">

    <div class="register-card">

        {{-- Identitas BOOKSPACE --}}
        <div class="text-center mb-4">

            <div class="brand-icon">
                <i class="bi bi-journal-richtext"></i>
            </div>

            <h2 class="brand-title mb-1">BOOKSPACE</h2>

            <p class="text-muted small mb-0">
                Buat akun baru untuk mulai menjelajahi buku.
            </p>

        </div>

        {{-- Pesan Kesalahan --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Pendaftaran --}}
        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    required
                    autofocus
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    Alamat Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="Masukkan ulang password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-register w-100">
                <i class="bi bi-person-plus me-2"></i>
                Daftar Sekarang
            </button>

        </form>

        {{-- Link Login --}}
        <div class="text-center mt-4">

            <p class="text-muted small mb-0">
                Sudah memiliki akun?

                <a href="{{ route('login') }}" class="login-link">
                    Masuk di sini
                </a>
            </p>

        </div>

        <div class="text-center mt-4">
            <small class="text-muted">
                BOOKSPACE &copy; {{ date('Y') }}
            </small>
        </div>

    </div>

</div>

</body>
</html>
