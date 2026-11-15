```blade
@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Riwayat Pesanan</h2>
            <p class="text-muted mb-0">
                Daftar transaksi pembelian buku kamu.
            </p>
        </div>

        <a href="{{ route('catalog.index') }}" class="btn btn-dark">
            <i class="bi bi-book"></i>
            Kembali ke Katalog
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($pesanans->isEmpty())

        <div class="card border-0 shadow-sm text-center p-5">
            <i class="bi bi-receipt fs-1 text-secondary mb-3"></i>

            <h5>Belum Ada Pesanan</h5>

            <p class="text-muted">
                Kamu belum melakukan transaksi pembelian buku.
            </p>

            <a href="{{ route('catalog.index') }}" class="btn btn-dark mx-auto">
                Mulai Belanja
            </a>
        </div>

    @else

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Kode Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pesanans as $index => $pesanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td class="fw-semibold">
                                    {{ $pesanan->kode_pesanan }}
                                </td>

                                <td>
                                    {{ $pesanan->tanggal_pesanan
                                        ? $pesanan->tanggal_pesanan->format('d/m/Y H:i')
                                        : '-' }}
                                </td>

                                <td class="fw-semibold">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($pesanan->status == 'menunggu')
                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>
                                    @elseif($pesanan->status == 'diproses')
                                        <span class="badge bg-info text-dark">
                                            Diproses
                                        </span>
                                    @elseif($pesanan->status == 'dikirim')
                                        <span class="badge bg-primary">
                                            Dikirim
                                        </span>
                                    @elseif($pesanan->status == 'selesai')
                                        <span class="badge bg-success">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($pesanan->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('pesanan.show', $pesanan->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    @endif

</div>

@endsection
```