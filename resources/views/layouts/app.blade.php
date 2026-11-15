
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') - BOOKSPACE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy: #172b45;
            --navy-light: #223b5b;
            --cream: #faf8f3;
            --orange: #e98b50;
            --orange-hover: #d9773c;
            --text: #263445;
            --muted: #8993a1;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--cream);
            color: var(--text);
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* SIDEBAR */

        .sidebar {
            width: 255px;
            height: 100vh;
            background: var(--navy);
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 16px;
            color: white;
            z-index: 1050;
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.12);
            margin-bottom: 25px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--orange);
            border-radius: 12px;
            font-size: 22px;
        }

        .brand h4 {
            font-size: 21px;
            font-weight: 800;
            margin: 0;
            letter-spacing: .5px;
        }

        .menu-label {
            color: #94a4b8;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #dce3ec;
            text-decoration: none;
            padding: 13px 14px;
            border-radius: 10px;
            margin-bottom: 7px;
            font-size: 14px;
            transition: .2s ease;
        }

        .sidebar a i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .sidebar a:hover {
            background: var(--navy-light);
            color: white;
        }

        .sidebar a.active {
            background: var(--orange);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(233,139,80,.2);
        }

        .sidebar-divider {
            border-color: rgba(255,255,255,.15);
            margin: 22px 0;
        }

        .sidebar-bottom {
            margin-top: 35px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border: none;
            border-radius: 10px;
            background: #dc3545;
            color: white;
            width: 100%;
            text-align: left;
            font-size: 14px;
            transition: .2s;
        }

        .logout-btn:hover {
            background: #bb2d3b;
        }

        /* MAIN CONTENT */

        .main-content {
            margin-left: 255px;
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .page-heading {
            font-size: 24px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 5px;
        }

        .page-description {
            font-size: 13px;
            color: var(--muted);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff0e5;
            color: var(--orange);
            border-radius: 50%;
            font-size: 20px;
        }

        .profile-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
        }

        .profile-role {
            font-size: 11px;
            color: var(--muted);
        }

        /* CONTENT CARD */

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
        }

        .btn-orange {
            background: var(--orange);
            color: white;
            border: none;
            transition: .2s;
        }

        .btn-orange:hover {
            background: var(--orange-hover);
            color: white;
        }

        /* ALERT */

        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        /* BACK TO TOP */

        .back-to-top {
            position: fixed;
            right: 25px;
            bottom: 25px;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            background: var(--orange);
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,.15);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .back-to-top.show {
            display: flex;
        }

        /* MOBILE */

        .mobile-toggle {
            display: none;
            border: none;
            background: var(--navy);
            color: white;
            padding: 9px 13px;
            border-radius: 9px;
            font-size: 20px;
        }

        .sidebar-overlay {
            display: none;
        }

        @media(max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
                width: 270px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 1040;
            }

            .main-content {
                margin-left: 0;
                padding: 18px;
            }

            .mobile-toggle {
                display: inline-block;
            }

            .page-heading {
                font-size: 20px;
            }

            .topbar {
                align-items: flex-start;
            }

            .admin-profile {
                width: 100%;
            }

            .content-card {
                padding: 18px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

{{-- SIDEBAR --}}
<aside class="sidebar" id="adminSidebar">

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-book-half"></i>
        </div>

        <div>
            <h4>BOOKSPACE</h4>
            <small class="text-white-50">Admin Panel</small>
        </div>
    </div>

    <div class="menu-label">MENU UTAMA</div>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('buku.index') }}"
       class="{{ request()->routeIs('buku.index', 'buku.show', 'buku.edit') ? 'active' : '' }}">
        <i class="bi bi-book"></i>
        <span>Data Buku</span>
    </a>

    <a href="{{ route('buku.create') }}"
       class="{{ request()->routeIs('buku.create') ? 'active' : '' }}">
        <i class="bi bi-plus-circle"></i>
        <span>Tambah Buku</span>
    </a>

    <a href="{{ route('activity-logs.index') }}"
       class="{{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i>
        <span>Riwayat Aktivitas</span>
    </a>

    <hr class="sidebar-divider">

    <div class="menu-label">AKUN</div>

    <div class="sidebar-bottom">

        <div class="px-2 mb-3">
            <small class="text-white-50">Login sebagai</small>

            <div class="fw-semibold mt-1">
                {{ Auth::user()->name ?? 'Admin' }}
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>

<div class="sidebar-overlay"
     id="sidebarOverlay"
     onclick="toggleSidebar()"></div>

{{-- MAIN --}}
<main class="main-content">

    {{-- TOPBAR --}}
    <header class="topbar">

        <div class="d-flex align-items-center gap-3">

            <button type="button"
                    class="mobile-toggle"
                    onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <h4 class="page-heading">
                    @yield('page-heading', 'Dashboard BOOKSPACE')
                </h4>

                <div class="page-description">
                    BOOKSPACE Management System
                </div>
            </div>

        </div>

        <div class="admin-profile">

            <div class="profile-icon">
                <i class="bi bi-person-fill"></i>
            </div>

            <div>
                <div class="profile-name">
                    {{ Auth::user()->name ?? 'Admin' }}
                </div>

                <div class="profile-role">
                    {{ ucfirst(Auth::user()->role ?? 'admin') }}
                </div>
            </div>

        </div>

    </header>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>
    @endif

    {{-- KONTEN --}}
    @yield('content')

    {{-- FOOTER --}}
    <footer class="text-center text-muted small mt-5">
        &copy; {{ date('Y') }} BOOKSPACE.
        All Rights Reserved.
    </footer>

</main>

{{-- TOMBOL KEMBALI KE ATAS --}}
<button type="button"
        class="back-to-top"
        id="backToTop"
        title="Kembali ke atas">
    <i class="bi bi-arrow-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('adminSidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    // Menutup sidebar setelah memilih menu di perangkat mobile
    document.querySelectorAll('#adminSidebar a').forEach(function(link) {
        link.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
    });

    // Tombol kembali ke atas
    const backToTop = document.getElementById('backToTop');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

@stack('scripts')

</body>
</html>
