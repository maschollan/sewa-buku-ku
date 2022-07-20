@extends('layout.master')
@section('content')

    @if (count($data_peminjam))
        <div class="container py-3">
            <h4>Data Peminjam</h4>

            @include('_partial/flash_message')

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
                        <th>Telepon</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_peminjam as $peminjam)
                        <tr>
                            <td>{{ $peminjam->id }}</td>
                            <td>{{ $peminjam->kode_peminjam }}</td>
                            <td>{{ $peminjam->nama_peminjam }}</td>
                            <td>{{ $peminjam->jenis_kelamin['nama_jenis_kelamin'] }}</td>
                            <td>{{ $peminjam->tanggal_lahir }}</td>
                            <td>{{ $peminjam->alamat }}</td>
                            <td>{{ $peminjam->pekerjaan }}</td>
                            <td>
                                {{ !empty($peminjam->telepon['nomor_telepon']) ? $peminjam->telepon['nomor_telepon'] : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('data_peminjam.edit', $peminjam->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('data_peminjam.destroy', $peminjam->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah kamu yakin menghapus data ini')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-left">
                <p>{{ $data_peminjam->links() }}</p>
            </div>

        </div>
    @else
        <div class="container py-3">
            <h4>Data {{ $cari }} tidak ditemukan</h4>
            <div class="text-end">
                <a href="{{ route('data_peminjam') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    @endif

@endsection
