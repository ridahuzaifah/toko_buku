
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'BOOKSPACE')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --primary: #172B4D;
            --primary-light: #263F63;
            --cream: #F7F4ED;
            --gold: #D6A85F;
            --text: #263238;
            --muted: #718096;
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--cream);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
        }

        /* NAVBAR */
        .navbar-bookspace {
            background: var(--primary);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(23,43,77,.15);
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: white !important;
        }

        .navbar-brand i {
            color: var(--gold);
        }

        .navbar-bookspace .nav-link {
            color: rgba(255,255,255,.75);
            font-size: 13px;
            font-weight: 600;
            padding: 10px 13px !important;
            border-radius: 8px;
            transition: all .25s ease;
        }

        .navbar-bookspace .nav-link:hover,
        .navbar-bookspace .nav-link.active {
            color: white;
            background: rgba(255,255,255,.13);
        }

        .navbar-toggler {
            border-color: rgba(255,255,255,.3);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* USER NAVBAR */
        .user-name {
            color: white;
            font-size: 13px;
            font-weight: 600;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(214,168,95,.2);
            color: var(--gold);
            border-radius: 50%;
            font-size: 16px;
        }

        .btn-logout {
            background: #C94C4C;
            border: none;
            color: white;
            font-size: 12px;
            font-weight: 600;
            border-radius: 8px;
            padding: 9px 13px;
            transition: .2s;
        }

        .btn-logout:hover {
            background: #A93636;
            color: white;
            transform: translateY(-2px);
        }

        /* MAIN CONTENT */
        .main-content {
            min-height: 80vh;
            padding-top: 35px;
            padding-bottom: 45px;
        }

        /* HEADING */
        h1, h2, h3, h4, h5, h6 {
            color: var(--primary);
            font-weight: 700;
        }

        /* CARD */
        .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 5px 22px rgba(23,43,77,.06) !important;
            overflow: hidden;
        }

        .card-body {
            padding: 22px;
        }

        /* PRODUCT CARD */
        .product-card {
            height: 100%;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 13px 30px rgba(23,43,77,.13) !important;
        }

        /* BUTTON */
        .btn {
            border-radius: 9px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .btn-primary,
        .btn-dark {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover,
        .btn-dark:hover {
            background: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-1px);
        }

        .btn-success {
            background: #247A58;
            border-color: #247A58;
        }

        .btn-success:hover {
            background: #1D6347;
            border-color: #1D6347;
        }

        .btn-outline-dark {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-dark:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* FORM */
        .form-control,
        .form-select {
            border: 1px solid #DFE3E8;
            border-radius: 9px;
            padding: 11px 13px;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 .2rem rgba(214,168,95,.15);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            font-size: 13px;
        }

        /* TABLE */
        .table {
            --bs-table-bg: transparent;
            vertical-align: middle;
        }

        .table thead th {
            background: #F1F3F6;
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            padding: 15px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px;
            font-size: 13px;
        }

        /* BADGE */
        .badge {
            border-radius: 7px;
            padding: 7px 10px;
            font-weight: 600;
        }

        /* ALERT */
        .alert {
            border: none;
            border-radius: 12px;
            font-size: 13px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        /* FOOTER */
        .footer-bookspace {
            background: var(--primary);
            color: white;
            padding: 25px 15px;
            text-align: center;
        }

        .footer-bookspace p {
            font-size: 12px;
            color: rgba(255,255,255,.75);
        }

        .footer-brand {
            color: var(--gold);
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .navbar-bookspace .navbar-nav {
                padding-top: 15px;
            }

            .navbar-bookspace .nav-link {
                margin-bottom: 4px;
            }

            .user-section {
                padding-top: 15px;
                margin-top: 10px;
                border-top: 1px solid rgba(255,255,255,.15);
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 19px;
            }

            .main-content {
                padding-top: 22px;
                padding-bottom: 30px;
            }

            .card-body {
                padding: 17px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-bookspace">
        <div class="container">

            <!-- LOGO: KEMBALI KE BERANDA -->
            <a class="navbar-brand" href="{{ route('user.home') }}">
                <i class="bi bi-book-half me-2"></i>BOOKSPACE
            </a>

            <!-- MOBILE TOGGLER -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarUser"
                    aria-controls="navbarUser"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarUser">

                <!-- MENU -->
                <ul class="navbar-nav me-auto ms-lg-4">

                    <!-- BERANDA -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}"
                           href="{{ route('user.home') }}">
                            <i class="bi bi-house me-1"></i>
                            Beranda
                        </a>
                    </li>

                    <!-- KATALOG BUKU -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}"
                           href="{{ route('catalog.index') }}">
                            <i class="bi bi-book me-1"></i>
                            Katalog Buku
                        </a>
                    </li>

                    <!-- KERANJANG -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('keranjang.*') || request()->routeIs('checkout.*') ? 'active' : '' }}"
                           href="{{ route('keranjang.index') }}">
                            <i class="bi bi-cart3 me-1"></i>
                            Keranjang
                        </a>
                    </li>

                    <!-- RIWAYAT PESANAN -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pesanan.*') ? 'active' : '' }}"
                           href="{{ route('pesanan.index') }}">
                            <i class="bi bi-receipt me-1"></i>
                            Riwayat Pesanan
                        </a>
                    </li>

                </ul>

                <!-- USER INFO & LOGOUT -->
                <div class="d-flex align-items-center gap-3 flex-wrap user-section">

                    <div class="d-flex align-items-center gap-2">
                        <span class="user-avatar">
                            <i class="bi bi-person-fill"></i>
                        </span>

                        <span class="user-name">
                            {{ Auth::user()->name }}
                        </span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-logout">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="container main-content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="footer-bookspace">
        <p class="mb-1">
            <span class="footer-brand">BOOKSPACE</span>
            <span class="mx-1">|</span>
            Temukan Buku, Temukan Inspirasi.
        </p>

        <p class="mb-0">
            &copy; {{ date('Y') }} BOOKSPACE.
            Semua Hak Dilindungi.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
