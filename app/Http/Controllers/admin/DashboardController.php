<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();

        $alatTersedia = Alat::where('jumlah_alat', '>', 0)->count();
        $alatHabis = Alat::where('jumlah_alat', 0)->count();

        return view('admin.dashboard', compact(
            'totalAlat',
            'totalKategori',
            'alatTersedia',
            'alatHabis'
        ));
    }

    public function logAktivitas()
    {
        $logs = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('admin.log-aktivitas.index', compact('logs'));
    }
}
