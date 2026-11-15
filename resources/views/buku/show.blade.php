
@extends('layouts.app')

@section('title', 'Detail Buku')
@section('page-heading', 'Detail Buku')

@section('content')

<div class="content-card">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Informasi Detail Buku</h5>
            <p class="text-muted mb-0">
                Informasi lengkap mengenai buku yang dipilih.
            </p>
        </div>

        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Informasi Buku --}}
    <div class="row g-4">

        <div class="col-md-8">

            <div class="mb-4">
                <small class="text-muted">Kode Buku</small>
                <h6 class="fw-bold">{{ $buku->kode_buku }}</h6>
            </div>

            <div class="mb-4">
                <small class="text-muted">Judul Buku</small>
                <h4 class="fw-bold">{{ $buku->judul_buku }}</h4>
            </div>

            <div class="row">
                <div class="col-sm-6 mb-3">
                    <small class="text-muted">Pengarang</small>
                    <p class="fw-semibold mb-0">{{ $buku->pengarang }}</p>
                </div>

                <div class="col-sm-6 mb-3">
                    <small class="text-muted">Penerbit</small>
                    <p class="fw-semibold mb-0">{{ $buku->penerbit }}</p>
                </div>

                <div class="col-sm-6 mb-3">
                    <small class="text-muted">Tahun Terbit</small>
                    <p class="fw-semibold mb-0">{{ $buku->tahun_terbit }}</p>
                </div>

                <div class="col-sm-6 mb-3">
                    <small class="text-muted">Stok Buku</small>
                    <p class="fw-semibold mb-0">
                        @if($buku->stok > 10)
                            <span class="badge bg-success">
                                {{ $buku->stok }} Buku
                            </span>
                        @elseif($buku->stok > 0)
                            <span class="badge bg-warning text-dark">
                                {{ $buku->stok }} Buku (Menipis)
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Habis
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            <hr>

            <h6 class="fw-bold mb-3">Keterangan</h6>

            <p class="text-muted">
                {{ $buku->keterangan ?: 'Tidak ada keterangan untuk buku ini.' }}
            </p>

        </div>

        {{-- Informasi Harga --}}
        <div class="col-md-4">

            <div class="p-3 rounded-3 bg-light mb-3">
                <small class="text-muted">Harga Beli</small>
                <h5 class="fw-bold mb-0">
                    Rp {{ number_format($buku->harga_beli, 0, ',', '.') }}
                </h5>
            </div>

            <div class="p-3 rounded-3 bg-light mb-3">
                <small class="text-muted">Harga Jual</small>
                <h5 class="fw-bold mb-0">
                    Rp {{ number_format($buku->harga_jual, 0, ',', '.') }}
                </h5>
            </div>

            <div class="p-3 rounded-3 bg-light">
                <small class="text-muted">Selisih Harga</small>
                <h5 class="fw-bold mb-0">
                    Rp {{ number_format($buku->harga_jual - $buku->harga_beli, 0, ',', '.') }}
                </h5>
            </div>

        </div>

    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex gap-2 mt-4 pt-3 border-top">

        <a href="{{ route('buku.edit', $buku->id) }}"
            class="btn btn-orange">
            <i class="bi bi-pencil-square"></i> Edit Buku
        </a>

        <a href="{{ route('buku.index') }}"
            class="btn btn-secondary">
            Kembali ke Daftar
        </a>

    </div>

</div>

@endsection
