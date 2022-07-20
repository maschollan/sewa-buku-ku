<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DataPeminjamController;
use App\Models\DataPeminjam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('data_peminjam', [DataPeminjamController::class, 'index'])->name('data_peminjam');
Route::get('data_peminjam/create', [DataPeminjamController::class, 'create'])->name('data_peminjam.create');
Route::post('data_peminjam/store', [DataPeminjamController::class, 'store'])->name('data_peminjam.store');
Route::get('data_peminjam/edit/{id}', [DataPeminjamController::class, 'edit'])->name('data_peminjam.edit');
Route::post('data_peminjam/update/{id}', [DataPeminjamController::class, 'update'])->name('data_peminjam.update');
Route::post('data_peminjam/delete/{id}', [DataPeminjamController::class, 'destroy'])->name('data_peminjam.destroy');

Route::get('data_peminjam/search', [DataPeminjamController::class, 'search'])->name('data_peminjam.search');
Route::get('data_peminjam/data_peminjam_pdf', [DataPeminjamController::class, 'data_peminjam_pdf'])->name('data_peminjam.data_peminjam_pdf');

Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
Route::get('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');

Route::get('peminjaman/detail_peminjam/{id}', [PeminjamanController::class, 'detail_peminjam'])->name('peminjaman.detail_peminjam');
Route::get('peminjaman/detail_buku/{id}', [PeminjamanController::class, 'detail_buku'])->name('peminjaman.detail_buku');

Route::get('export_excel', [DataPeminjamController::class, 'export_excel'])->name('data_peminjam.export_excel');

Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user/store', [UserController::class, 'store'])->name('user.store');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('buku/store', [BukuController::class, 'store'])->name('buku.store');
Route::get('buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
Route::post('buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

require __DIR__ . '/auth.php';
