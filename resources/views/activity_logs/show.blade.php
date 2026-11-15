@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('activity-logs.index') }}"
           class="btn btn-outline-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <h3 class="fw-bold">Detail Riwayat Aktivitas</h3>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <table class="table">
                <tr>
                    <th width="200">Pengguna</th>
                    <td>{{ $activityLog->user->name ?? 'Sistem' }}</td>
                </tr>

                <tr>
                    <th>Aktivitas</th>
                    <td>{{ $activityLog->description }}</td>
                </tr>

                <tr>
                    <th>Jenis</th>
                    <td>{{ ucfirst($activityLog->action) }}</td>
                </tr>

                <tr>
                    <th>Waktu</th>
                    <td>{{ $activityLog->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>

                <tr>
                    <th>Alamat IP</th>
                    <td>{{ $activityLog->ip_address ?? '-' }}</td>
                </tr>
            </table>

            <hr>

            <h5 class="fw-bold">Data Sebelum Perubahan</h5>
            <pre class="bg-light p-3 rounded">{{ json_encode($activityLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?? '-' }}</pre>

            <h5 class="fw-bold mt-4">Data Setelah Perubahan</h5>
            <pre class="bg-light p-3 rounded">{{ json_encode($activityLog->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?? '-' }}</pre>

        </div>
    </div>
</div>
@endsection