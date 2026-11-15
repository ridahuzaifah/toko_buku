
@extends('layouts.user')

@section('title', 'Detail Pesanan')

@section('content')

<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <i class="bi bi-check-circle-fill text-success"
                   style="font-size: 55px;"></i>

                <h3 class="fw-bold mt-3">Pesanan Berhasil Dibuat!</h3>

                <p class="text-muted">
                    Terima kasih telah berbelanja di BOOKSPACE.
                </p>
            </div>

            <hr>

            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted">Kode Pesanan</small>
                    <h5 class="fw-bold">
                        {{ $pesanan->kode_pesanan }}
                    </h5>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Tanggal Pesanan</small>
                    <h6>
                        {{ $pesanan->tanggal_pesanan->format('d-m-Y H:i') }}
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Status Pesanan</small>
                    <div>
                        <span class="badge bg-warning text-dark">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Total Pembayaran</small>
                    <h5 class="fw-bold text-success">
                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </h5>
                </div>
            </div>

        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">Alamat Pengiriman</h5>

            @if($pesanan->alamat)
                <p class="mb-1">
                    <strong>{{ $pesanan->alamat->nama_penerima }}</strong>
                </p>

                <p class="mb-1">
                    {{ $pesanan->alamat->no_hp }}
                </p>

                <p class="mb-1">
                    {{ $pesanan->alamat->alamat_lengkap }}
                </p>

                <p class="mb-0">
                    {{ $pesanan->alamat->kota }},
                    {{ $pesanan->alamat->provinsi }}
                    {{ $pesanan->alamat->kode_pos }}
                </p>
            @else
                <p class="text-muted">Alamat tidak tersedia.</p>
            @endif

        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">Detail Buku Pesanan</h5>

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nama Buku</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pesanan->detailPesanans as $detail)
                            <tr>
                                <td>
                                    {{ $detail->buku->judul_buku ?? 'Buku tidak tersedia' }}
                                </td>

                                <td>
                                    Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                </td>

                                <td>{{ $detail->jumlah }}</td>

                                <td>
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">
                                Total
                            </th>

                            <th class="text-success">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>
    </div>

    <div class="mt-4 d-flex flex-wrap gap-2">
        <a href="{{ route('catalog.index') }}"
           class="btn btn-dark">
            <i class="bi bi-book"></i>
            Kembali ke Katalog
        </a>

        <a href="{{ route('pesanan.index') }}"
           class="btn btn-outline-dark">
            Riwayat Pesanan
        </a>
    </div>

</div>

@endsection
