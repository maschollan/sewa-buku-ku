<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataPeminjam;
use App\Models\JenisKelamin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
        $this->middleware('auth');
    }
    
    public function index()
    {
        $batas = 5;
        $jumlah_user = User::count();
        $user_list = User::orderBy('id', 'asc')->simplePaginate($batas);
        $no = 0;
        return view('user.index', compact('user_list', 'jumlah_user', 'no'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => "required|string|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:50",
        ]);

        $user = new User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();

        if ($user->save()) {
            Session::flash('flash_message', 'Data user berhasil ditambahkan');
        } else {
            Session::flash('flash_message', 'Data user gagal ditambahkan');
        }

        if ($user->level == "peminjam") {
            $user_id = User::max('id');
            $name = $request->nama;
            $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id_jenis_kelamin');
            return view('data_peminjam/create', compact('name', 'user_id', 'list_jenis_kelamin'));
        } else {
            return redirect('user');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "nama" => "required|string|max:255",
            "email" => "required|email",
            "password_lama" => "required|min:8|max:50",
            "password_baru" => "required|min:8|max:50",
        ]);

        $user = User::find($id);
        $pass_lama = $request->password_lama;
        $user->name = $request->nama;
        $user->email = $request->email;
        $pass_baru = $request->password_baru;
        if (!Hash::check($pass_lama, $user->password)) {
            return redirect('user/edit/' . $id)->with('error', 'Password lama tidak sesuai');
        } else {
            $user->password = Hash::make($pass_baru);
        }

        $user->level = $request->level;
        $user->update();
        $data_peminjam = DataPeminjam::where('id_user', $id);

        $data_peminjam->update([
            "nama_peminjam" => $request->nama
        ]);

        return redirect('user');
    }
}
