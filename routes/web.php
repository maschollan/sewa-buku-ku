<?php

use App\Http\Controllers\DataPeminjamController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', 'App\Http\Controllers\IndexController@index');


Route::get('/', [IndexController::class, 'index']);

Route::get('home', function() {
    return view("home");
});

Route::get('data_peminjam', [DataPeminjamController::class, 'index']);
Route::get('data_peminjam/create', [DataPeminjamController::class, 'create'])->name('data_peminjam.create');
Route::post('data_peminjam/store', [DataPeminjamController::class, 'store'])->name('data_peminjam.store');
Route::get('data_peminjam/edit/{id}', [DataPeminjamController::class, 'edit'])->name('data_peminjam.edit');
Route::post('data_peminjam/update/{id}', [DataPeminjamController::class, 'update'])->name('data_peminjam.update');
Route::post('data_peminjam/delete/{id}', [DataPeminjamController::class, 'destroy'])->name('data_peminjam.destroy');


Route::get('coba_collection', [DataPeminjamController::class, 'coba_collection']);
Route::get('collection_first', [DataPeminjamController::class, 'collection_first']);
Route::get('collection_last', [DataPeminjamController::class, 'collection_last']);
Route::get('collection_count', [DataPeminjamController::class, 'collection_count']);
Route::get('collection_take', [DataPeminjamController::class, 'collection_take']);
Route::get('collection_pluck', [DataPeminjamController::class, 'collection_pluck']);
Route::get('collection_where', [DataPeminjamController::class, 'collection_where']);
Route::get('collection_wherein', [DataPeminjamController::class, 'collection_wherein']);
Route::get('collection_toarray', [DataPeminjamController::class, 'collection_toarray']);
Route::get('collection_tojson', [DataPeminjamController::class, 'collection_tojson']);


Route::get('lihat_data_peminjam', 'App\Http\Controllers\PeminjamController@lihat_data_peminjam');

Route::get('/biodata', function(){
    return 'Nama : Kholan Mustaqim<br>NIM : 3.34.20.1.14<br>Alamat : Semarang<br>Hobi : Mengwibu';
});

Route::get('/mahasiswa/{prodi}', function($prodi) {
    return "Saya Mahasiswa : $prodi";
});

Route::get('/mahasiswa2/{prodi?}', function($prodi=null) {
    if($prodi==null) {
        return 'Data Prodi Kosong';
    } else {
        return "Saya Mahasiswa Prodi : $prodi";
    }
});

Route::get('/mahasiswa3/{prodi?}', function($prodi="Teknik Mesin") {
    return "Saya Mahasiswa Prodi : $prodi";
});

Route::get('/biodata2', function() {
    return view('biodata2');
});

Route::group([], function() {
    Route::get('/pertama', function() {
        return 'Halaman pertama';
    });
    Route::get('/kedua', function() {
        return 'Halaman kedua';
    });
    Route::get('/ketiga', function() {
        return 'Halaman ketiga';
    });
});

Route::group(['prefix' => 'latihan'], function(){
    Route::get('/satu', function() {
        return 'Halaman satu';
    });
    Route::get('/dua', function() {
        return 'Halaman dua';
    });
    Route::get('/tiga', function() {
        return 'Halaman tiga';
    });
});

Route::group(array('prefix' => 'admin'), function() {
    Route::get('/', function() {
        return 'Halaman Admin';
    });
    Route::get('/posts', function() {
        return 'Halaman Post';
    });
    Route::get('/posts/simpan', function() {
        return 'Data Berhasil disimpan';
    });
});

Route::name('kuliah')->group(function() {
    Route::get('/Teknologi Rekayasa Nuklir', function() {
        return 'Kuliah Di Program Studi Teknologi Reyasa Nuklir';
    });
});