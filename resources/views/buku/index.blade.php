@extends('layout.master')
@section('content')
    <div class="container">
        @if (Auth::check() && Auth::user()->level == 'admin')
            <p class="float-end">
                <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Data Buku</a>
            </p>
        @endif
        <h4>Data Buku</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Jumlah Buku</th>
                    <th>ISBN</th>
                    <th>Pengarang</th>
                    <th>Tahun Terbit</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                        <th>Edit</th>
                        <th>Hapus</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data_buku as $buku)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $buku->kode_buku }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>{{ $buku->jumlah_buku }}</td>
                        <td>{{ $buku->ISBN }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        @if (Auth::check() && Auth::user()->level == 'admin')
                            <td>
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-success btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah kamu yakin menghapus data ini')">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-left">
            <strong>Jumlah Buku : {{ $jumlah_buku }}</strong>
            <p>{{ $data_buku->links() }}</p>
        </div>
    </div>
@endsection
