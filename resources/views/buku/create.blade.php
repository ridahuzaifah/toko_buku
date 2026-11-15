
@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('page-heading', 'Tambah Data Buku')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Form Tambah Buku</h5>
            <p class="text-muted mb-0">
                Masukkan informasi buku yang akan ditambahkan ke katalog.
            </p>
        </div>

        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('buku.store') }}" method="POST">
        @csrf

        {{-- Kode Buku --}}
        <div class="mb-3">
            <label for="kode_buku" class="form-label fw-semibold">
                Kode Buku
            </label>

            <input
                type="text"
                id="kode_buku"
                name="kode_buku"
                class="form-control bg-light"
                value="{{ old('kode_buku', $kodeBuku ?? '') }}"
                readonly
            >

            <small class="text-muted">
                <i class="bi bi-info-circle"></i>
                Kode buku dibuat secara otomatis oleh sistem.
            </small>

            @error('kode_buku')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Judul Buku --}}
        <div class="mb-3">
            <label for="judul_buku" class="form-label fw-semibold">
                Judul Buku
            </label>

            <input
                type="text"
                id="judul_buku"
                name="judul_buku"
                class="form-control @error('judul_buku') is-invalid @enderror"
                value="{{ old('judul_buku') }}"
                placeholder="Masukkan judul buku"
                required
            >

            @error('judul_buku')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Pengarang dan Penerbit --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="pengarang" class="form-label fw-semibold">
                    Pengarang
                </label>

                <input
                    type="text"
                    id="pengarang"
                    name="pengarang"
                    class="form-control @error('pengarang') is-invalid @enderror"
                    value="{{ old('pengarang') }}"
                    placeholder="Nama pengarang"
                    required
                >

                @error('pengarang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="penerbit" class="form-label fw-semibold">
                    Penerbit
                </label>

                <input
                    type="text"
                    id="penerbit"
                    name="penerbit"
                    class="form-control @error('penerbit') is-invalid @enderror"
                    value="{{ old('penerbit') }}"
                    placeholder="Nama penerbit"
                    required
                >

                @error('penerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Tahun dan Harga --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="tahun_terbit" class="form-label fw-semibold">
                    Tahun Terbit
                </label>

                <input
                    type="number"
                    id="tahun_terbit"
                    name="tahun_terbit"
                    class="form-control @error('tahun_terbit') is-invalid @enderror"
                    min="1000"
                    max="2100"
                    value="{{ old('tahun_terbit') }}"
                    placeholder="Contoh: 2025"
                    required
                >

                @error('tahun_terbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="harga_beli" class="form-label fw-semibold">
                    Harga Beli (Rp)
                </label>

                <input
                    type="number"
                    id="harga_beli"
                    name="harga_beli"
                    class="form-control @error('harga_beli') is-invalid @enderror"
                    min="0"
                    step="0.01"
                    value="{{ old('harga_beli') }}"
                    placeholder="0"
                    required
                >

                @error('harga_beli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="harga_jual" class="form-label fw-semibold">
                    Harga Jual (Rp)
                </label>

                <input
                    type="number"
                    id="harga_jual"
                    name="harga_jual"
                    class="form-control @error('harga_jual') is-invalid @enderror"
                    min="0"
                    step="0.01"
                    value="{{ old('harga_jual') }}"
                    placeholder="0"
                    required
                >

                @error('harga_jual')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label for="stok" class="form-label fw-semibold">
                Stok Buku
            </label>

            <input
                type="number"
                id="stok"
                name="stok"
                class="form-control @error('stok') is-invalid @enderror"
                min="0"
                value="{{ old('stok') }}"
                placeholder="Masukkan jumlah stok"
                required
            >

            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label fw-semibold">
                Keterangan
            </label>

            <textarea
                id="keterangan"
                name="keterangan"
                class="form-control @error('keterangan') is-invalid @enderror"
                rows="3"
                placeholder="Tambahkan keterangan buku jika diperlukan"
            >{{ old('keterangan') }}</textarea>

            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-orange">
                <i class="bi bi-save"></i> Simpan Buku
            </button>

            <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>

    </form>
</div>

@endsection
