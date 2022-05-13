@extends('layout.master')

@section('content')
    <div id="peminjam">
        <h2>Data Peminjam</h2>
        @if (!empty($peminjam))
            <ul>
                @foreach ($peminjam as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else 
        <p>Data peminjam kosong</p>
        @endif
    </div>
@endsection
