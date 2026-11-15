
@extends('layouts.app')

@section('title', 'Data Buku')
@section('page-heading', 'Manajemen Data Buku')

@section('content')

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- HEADER --}}
<div class="content-card mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h5 class="fw-bold mb-1">Daftar Koleksi Buku</h5>
            <p class="text-muted mb-0">
                Kelola seluruh data koleksi buku BOOKSPACE.
            </p>
        </div>

        <a href="{{ route('buku.create') }}" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Buku
        </a>
    </div>
</div>

{{-- TABEL --}}
<div class="content-card">

    {{-- PENCARIAN DAN FILTER --}}
    <div class="row g-3 mb-4">

        <div class="col-md-8">
            <label for="searchBook" class="form-label fw-semibold">
                Cari Buku
            </label>

            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    id="searchBook"
                    class="form-control"
                    placeholder="Cari kode, judul, pengarang, penerbit, atau tahun..."
                >
            </div>
        </div>

        <div class="col-md-4">
            <label for="filterStock" class="form-label fw-semibold">
                Filter Stok
            </label>

            <select id="filterStock" class="form-select">
                <option value="semua">Semua Stok</option>
                <option value="tersedia">Stok Tersedia</option>
                <option value="menipis">Stok Menipis</option>
                <option value="habis">Stok Habis</option>
            </select>
        </div>

    </div>

    {{-- INFORMASI --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">

        <div>
            <h6 class="fw-bold mb-1">Data Buku</h6>
            <small class="text-muted">
                Informasi koleksi dan persediaan buku.
            </small>
        </div>

        <span class="badge rounded-pill px-3 py-2"
              style="background: #fff0e5; color: #d9773c;">
            <i class="bi bi-book me-1"></i>
            {{ $bukus->count() }} Total Buku
        </span>

    </div>

    {{-- TABEL DATA --}}
    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="bookTable">

                @forelse($bukus as $buku)

                    <tr class="book-row"
                        data-search="{{ strtolower($buku->kode_buku . ' ' . $buku->judul_buku . ' ' . $buku->pengarang . ' ' . $buku->penerbit . ' ' . $buku->tahun_terbit) }}"
                        data-stock="{{ $buku->stok == 0 ? 'habis' : ($buku->stok <= 10 ? 'menipis' : 'tersedia') }}">

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $buku->kode_buku }}
                            </span>
                        </td>

                        <td>
                            <span class="fw-semibold">
                                {{ $buku->judul_buku }}
                            </span>
                        </td>

                        <td>{{ $buku->pengarang }}</td>

                        <td>{{ $buku->penerbit }}</td>

                        <td>{{ $buku->tahun_terbit }}</td>

                        <td class="text-nowrap">
                            Rp {{ number_format($buku->harga_beli, 0, ',', '.') }}
                        </td>

                        <td class="text-nowrap fw-semibold">
                            Rp {{ number_format($buku->harga_jual, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($buku->stok > 10)
                                <span class="badge bg-success">
                                    {{ $buku->stok }} tersedia
                                </span>
                            @elseif($buku->stok > 0)
                                <span class="badge bg-warning text-dark">
                                    {{ $buku->stok }} menipis
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Habis
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="d-flex justify-content-center gap-1">

                                <a href="{{ route('buku.show', $buku->id) }}"
                                   class="btn btn-sm btn-info text-white"
                                   title="Detail Buku">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('buku.edit', $buku->id) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Edit Buku">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('buku.destroy', $buku->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus Buku">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr id="emptyBook">
                        <td colspan="10" class="text-center py-5">

                            <i class="bi bi-journal-x fs-1 text-muted"></i>

                            <h6 class="fw-bold mt-3">
                                Belum Ada Data Buku
                            </h6>

                            <p class="text-muted">
                                Silakan tambahkan koleksi buku terlebih dahulu.
                            </p>

                            <a href="{{ route('buku.create') }}"
                               class="btn btn-orange btn-sm">
                                <i class="bi bi-plus-circle me-1"></i>
                                Tambah Buku
                            </a>

                        </td>
                    </tr>

                @endforelse

                {{-- HASIL PENCARIAN KOSONG --}}
                <tr id="noSearchResult" style="display: none;">
                    <td colspan="10" class="text-center text-muted py-4">
                        <i class="bi bi-search fs-3 d-block mb-2"></i>
                        Buku yang dicari tidak ditemukan.
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchBook = document.getElementById('searchBook');
    const filterStock = document.getElementById('filterStock');
    const bookRows = document.querySelectorAll('.book-row');
    const noSearchResult = document.getElementById('noSearchResult');

    function filterBooks() {

        const keyword = searchBook.value.toLowerCase().trim();
        const stockFilter = filterStock.value;

        let visibleCount = 0;

        bookRows.forEach(function (row) {

            const searchText = row.dataset.search;
            const stock = row.dataset.stock;

            const matchesSearch = searchText.includes(keyword);

            const matchesStock =
                stockFilter === 'semua' || stock === stockFilter;

            if (matchesSearch && matchesStock) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }

        });

        if (noSearchResult) {
            noSearchResult.style.display =
                bookRows.length > 0 && visibleCount === 0 ? '' : 'none';
        }

    }

    if (searchBook && filterStock) {
        searchBook.addEventListener('input', filterBooks);
        filterStock.addEventListener('change', filterBooks);
    }

});
</script>
@endpush
