<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Models\Alat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // list semua peminjaman
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    // ACC peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (!$peminjaman->alat) {
            abort(400, 'Alat tidak ditemukan');
        }

        if ($peminjaman->alat->jumlah_alat < $peminjaman->jumlah_pinjam) {
            abort(400, 'Stok tidak mencukupi');
        }

        $peminjaman->update(['status' => 'dipinjam']);
        $peminjaman->alat->decrement('jumlah_alat', $peminjaman->jumlah_pinjam);

        return back()->with('success', 'Peminjaman disetujui');
    }

    // Tolak peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'ditolak']);

        return back()->with('success', 'Peminjaman ditolak');
    }

    // Proses pengembalian
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman tidak valid untuk dikembalikan');
        }

        DB::transaction(function () use ($peminjaman) {

            // Simpan pengembalian
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => now(),
            ]);

            // Kembalikan stok
            $peminjaman->alat->increment(
                'jumlah_alat',
                $peminjaman->jumlah_pinjam
            );

            // Update status
            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);
        });

        return back()->with('success', 'Barang berhasil dikembalikan');
    }

    // ✅ UPDATE DENDA MANUAL (INI YANG TADI BELUM ADA)
    public function updateDenda(Request $request, $id)
    {
        $request->validate([
            'denda' => 'required|integer|min:0'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'denda' => $request->denda
        ]);

        return back()->with('success', 'Denda berhasil diperbarui');
    }

    // Log aktivitas
    public function logAktivitas()
    {
        $logs = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('petugas.log-aktivitas.index', compact('logs'));
    }
}
