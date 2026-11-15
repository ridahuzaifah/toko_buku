
@extends('layouts.user')

@section('title', 'Beranda - BOOKSPACE')

@push('styles')
<style>
    .home-hero {
        background: linear-gradient(120deg, #172B4D, #304D70);
        color: white;
        border-radius: 22px;
        padding: 45px;
        position: relative;
        overflow: hidden;
        margin-bottom: 35px;
    }

    .home-hero h1 {
        color: white;
        font-size: clamp(27px, 4vw, 40px);
        font-weight: 800;
        line-height: 1.3;
    }

    .home-hero p {
        color: rgba(255,255,255,.8);
        line-height: 1.8;
        max-width: 550px;
    }

    .home-hero-icon {
        font-size: 110px;
        color: #D6A85F;
    }

    .home-label {
        display: inline-block;
        background: rgba(214,168,95,.2);
        color: #F1C77F;
        border-radius: 30px;
        padding: 8px 14px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .home-info {
        border-radius: 15px;
        padding: 22px;
        background: white;
        box-shadow: 0 5px 22px rgba(23,43,77,.06);
        height: 100%;
    }

    .home-info i {
        font-size: 28px;
        color: #D6A85F;
    }

    .home-info h4 {
        font-size: 23px;
        font-weight: 800;
        margin-top: 12px;
    }

    .home-info p {
        color: #718096;
        font-size: 12px;
        margin-bottom: 0;
    }

    .home-book {
        height: 100%;
        border: 0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 22px rgba(23,43,77,.06);
        transition: .25s;
    }

    .home-book:hover {
        transform: translateY(-5px);
    }

    .home-book-cover {
        background: linear-gradient(145deg, #172B4D, #304D70);
        color: white;
        margin: 13px;
        border-radius: 10px;
        min-height: 150px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .home-book-cover i {
        color: #D6A85F;
        font-size: 30px;
        margin-bottom: 12px;
    }

    .home-book-cover strong {
        font-size: 13px;
        text-transform: uppercase;
    }

    .home-book-body {
        padding: 5px 17px 18px;
    }

    .home-book-body h6 {
        font-size: 13px;
        font-weight: 800;
        min-height: 38px;
    }

    .home-book-price {
        color: #247A58;
        font-weight: 800;
        font-size: 15px;
    }

    @media(max-width: 768px) {
        .home-hero {
            padding: 30px 22px;
        }

        .home-hero-icon {
            font-size: 65px;
            margin-top: 20px;
        }
    }
</style>
@endpush

@section('content')

<!-- HERO BERANDA -->
<section class="home-hero">
    <div class="row align-items-center">
        <div class="col-md-8">

            <span class="home-label">
                <i class="bi bi-stars me-1"></i>
                SELAMAT DATANG DI BOOKSPACE
            </span>

            <h1>
                Temukan Buku,<br>
                Temukan Inspirasi.
            </h1>

            <p class="mt-3">
                Selamat datang di BOOKSPACE, tempat untuk menemukan
                berbagai pilihan buku yang dapat menambah wawasan,
                pengetahuan, dan inspirasi dalam kehidupanmu.
            </p>

            <a href="{{ route('catalog.index') }}"
               class="btn btn-warning fw-bold px-4 py-3">
                <i class="bi bi-book me-2"></i>
                Jelajahi Katalog
            </a>

        </div>

        <div class="col-md-4 text-center d-none d-md-block">
            <i class="bi bi-book-half home-hero-icon"></i>
        </div>
    </div>
</section>

<!-- INFORMASI -->
<div class="row g-3 mb-5">

    <div class="col-md-6">
        <div class="home-info">
            <i class="bi bi-book-half"></i>
            <h4>{{ $totalBuku }}</h4>
            <p>Koleksi buku tersedia di BOOKSPACE</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="home-info">
            <i class="bi bi-cart-check"></i>
            <h4>Belanja Mudah</h4>
            <p>Pilih buku dan lakukan pemesanan secara online</p>
        </div>
    </div>

</div>

<!-- BUKU PILIHAN -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <span class="small fw-bold text-uppercase"
              style="color:#D6A85F;letter-spacing:2px;">
            OUR COLLECTION
        </span>

        <h3 class="fw-bold mt-1 mb-0">Buku Pilihan</h3>

        <p class="text-muted small mb-0">
            Beberapa koleksi buku yang tersedia untukmu.
        </p>
    </div>

    <a href="{{ route('catalog.index') }}"
       class="btn btn-outline-dark btn-sm">
        Lihat Semua Buku
        <i class="bi bi-arrow-right ms-1"></i>
    </a>
</div>

<div class="row g-4">

    @forelse($bukus as $buku)

        <div class="col-6 col-md-4 col-lg-3">

            <div class="home-book card">

                <div class="home-book-cover">
                    <i class="bi bi-book-half"></i>
                    <strong>{{ $buku->judul_buku }}</strong>
                </div>

                <div class="home-book-body">

                    <h6>{{ $buku->judul_buku }}</h6>

                    <p class="text-muted small mb-2">
                        <i class="bi bi-person me-1"></i>
                        {{ $buku->pengarang }}
                    </p>

                    <div class="home-book-price mb-3">
                        Rp {{ number_format($buku->harga_jual, 0, ',', '.') }}
                    </div>

                    <a href="{{ route('catalog.show', $buku->id) }}"
                       class="btn btn-primary btn-sm w-100">
                        Lihat Detail
                    </a>

                </div>
            </div>

        </div>

    @empty

        <div class="col-12">
            <div class="card p-4 text-center">
                <i class="bi bi-book fs-1 text-muted"></i>
                <h5 class="mt-3">Belum Ada Buku</h5>
                <p class="text-muted mb-0">
                    Koleksi buku akan ditampilkan di sini.
                </p>
            </div>
        </div>

    @endforelse

</div>

@endsection
