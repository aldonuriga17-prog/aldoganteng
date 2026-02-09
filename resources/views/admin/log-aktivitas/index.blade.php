@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Log Aktivitas Semua Peminjam</h4>

    <div class="card">
        <div class="card-body">

            @if($logs->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Alat</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $log->user->name ?? '-' }}</td>
                            <td>{{ $log->alat->nama ?? '-' }}</td>
                            <td>{{ $log->tanggal_pinjam }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $log->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="alert alert-info">
                    Belum ada aktivitas.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
