@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Log Aktivitas Saya</h4>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Aktivitas</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logAktivitas as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->aktivitas }}</td>
                        <td>{{ $log->keterangan }}</td>
                        <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada aktivitas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
