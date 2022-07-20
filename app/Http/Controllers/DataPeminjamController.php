<?php

namespace App\Http\Controllers;

use App\Exports\DataPeminjamExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Telepon;
use App\Models\DataPeminjam;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use PDF;

class DataPeminjamController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function data_peminjam_pdf()
    {
        $data_peminjam = DataPeminjam::all();
        $pdf = PDF::loadView('data_peminjam/data_peminjam_pdf', ['data_peminjam' => $data_peminjam]);
        return $pdf->download('laporan.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new DataPeminjamExport, 'data_peminjam.xlsx');
    }
    
    public function index()
    {
        $jumlah_peminjam = DataPeminjam::count();
        $data_peminjam = DataPeminjam::orderBy('id', 'asc')->paginate(5);
        return view('data_peminjam.index', compact('data_peminjam', 'jumlah_peminjam'));
    }

    public function create()
    {
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id_jenis_kelamin');
        return view('data_peminjam.create', compact('list_jenis_kelamin'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_peminjam' => 'required|string|unique:data_peminjams',
            'nama_peminjam' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
        ]);

        $this->validate($request, [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto_peminjam = $request->foto;
        $nama_file = time() . '.' . $foto_peminjam->getClientOriginalExtension();
        $foto_peminjam->move('foto_peminjam/', $nama_file);

        $data_peminjam = new DataPeminjam;
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->foto = $nama_file;
        $data_peminjam->id_user = $request->id_user;
        $data_peminjam->save();

        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->nomor_telepon;
        $data_peminjam->telepon()->save($telepon);

        Session::flash('flash_message', 'Data peminjam berhasil Diubah');

        return redirect('data_peminjam');
    }

    public function edit($id)
    {
        $peminjam = DataPeminjam::find($id);
        if (!empty($peminjam->telepon->nomor_telepon))
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

        if ($request->has('foto')) {
            $foto_peminjam = $request->foto;
            $nama_file = time() . '.' . $foto_peminjam->getClientOriginalExtension();
            $foto_peminjam->move('foto_peminjam/', $nama_file);
            $data_peminjam->foto = $nama_file;
        } else {
            $data_peminjam->foto = "";
        }

        $data_peminjam->update();

        $cari_user_id = DataPeminjam::where('id', $id)->pluck('id_user');
        $user = User::where('id', $cari_user_id);
        $user->update([ 
            'name' => $request->nama_peminjam,
        ]);

        if ($data_peminjam->telepon) {
            if ($request->filled('nomor_telepon')) {
                $data_peminjam->telepon()->delete();
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $data_peminjam->telepon()->save($telepon);
            } else {
                $data_peminjam->telepon()->delete();
            }
        } else {
            if ($request->filled('nomor_telepon')) {
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $data_peminjam->telepon()->save($telepon);
            }
        }

        Session::flash('flash_message', 'Data peminjam berhasil Diubah');

        return redirect('data_peminjam');
    }

    public function destroy($id)
    {
        $cari_user_id = DataPeminjam::where('id', $id)->pluck('id_user');
        $user = User::where('id', $cari_user_id);
        $user->delete();

        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->delete();

        Session::flash('flash_message', 'Data peminjam berhasil Dihapus');
        Session::flash('penting', true);

        return redirect('data_peminjam');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_peminjam = DataPeminjam::where('nama_peminjam', 'like', '%' . $cari . '%')->paginate($batas);
        $no = $batas * ($data_peminjam->currentPage() - 1);
        return view('data_peminjam.search', compact('data_peminjam', 'no', 'cari'));
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
            echo $peminjam['kode_peminjam'] . " - " . $peminjam['nama_peminjam'] . "<br>";
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
