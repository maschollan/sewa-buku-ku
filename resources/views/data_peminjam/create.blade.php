@extends('layout.master')
@section('content')
    <div class="container py-3">
        <h4>Tambah Data Peminjam</h4>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('data_peminjam.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_user" value="{{ $user_id }}">
            <div class="form-group mb-3">
                <label for="kode_peminjam">Kode Peminjam</label>
                <input type="text" name="kode_peminjam" id="kode_peminjam" class="form-control"
                    placeholder="Kode Peminjam">
            </div>
            <div class="form-group mb-3">
                <label for="nama_peminjam">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" value="{{ $name }}" id="nama_peminjam"
                    class="form-control" placeholder="Nama Peminjam">
            </div>
            <div class="form-group mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="id_jenis_kelamin" id="id_jenis_kelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    @foreach ($list_jenis_kelamin as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                    placeholder="Tanggal Lahir">
            </div>
            <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Pekerjaan">
            </div>
            <div class="form-group mb-3">
                <label for="nomor_telepon">Telepon</label>
                <input type="text" name="nomor_telepon" id="telepon" class="form-control" placeholder="telepon">
            </div>
            <div class="form-group mb-3">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
