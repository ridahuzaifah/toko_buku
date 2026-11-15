
@extends('layouts.user')

@section('title', 'Checkout')

@section('content')

<div class="container py-4">

    <a href="{{ route('keranjang.index') }}"
       class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Keranjang
    </a>

    <h2 class="fw-bold mb-2">Checkout</h2>
    <p class="text-muted mb-4">Lengkapi alamat pengiriman untuk melanjutkan pesanan.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-geo-alt"></i>
                        Alamat Pengiriman
                    </h5>

                    <form action="{{ route('checkout.store') }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text"
                                   name="nama_penerima"
                                   class="form-control"
                                   value="{{ old('nama_penerima', Auth::user()->name) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text"
                                   name="no_hp"
                                   class="form-control"
                                   value="{{ old('no_hp') }}"
                                   placeholder="08xxxxxxxxxx"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap"
                                      class="form-control"
                                      rows="3"
                                      required>{{ old('alamat_lengkap') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota/Kabupaten</label>
                                <input type="text"
                                       name="kota"
                                       class="form-control"
                                       value="{{ old('kota') }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text"
                                       name="provinsi"
                                       class="form-control"
                                       value="{{ old('provinsi') }}"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Pos</label>
                            <input type="text"
                                   name="kode_pos"
                                   class="form-control"
                                   value="{{ old('kode_pos') }}"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea name="catatan"
                                      class="form-control"
                                      rows="2">{{ old('catatan') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            <i class="bi bi-bag-check"></i>
                            Buat Pesanan
                        </button>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>

                    @foreach($keranjangs as $item)
                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <div>
                                <div class="fw-semibold">
                                    {{ $item->buku->judul_buku }}
                                </div>
                                <small class="text-muted">
                                    {{ $item->jumlah }} x
                                    Rp {{ number_format($item->buku->harga_jual, 0, ',', '.') }}
                                </small>
                            </div>

                            <div class="fw-semibold text-nowrap">
                                Rp {{ number_format($item->jumlah * $item->buku->harga_jual, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Total Pembayaran</span>
                        <strong class="text-success fs-5">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </strong>
                    </div>

                    <small class="text-muted d-block mt-3">
                        Pembayaran belum dilakukan. Pesanan akan tercatat dengan status menunggu.
                    </small>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
