
@extends('layouts.user')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold">Keranjang Belanja</h2>
        <p class="text-muted">Daftar buku yang ingin kamu beli.</p>
    </div>

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

    @if($keranjangs->isEmpty())

        <div class="card border-0 shadow-sm text-center p-5">
            <div class="mb-3">
                <i class="bi bi-cart-x fs-1 text-secondary"></i>
            </div>

            <h5>Keranjang masih kosong</h5>
            <p class="text-muted">
                Silakan pilih buku dari katalog terlebih dahulu.
            </p>

            <a href="{{ route('catalog.index') }}"
               class="btn btn-dark">
                Lihat Katalog Buku
            </a>
        </div>

    @else

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Buku</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($keranjangs as $item)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $item->buku->judul_buku }}
                                    </strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ $item->buku->pengarang }}
                                    </small>
                                </td>

                                <td>
                                    Rp {{ number_format($item->buku->harga_jual, 0, ',', '.') }}
                                </td>

                                <td>
                                    <form action="{{ route('keranjang.update', $item->id) }}"
                                          method="POST"
                                          class="d-flex gap-2">

                                        @csrf
                                        @method('PUT')

                                        <input type="number"
                                               name="jumlah"
                                               value="{{ $item->jumlah }}"
                                               min="1"
                                               max="{{ $item->buku->stok }}"
                                               class="form-control"
                                               style="width: 75px;">

                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="fw-bold">
                                    Rp {{ number_format($item->jumlah * $item->buku->harga_jual, 0, ',', '.') }}
                                </td>

                                <td>
                                    <form action="{{ route('keranjang.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus buku dari keranjang?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        ```blade
<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <small class="text-muted">Total Belanja</small>
                <h4 class="fw-bold text-success mb-0">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </h4>
            </div>

            <div class="d-flex gap-2 flex-wrap">

                <a href="{{ route('catalog.index') }}"
                   class="btn btn-outline-dark">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Buku Lain
                </a>

                <a href="{{ route('checkout.index') }}"
                   class="btn btn-success">
                    <i class="bi bi-bag-check"></i>
                    Checkout Sekarang
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>
</div>
```

    @endif

</div>

@endsection
