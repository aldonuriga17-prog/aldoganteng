@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Log Aktivitas</h4>

    <div class="card">
        <div class="card-body">

            @if($logs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $log->alat->nama ?? '-' }}</td>
                                <td>{{ $log->tanggal_pinjam }}</td>
                                <td>{{ $log->tanggal_kembali ?? '-' }}</td>
                                <td>
                                    @if($log->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($log->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($log->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($log->status == 'dikembalikan')
                                        <span class="badge bg-primary">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ $log->status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    Belum ada aktivitas peminjaman.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
