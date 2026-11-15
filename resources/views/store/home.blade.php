
@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard BOOKSPACE')

@section('content')

{{-- Statistik Utama --}}
<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Buku</p>
                    <h3 class="fw-bold mb-0">
                        {{ number_format($totalBuku, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted">Jenis koleksi buku</small>
                </div>
                <div class="fs-1" style="color: #e98b50;">
                    <i class="bi bi-book-half"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Stok</p>
                    <h3 class="fw-bold mb-0">
                        {{ number_format($totalStok, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted">Seluruh persediaan buku</small>
                </div>
                <div class="fs-1 text-success">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Stok Menipis</p>
                    <h3 class="fw-bold mb-0">
                        {{ number_format($stokMenipis, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted">Stok 1 sampai 10 buku</small>
                </div>
                <div class="fs-1 text-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Stok Habis</p>
                    <h3 class="fw-bold mb-0">
                        {{ number_format($stokHabis, 0, ',', '.') }}
                    </h3>
                    <small class="text-muted">Buku tidak tersedia</small>
                </div>
                <div class="fs-1 text-danger">
                    <i class="bi bi-x-circle"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Nilai Persediaan --}}
<div class="content-card mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <p class="text-muted mb-1">Total Nilai Persediaan</p>
            <h3 class="fw-bold mb-1" style="color: #e98b50;">
                Rp {{ number_format($nilaiPersediaan, 0, ',', '.') }}
            </h3>
            <small class="text-muted">
                Harga beli dikalikan jumlah stok
            </small>
        </div>

        <div class="fs-1 text-primary">
            <i class="bi bi-cash-stack"></i>
        </div>
    </div>
</div>

{{-- Sambutan Admin --}}
<div class="content-card mb-4"
     style="background: #172b45; color: white;">

    <div class="row align-items-center">
        <div class="col-md-8">
            <span class="badge mb-3"
                  style="background: #e98b50; color: white;">
                ADMIN PANEL
            </span>

            <h3 class="fw-bold mb-2">
                Selamat Datang di BOOKSPACE!
            </h3>

            <p class="mb-3" style="color: #dce3ec;">
                Kelola koleksi buku, persediaan, dan informasi toko
                melalui sistem manajemen BOOKSPACE.
            </p>

            <a href="{{ route('buku.create') }}" class="btn btn-orange">
                <i class="bi bi-plus-circle me-1"></i>
                Tambah Buku Baru
            </a>
        </div>

        <div class="col-md-4 text-center d-none d-md-block">
            <i class="bi bi-journal-richtext"
               style="font-size: 100px; color: #e98b50;"></i>
        </div>
    </div>

</div>

{{-- Menu Cepat --}}
<div class="row g-3 mb-4">

    <div class="col-md-6">
        <a href="{{ route('buku.index') }}"
           class="content-card d-flex align-items-center gap-3 text-decoration-none text-dark h-100">

            <div class="fs-2 text-primary">
                <i class="bi bi-collection"></i>
            </div>

            <div>
                <h6 class="fw-bold mb-1">Kelola Data Buku</h6>
                <small class="text-muted">
                    Lihat, tambah, edit, dan hapus buku.
                </small>
            </div>

            <div class="ms-auto">
                <i class="bi bi-arrow-right"></i>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('activity-logs.index') }}"
           class="content-card d-flex align-items-center gap-3 text-decoration-none text-dark h-100">

            <div class="fs-2 text-success">
                <i class="bi bi-clock-history"></i>
            </div>

            <div>
                <h6 class="fw-bold mb-1">Riwayat Aktivitas</h6>
                <small class="text-muted">
                    Lihat catatan aktivitas sistem.
                </small>
            </div>

            <div class="ms-auto">
                <i class="bi bi-arrow-right"></i>
            </div>
        </a>
    </div>

</div>

{{-- Buku Terbaru --}}
<div class="content-card">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Buku Terbaru</h5>
            <p class="text-muted mb-0">
                Lima koleksi buku yang terakhir ditambahkan.
            </p>
        </div>

        <a href="{{ route('buku.index') }}"
           class="btn btn-outline-secondary btn-sm">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                </tr>
            </thead>

            <tbody>
                @forelse($bukus as $buku)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $buku->kode_buku }}
                            </span>
                        </td>

                        <td class="fw-semibold">
                            {{ $buku->judul_buku }}
                        </td>

                        <td>{{ $buku->pengarang }}</td>

                        <td>{{ $buku->penerbit }}</td>

                        <td class="text-nowrap">
                            Rp {{ number_format($buku->harga_jual, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($buku->stok > 10)
                                <span class="badge bg-success">
                                    {{ $buku->stok }} tersedia
                                </span>
                            @elseif($buku->stok > 0)
                                <span class="badge bg-warning text-dark">
                                    {{ $buku->stok }} tersisa
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Habis
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-book fs-2 d-block mb-2"></i>
                            Belum ada data buku.

                            <div class="mt-3">
                                <a href="{{ route('buku.create') }}"
                                   class="btn btn-orange btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Tambahkan Buku
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
