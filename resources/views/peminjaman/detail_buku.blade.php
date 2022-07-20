@extends('layout.master')
@section('content')
    <div class="container">
        <h4>Detail Buku</h4>
        <p>Kode Buku : {{ $data_buku->kode_buku }}</p>
        <p>Judul Buku : {{ $data_buku->judul_buku }}</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku Yang Dipinjam</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($data_buku->data_peminjam as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $item->nama_peminjam }}</td>
                    </tr>
                    @php $no++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection