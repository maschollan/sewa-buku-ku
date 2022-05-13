@extends('layout.master')
@section('content')
    <div class="container py-3">
        <h4>Data Peminjam</h4>
        <div class="text-end">
            <a href="{{ route('data_peminjam.create') }}" class="btn btn-primary">Tambah Data Peminjam</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Kode Peminjam</th>
                    <th>Nama Peminjam</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_peminjam as $peminjam)
                    <tr>
                        <td>{{ $peminjam->id }}</td>
                        <td>{{ $peminjam->kode_peminjam }}</td>
                        <td>{{ $peminjam->nama_peminjam }}</td>
                        <td>{{ $peminjam->jenis_kelamin }}</td>
                        <td>{{ $peminjam->tanggal_lahir }}</td>
                        <td>{{ $peminjam->alamat }}</td>
                        <td>{{ $peminjam->pekerjaan }}</td>
                        <td>
                            <a href="{{ route('data_peminjam.edit', $peminjam->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-left">
            <strong>Jumlah Peminjam : {{ $jumlah_peminjam }}</strong>
        </div>

    </div>
@endsection
