
@extends('layouts.app')

@section('title', 'Buku Terhapus')
@section('page-heading', 'Buku Terhapus')

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
            <h5 class="fw-bold mb-1">Daftar Buku Terhapus</h5>
            <p class="text-muted mb-0">
                Kelola dan pulihkan koleksi buku yang telah dihapus.
            </p>
        </div>

        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Data Buku
        </a>
    </div>
</div>

{{-- TABEL --}}
<div class="content-card">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h6 class="fw-bold mb-1">Data Buku Terhapus</h6>
            <small class="text-muted">
                Buku yang dihapus masih dapat dipulihkan.
            </small>
        </div>

        <span class="badge rounded-pill px-3 py-2"
              style="background: #fff0e5; color: #d9773c;">
            <i class="bi bi-trash me-1"></i>
            {{ $bukus->count() }} Buku Terhapus
        </span>
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
                    <th>Tanggal Dihapus</th>
                    <th class="text-center">Aksi</th>
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
                            {{ $buku->deleted_at?->format('d-m-Y H:i') }}
                        </td>

                        <td class="text-center">
                            <form action="{{ route('buku.restore', $buku->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Pulihkan buku {{ $buku->judul_buku }}?')">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="btn btn-sm btn-success"
                                        title="Pulihkan Buku">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                                    Pulihkan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-trash3 fs-1 text-muted"></i>

                            <h6 class="fw-bold mt-3">
                                Tidak Ada Buku Terhapus
                            </h6>

                            <p class="text-muted mb-0">
                                Semua koleksi buku masih aktif.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
