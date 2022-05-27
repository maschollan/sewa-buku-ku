<?php

namespace App\Http\Controllers;

use App\Models\DataPeminjam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisKelamin;
use App\Models\Telepon;

class DataPeminjamController extends Controller
{
    public function index()
    {
        $data_peminjam = DataPeminjam::all()->sortBy('nama_peminjam');
        $jumlah_peminjam = $data_peminjam->count();
        return view('data_peminjam.index', compact('data_peminjam', 'jumlah_peminjam'));
    }

    public function create()
    {
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id_jenis_kelamin');
        return view('data_peminjam.create', compact('list_jenis_kelamin'));
    }

    public function store(Request $request)
    {
        $data_peminjam = new DataPeminjam;
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->foto = "";
        $data_peminjam->save();

        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->nomor_telepon;
        $data_peminjam->telepon()->save($telepon);
        
        return redirect('data_peminjam');
    }

    public function edit($id)
    {
        $peminjam = DataPeminjam::find($id);
        if(!empty($peminjam->telepon->nomor_telepon))
            $nomor_telepon = $peminjam->telepon->nomor_telepon;
        else $nomor_telepon = "";
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id_jenis_kelamin');
        return view('data_peminjam.edit', compact('peminjam', 'nomor_telepon', 'list_jenis_kelamin'));
    }

    public function update(Request $request, $id)
    {
        $data_peminjam =  DataPeminjam::find($id);
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->foto = "";
        $data_peminjam->update();

        if($data_peminjam->telepon) 
        {
            if ($request->filled('nomor_telepon')) 
            {
                $telepon = $data_peminjam->telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $data_peminjam->telepon()->save($telepon);
            } 
            else 
            {
                $data_peminjam->telepon()->delete();
            }
        }
        else 
        {
            if ($request->filled('nomor_telepon')) 
            {
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $data_peminjam->telepon()->save($telepon);
            }
        }
        
        return redirect('data_peminjam');
    }

    public function destroy($id)
    {
        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->delete();
        return redirect('data_peminjam');
    }

    public function coba_collection()
    {
        $daftar = [
            'Budi Hartono',
            'Dewi Shintya Aji',
            'Eka Setiawan',
            'Faris Lukman',
            'Gede Adi Prasetyo',
        ];

        $collection = collect($daftar)->map(function ($nama) {
            return ucwords($nama);
        });

        return $collection;
    }
    
    public function collection_first()
    {
        $collection = DataPeminjam::all()->first();
        return $collection;
    }
    
    public function collection_last()
    {
        $collection = DataPeminjam::all()->last();
        return $collection;
    }
    
    public function collection_count()
    {
        $collection = DataPeminjam::all();
        $jumlah = $collection->count();
        return "Jumlah data peminjam adalah $jumlah";
    }
    
    public function collection_take()
    {
        $collection = DataPeminjam::all()->take(2);
        return $collection;
    }
    
    public function collection_pluck()
    {
        $collection = DataPeminjam::all()->pluck('nama_peminjam');
        return $collection;
    }
    
    public function collection_where()
    {
        $collection = DataPeminjam::all()->where('kode_peminjam', 'PO223');
        return $collection;
    }
    
    public function collection_wherein()
    {
        $collection = DataPeminjam::all()->wherein('kode_peminjam', ['PO223', 'PP980']);
        return $collection;
    }
    
    public function collection_toarray()
    {
        $collection = DataPeminjam::select('kode_peminjam', 'nama_peminjam')->take(3)->get();
        $koleksi = $collection->toArray();
        foreach ($koleksi as $peminjam) {
            echo $peminjam['kode_peminjam']." - ".$peminjam['nama_peminjam']."<br>";
        }
    }
    
    public function collection_tojson()
    {
        $data = [
            ['kode_peminjam' => 'P0001', 'nama_peminjam' => 'Aldi'],
            ['kode_peminjam' => 'P0002', 'nama_peminjam' => 'Budi'],
            ['kode_peminjam' => 'P0003', 'nama_peminjam' => 'Chyntia'],
            ['kode_peminjam' => 'P0004', 'nama_peminjam' => 'Eko'],
        ];
        $collection = collect($data)->toJson();
        return $collection;
    }
}
