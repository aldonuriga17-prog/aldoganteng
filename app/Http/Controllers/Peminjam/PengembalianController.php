<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('peminjam.pengembalian.index', compact('peminjamans'));
    }

    public function store($id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->firstOrFail();

        $hariIni = Carbon::now();
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);

        $denda = 0;
        $terlambat = 0;
        $dendaPerHari = 5000; // Rp 5.000 per hari

        // Jika telat
        if ($hariIni->gt($tanggalKembali)) {
            $terlambat = $tanggalKembali->diffInDays($hariIni);
            $denda = $terlambat * $dendaPerHari;
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);

        if ($denda > 0) {
            return back()->with(
                'success',
                "Alat berhasil dikembalikan. Terlambat {$terlambat} hari. Denda: Rp " . number_format($denda, 0, ',', '.')
            );
        }

        return back()->with('success', 'Alat berhasil dikembalikan tanpa denda.');
    }
}
