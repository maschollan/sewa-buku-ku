@extends('layout.master')
@section('content')
    <div class="container py-3">
        <h4>Data Peminjam</h4>

        @include('_partial/flash_message')

        <a href="{{ route('data_peminjam.data_peminjam_pdf') }}" class="btn btn-primary">Download pdf</a>
        <a href="{{ route('data_peminjam.export_excel') }}" class="btn btn-primary">Export excel</a>

        {{-- <div class="text-end">
            <a href="{{ route('data_peminjam.create') }}" class="btn btn-primary">Tambah Data Peminjam</a>
        </div> --}}

        <form action="{{ route('data_peminjam.search') }}" method="get" class="d-flex" style="width:400px;">
            @csrf 
            <input type="text" class="form-control form-control-sm me-3" name="kata" placeholder="Cari....">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>

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
                    <th>Foto</th>
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
                            @if (empty($peminjam->foto) || $peminjam->foto == "")
                                <img src="{{ asset('foto_peminjam/no-profile.png') }}" alt="" style="width: 50px; height: 50px;">
                                
                            @else
                                <img src="{{ asset('foto_peminjam/'.$peminjam->foto) }}" alt="" style="width: 50px; height: 50px;">
                            @endif  
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
            <strong>Jumlah Peminjam : {{ $jumlah_peminjam }}</strong>
            <p>{{ $data_peminjam->links() }}</p>
        </div>

    </div>
@endsection
