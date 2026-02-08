<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logAktivitas = LogAktivitas::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.logaktivitas.index', compact('logAktivitas'));
    }
}
