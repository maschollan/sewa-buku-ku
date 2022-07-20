<?php

namespace App\Http\Controllers;

use App\Models\DataBuku;
use App\Models\DataPeminjam;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data_peminjam = Peminjaman::all()->sortBy('id');
        $jumlah_peminjam = $data_peminjam->count();
        return view('peminjaman.index', compact('data_peminjam', 'jumlah_peminjam'));
    }

    public function create()
    {
        $list_data_peminjam = DataPeminjam::pluck('nama_peminjam', 'id');
        $list_data_buku = DataBuku::pluck('judul_buku', 'id');
        return view('peminjaman.create', compact('list_data_peminjam', 'list_data_buku'));
    }

    public function store()
    {
        $peminjam = new Peminjaman;
        $peminjam->kode_transaksi = request('kode_transaksi');
        $peminjam->id_peminjam = request('id_peminjam');
        $peminjam->id_buku = request('id_buku');
        $peminjam->tgl_peminjaman = request('tgl_peminjaman');
        $peminjam->tgl_pengembalian = request('tgl_pengembalian');
        $peminjam->save();

        return redirect('peminjaman');
    }

    public function detail_peminjam($id)
    {
        $halaman = 'data_peminjams';
        $data_peminjam = DataPeminjam::findorfail($id);
        return view('peminjaman.detail_peminjam', compact('halaman', 'data_peminjam'));
    }

    public function detail_buku($id)
    {
        $halaman = 'data_buku';
        $data_buku= DataBuku::findorfail($id);
        return view('peminjaman.detail_buku', compact('halaman', 'data_buku'));
    }
}
