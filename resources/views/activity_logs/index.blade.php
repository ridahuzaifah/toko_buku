@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Riwayat Aktivitas</h3>
            <p class="text-muted">Catatan aktivitas pengelolaan data BOOKSPACE.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('activity-logs.index') }}"
                  method="GET" class="row g-2 mb-4">

                <div class="col-md-5">
                    <input type="text" name="search"
                           class="form-control"
                           placeholder="Cari aktivitas..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="action" class="form-select">
                        <option value="">Semua Aktivitas</option>
                        <option value="created" @selected(request('action') == 'created')>
                            Ditambahkan
                        </option>
                        <option value="updated" @selected(request('action') == 'updated')>
                            Diedit
                        </option>
                        <option value="deleted" @selected(request('action') == 'deleted')>
                            Dihapus
                        </option>
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="{{ route('activity-logs.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Pengguna</th>
                            <th>Aktivitas</th>
                            <th>Jenis</th>
                            <th>Waktu</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $loop->index }}</td>

                            <td>
                                {{ $log->user->name ?? 'Sistem' }}
                            </td>

                            <td>{{ $log->description }}</td>

                            <td>
                                @if($log->action == 'created')
                                    <span class="badge bg-success">Ditambahkan</span>
                                @elseif($log->action == 'updated')
                                    <span class="badge bg-warning text-dark">Diedit</span>
                                @else
                                    <span class="badge bg-danger">Dihapus</span>
                                @endif
                            </td>

                            <td>
                                {{ $log->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                <a href="{{ route('activity-logs.show', $log->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada riwayat aktivitas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
