@extends('layouts.app')

@section('title', 'Pengembalian')
@section('page_title', 'Pengembalian Alat')

@section('content')
    <h3 class="mb-4">Pengembalian Alat</h3>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Lama Hari</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peminjamans as $item)
                        @php
                            $lama = \Carbon\Carbon::parse($item->tanggal_pinjam)->diffInDays(
                                \Carbon\Carbon::parse($item->tanggal_kembali),
                            );

                            $hariIni = \Carbon\Carbon::now();
                            $tanggalKembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                            $terlambat = $hariIni->gt($tanggalKembali) ? $tanggalKembali->diffInDays($hariIni) : 0;

                            $dendaPreview = $terlambat * 5000;
                        @endphp

                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->alat->nama_alat }}</td>
                            <td>{{ $item->jumlah_pinjam }}</td>

                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>

                            <td><span class="fw-semibold">{{ $lama }} hari</span></td>

                            <td>
                                @if ($terlambat > 0)
                                    <span class="badge bg-danger">
                                        Rp {{ number_format($dendaPreview, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="badge bg-success">Tidak Ada</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('peminjam.pengembalian.store', $item->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin mengembalikan alat ini?')">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Tidak ada alat yang sedang dipinjam
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('success-alert')?.remove();
            document.getElementById('error-alert')?.remove();
        }, 3000);
    </script>
@endsection
