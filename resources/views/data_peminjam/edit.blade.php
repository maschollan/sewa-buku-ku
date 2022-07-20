@extends('layout.master')
@section('content')
    <div class="container py-3">
        <h4>Edit Data Peminjam</h4>
        <form action="{{ route('data_peminjam.update', $peminjam->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="kode_peminjam">Kode Peminjam</label>
                <input type="text" name="kode_peminjam" id="kode_peminjam" readonly class="form-control" placeholder="Kode Peminjam" value="{{ $peminjam->kode_peminjam }}">
            </div>
            <div class="form-group mb-3">
                <label for="nama_peminjam">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control" placeholder="Nama Peminjam" value="{{ $peminjam->nama_peminjam }}">
            </div>
            <div class="form-group mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="id_jenis_kelamin" id="id_jenis_kelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    @foreach ($list_jenis_kelamin as $key=> $value)
                        <option value="{{ $key }}" {{ $peminjam->id_jenis_kelamin == $key ? 'selected' : "" }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ $peminjam->tanggal_lahir }}">
            </div>
            <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat">{{ $peminjam->alamat }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Pekerjaan" value="{{ $peminjam->pekerjaan }}">
            </div>
            <div class="form-group mb-3">
                <label for="nomor_telepon">Telepon</label>
                <input type="text" name="nomor_telepon" id="telepon" class="form-control" placeholder="telepon" value="{{ $nomor_telepon }}">
            </div>
            <div class="form-group mb-3">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection