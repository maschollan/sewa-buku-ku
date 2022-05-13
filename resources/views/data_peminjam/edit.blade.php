@extends('layout.master')
@section('content')
    <div class="container py-3">
        <h4>Edit Data Peminjam</h4>
        <form action="{{ route('data_peminjam.update', $peminjam->id) }}" method="post">
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
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    @if ($peminjam->jenis_kelamin == 'Laki-laki')
                        <option value="Laki-laki" selected>Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    @elseif ($peminjam->jenis_kelamin == 'Perempuan')
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>                        
                    @endif
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
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
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection