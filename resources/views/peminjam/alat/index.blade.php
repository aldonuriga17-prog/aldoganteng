@extends('layouts.app')

@section('title', 'Daftar Alat')
@section('page_title', 'Daftar Alat')

@section('content')
<h3 class="mb-4">Daftar Alat</h3>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alats as $alat)
                <tr class="text-center align-middle">

                    <td>{{ $loop->iteration }}</td>

                    {{-- FOTO --}}
                   <td>
                                @if ($alat->foto)
                                    <img src="{{ asset('foto_alat/' . $alat->foto) }}" alt="{{ $alat->nama_alat }}" width="70" height="70" class="img-thumbnail" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/cangkul.jpg') }}" alt="Default Alat" width="70" height="70" class="img-thumbnail" style="object-fit: cover;">
                                @endif
                            </td>

                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->kategori->nama_kategori }}</td>
                    <td>{{ $alat->jumlah_alat }}</td>

                    {{-- DESKRIPSI --}}
                    <td class="text-start">
                        {{ $alat->deskripsi ?? '-' }}
                    </td>
                    
                    <td>
                        @if($alat->jumlah_alat > 0)
                        <span class="badge bg-success">Tersedia</span>
                        @else
                        <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('peminjam.peminjaman.create', $alat->id) }}"
                            class="btn btn-primary btn-sm">
                            Pinjam
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Data alat belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection