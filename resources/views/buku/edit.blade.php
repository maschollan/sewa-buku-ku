@extends('layout.master')
@section('content')
    <div class="container py-3">
        <h4>Tambah Data Buku</h4>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.store', $buku->id) }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="kode_buku">Kode Buku</label>
                <input type="text" name="kode_buku" value="{{ $buku->kode_buku }}" id="kode_buku" class="form-control"
                    placeholder="Kode Buku">
            </div>
            <div class="form-group mb-3">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}" id="judul_buku"
                    class="form-control" placeholder="Judul Buku">
            </div>
            <div class="form-group mb-3">
                <label for="jumlah_buku">Jumlah Buku</label>
                <input type="text" name="jumlah_buku" value="{{ $buku->jumlah_buku }}" id="jumlah_buku"
                    class="form-control" placeholder="Jumlah Buku">
            </div>
            <div class="form-group mb-3">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="{{ $buku->isbn }}" class="form-control"
                    placeholder="ISBN">
            </div>
            <div class="form-group mb-3">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" value="{{ $buku->pengarang }}" id="pengarang" class="form-control"
                    placeholder="pengarang">
            </div>
            <div class="form-group mb-3">
                <label for="tahun_terbit">Tahun Terbit</label>
                <select name="tahun_terbit" id="tahun_terbit" class="form-control">
                    @for ($i = 2000; $i <= date('Y'); $i++)
                        <option value="{{ $i }}" @if ($buku->tahun_terbit == $i) selected @endif>
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
