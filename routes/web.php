<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ================= ADMIN =================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PeminjamController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;
use App\Http\Controllers\Admin\PetugasController;

// ================= PETUGAS =================
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\LaporanController;

// ================= PEMINJAM =================
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Peminjam\LogAktivitasController;



/*
|--------------------------------------------------------------------------
| ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ================= ADMIN ROUTE =================
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('petugas', PetugasController::class);

        Route::get('peminjam', [PeminjamController::class, 'index'])
            ->name('peminjam.index');

        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);

        Route::resource('data-peminjaman', PeminjamanController::class)
            ->only(['index']);

        // Pengembalian
        Route::resource('pengembalian', AdminPengembalianController::class)
            ->only(['index']);

        Route::get(
            'pengembalian/{peminjaman}',
            [AdminPengembalianController::class, 'create']
        )->name('pengembalian.create');

        Route::post(
            'pengembalian/{peminjaman}/kembalikan',
            [AdminPengembalianController::class, 'store']
        )->name('pengembalian.store');

        Route::get(
            '/log-aktivitas',
            [DashboardController::class, 'logAktivitas']
        )->name('logaktivitas.index');
    });




// ================= PETUGAS ROUTE =================
Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('petugas.dashboard');
        })->name('dashboard');

        Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::post(
            '/peminjaman/{id}/approve',
            [PetugasPeminjamanController::class, 'approve']
        )->name('peminjaman.approve');

        Route::post(
            '/peminjaman/{id}/reject',
            [PetugasPeminjamanController::class, 'reject']
        )->name('peminjaman.reject');

        Route::post(
            '/peminjaman/{id}/kembalikan',
            [PetugasPeminjamanController::class, 'kembalikan']
        )->name('peminjaman.kembalikan');

        Route::resource('pengembalian', PetugasPengembalianController::class)
            ->only(['index']);

        Route::resource('laporan', LaporanController::class)
            ->only(['index']);

        Route::get('/laporan-cetak', [LaporanController::class, 'cetak'])
            ->name('laporan-cetak');

        Route::get(
            '/log-aktivitas',
            [PetugasPeminjamanController::class, 'logAktivitas']
        )->name('logaktivitas.index');
    });


// ================= PEMINJAM ROUTE =================
Route::prefix('peminjam')
    ->middleware(['auth', 'peminjam'])
    ->name('peminjam.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('peminjam.dashboard');
        })->name('dashboard');

        // Log Aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('logaktivitas.index');

        // Lihat alat
        Route::get('/alat', [PeminjamAlatController::class, 'index'])
            ->name('alat.index');

        // Ajukan peminjaman
        Route::get(
            '/peminjaman/create/{alat}',
            [PeminjamPeminjamanController::class, 'create']
        )->name('peminjaman.create');

        Route::post(
            '/peminjaman/store/{alat}',
            [PeminjamPeminjamanController::class, 'store']
        )->name('peminjaman.store');

        Route::delete(
            '/peminjaman/{peminjaman}/cencel',
            [PeminjamPeminjamanController::class, 'cencel']
        )->name('peminjaman.cencel');

        // Riwayat peminjaman
        Route::get(
            '/peminjaman',
            [PeminjamPeminjamanController::class, 'index']
        )->name('peminjaman.index');
    });
