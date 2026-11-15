
@extends('layouts.user')

@section('title', 'Beranda - BOOKSPACE')

@push('styles')
<style>
   
    /* SEARCH */
    .search-card {
        margin-top: -5px;
        margin-bottom: 35px;
    }

    .search-card .form-control {
        min-height: 49px;
        border: none;
        background: #F4F6F9;
    }

    .search-card .input-group {
        background: #F4F6F9;
        border-radius: 12px;
        padding: 5px;
    }

    .search-card .input-group .form-control:focus {
        box-shadow: none;
    }

    .search-card .btn {
        padding-left: 22px;
        padding-right: 22px;
    }

    /* SECTION TITLE */
    .section-subtitle {
        color: #8792A2;
        font-size: 12px;
        margin-top: 5px;
    }

    /* BOOK CARD */
    .book-card {
        height: 100%;
        background: white;
        border: 1px solid #EEF0F3;
        border-radius: 16px;
        overflow: hidden;
        transition: all .3s ease;
    }

    .book-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 30px rgba(23,43,77,.12);
    }

    .book-cover {
        height: 190px;
        margin: 15px 15px 0;
        border-radius: 11px;
        background: linear-gradient(145deg, #172B4D, #304D70);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .book-cover::before {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 50%;
        top: -65px;
        right: -45px;
    }

    .book-cover::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border: 1px solid rgba(214,168,95,.3);
        border-radius: 50%;
        bottom: -70px;
        left: -35px;
    }

    .book-cover-content {
        position: relative;
        z-index: 1;
        color: white;
    }

    .book-cover-content i {
        display: block;
        color: #D6A85F;
        font-size: 30px;
        margin-bottom: 12px;
    }

    .book-cover-content strong {
        display: block;
        font-size: 14px;
        line-height: 1.5;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .book-cover-content small {
        display: block;
        color: rgba(255,255,255,.65);
        font-size: 9px;
        margin-top: 9px;
        letter-spacing: 2px;
    }

    .book-card-body {
        padding: 17px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 205px);
    }

    .book-year {
        display: inline-block;
        width: fit-content;
        background: #F8F0DF;
        color: #9B7131;
        font-size: 10px;
        font-weight: 700;
        border-radius: 6px;
        padding: 5px 9px;
        margin-bottom: 11px;
    }

    .book-title {
        color: #172B4D;
        font-size: 14px;
        font-weight: 800;
        line-height: 1.5;
        min-height: 42px;
        margin-bottom: 8px;
    }

    .book-author,
    .book-publisher {
        color: #8792A2;
        font-size: 11px;
        margin-bottom: 6px;
    }

    .book-price {
        color: #247A58;
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .book-stock {
        font-size: 11px;
        color: #8792A2;
        margin-bottom: 14px;
    }

    .book-stock i {
        color: #247A58;
    }

    .book-stock.out-of-stock {
        color: #C94C4C;
    }

    .book-stock.out-of-stock i {
        color: #C94C4C;
    }

    .btn-detail {
        background: #172B4D;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        text-align: center;
        display: block;
        transition: .2s;
    }

    .btn-detail:hover {
        background: #D6A85F;
        color: #172B4D;
    }

    .book-empty {
        background: white;
        border-radius: 16px;
        padding: 50px 20px;
        text-align: center;
    }

    .book-empty i {
        color: #D6A85F;
        font-size: 45px;
    }

    .book-empty h5 {
        margin-top: 15px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .hero-bookspace {
            padding: 32px 24px;
        }

        .hero-bookspace .hero-icon {
            font-size: 65px;
            margin-top: 20px;
        }

        .book-cover {
            height: 165px;
        }

        .book-card-body {
            height: calc(100% - 180px);
        }
    }
</style>
@endpush

@section('content')

<!-- HERO BANNER -->
<section class="hero-bookspace">
    <div class="hero-decoration"></div>

    <div class="row align-items-center position-relative">
        <div class="col-md-8">
            <span class="hero-label">
                <i class="bi bi-stars me-1"></i>
                WELCOME TO BOOKSPACE
            </span>

            <h1>
                Temukan Buku,<br>
                Temukan Inspirasi.
            </h1>

            <p class="mt-3 mb-4">
                Jelajahi berbagai koleksi buku pilihan untuk menambah
                pengetahuan, mengembangkan kreativitas, dan menemukan
                inspirasi baru setiap hari.
            </p>

            <a href="#koleksi-buku" class="btn btn-warning fw-bold px-4 py-3">
                Jelajahi Koleksi
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="col-md-4 text-center d-none d-md-block">
            <i class="bi bi-book-half hero-icon"></i>
        </div>
    </div>
</section>

<!-- SEARCH -->
<div class="card search-card">
    <div class="card-body p-3 p-md-4">
        <div class="mb-3">
            <h5 class="fw-bold mb-1">Cari Buku Favoritmu</h5>
            <p class="text-muted small mb-0">
                Temukan buku berdasarkan judul, pengarang, penerbit, atau kode buku.
            </p>
        </div>

        <form action="{{ route('catalog.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text border-0 bg-transparent">
                    <i class="bi bi-search text-muted"></i>
                </span>

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Masukkan kata kunci pencarian..."
                    value="{{ $search ?? '' }}"
                >

                <button type="submit" class="btn btn-primary">
                    Cari Buku
                </button>

                @if(!empty($search))
                    <a href="{{ route('catalog.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- BOOK COLLECTION -->
<div id="koleksi-buku">

    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
        <div>
            <span class="text-uppercase fw-bold small"
                  style="color:#D6A85F; letter-spacing:2px;">
                BOOK COLLECTION
            </span>

            <h3 class="fw-bold mb-0 mt-1">Koleksi Buku</h3>

            <p class="section-subtitle mb-0">
                Pilih buku yang ingin kamu baca dan pelajari.
            </p>
        </div>

        <span class="badge rounded-pill px-3 py-2"
              style="background:#E8EDF4;color:#172B4D;">
            <i class="bi bi-book me-1"></i>
            {{ $bukus->total() }} Buku Ditemukan
        </span>
    </div>

    <div class="row g-4">

        @forelse($bukus as $buku)

            <div class="col-6 col-md-4 col-lg-3">

                <div class="book-card">

                    <!-- COVER BUKU -->
                    <div class="book-cover">
                        <div class="book-cover-content">
                            <i class="bi bi-book-half"></i>

                            <strong>
                                {{ $buku->judul_buku }}
                            </strong>

                            <small>BOOKSPACE COLLECTION</small>
                        </div>
                    </div>

                    <!-- INFORMASI BUKU -->
                    <div class="book-card-body">

                        <span class="book-year">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $buku->tahun_terbit ?: 'Tahun tidak tersedia' }}
                        </span>

                        <h5 class="book-title">
                            {{ $buku->judul_buku }}
                        </h5>

                        <p class="book-author">
                            <i class="bi bi-person me-1"></i>
                            {{ $buku->pengarang }}
                        </p>

                        <p class="book-publisher">
                            <i class="bi bi-building me-1"></i>
                            {{ $buku->penerbit }}
                        </p>

                        <div class="mt-auto">

                            <div class="book-price">
                                Rp {{ number_format($buku->harga_jual, 0, ',', '.') }}
                            </div>

                            @if($buku->stok > 0)
                                <p class="book-stock">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Stok tersedia: {{ $buku->stok }}
                                </p>
                            @else
                                <p class="book-stock out-of-stock">
                                    <i class="bi bi-x-circle-fill me-1"></i>
                                    Stok habis
                                </p>
                            @endif

                            <a href="{{ route('catalog.show', $buku->id) }}"
                               class="btn-detail">
                                Lihat Detail
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="book-empty">
                    <i class="bi bi-book"></i>

                    @if(!empty($search))
                        <h5>Buku Tidak Ditemukan</h5>

                        <p class="text-muted">
                            Tidak ada buku yang cocok dengan kata kunci
                            "{{ $search }}".
                        </p>

                        <a href="{{ route('catalog.index') }}"
                           class="btn btn-primary mt-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Tampilkan Semua Buku
                        </a>
                    @else
                        <h5>Belum Ada Koleksi Buku</h5>

                        <p class="text-muted mb-0">
                            Saat ini belum ada buku yang tersedia di katalog.
                        </p>
                    @endif
                </div>
            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    @if($bukus->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $bukus->links() }}
        </div>
    @endif

</div>

@endsection
