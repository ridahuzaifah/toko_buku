
@extends('layouts.user')

@section('title', 'Detail Buku')

@section('content')

<div class="container py-4">

    <a href="{{ route('catalog.index') }}"
       class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Katalog
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h2 class="fw-bold mb-3">
                {{ $buku->judul_buku }}
            </h2>

            <hr>

            <p>
                <strong>Kode Buku:</strong>
                {{ $buku->kode_buku }}
            </p>

            <p>
                <strong>Pengarang:</strong>
                {{ $buku->pengarang }}
            </p>

            <p>
                <strong>Penerbit:</strong>
                {{ $buku->penerbit }}
            </p>

            <p>
                <strong>Tahun Terbit:</strong>
                {{ $buku->tahun_terbit }}
            </p>

            <p>
                <strong>Harga:</strong>
                <span class="text-success fw-bold">
                    Rp {{ number_format($buku->harga_jual, 0, ',', '.') }}
                </span>
            </p>

            <p>
                <strong>Stok:</strong>
                {{ $buku->stok }}
            </p>

            <p>
                <strong>Keterangan:</strong>
                {{ $buku->keterangan ?? 'Tidak ada keterangan.' }}
            </p>

            <hr>

            <h5 class="fw-bold mb-3">Tambahkan ke Keranjang</h5>

            @if($buku->stok > 0)

                <form action="{{ route('keranjang.store', $buku->id) }}"
                      method="POST">

                    @csrf

                    <div class="mb-3" style="max-width: 180px;">
                        <label class="form-label">
                            Jumlah Buku
                        </label>

                        <input type="number"
                               name="jumlah"
                               class="form-control"
                               value="1"
                               min="1"
                               max="{{ $buku->stok }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-cart-plus"></i>
                        Tambahkan ke Keranjang
                    </button>

                </form>

            @else

                <button class="btn btn-secondary" disabled>
                    Stok Habis
                </button>

            @endif

        </div>
    </div>

</div>

@endsection
