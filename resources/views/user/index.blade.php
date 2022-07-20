@extends('layout.master')
@section('content')
    <div class="container">
        <p class="float-end">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Data User</a>
        </p>
        <h4>Data User</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($user_list as $user)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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
            <strong>Jumlah Peminjam : {{ $jumlah_user }}</strong>
            <p>{{ $user_list->links() }}</p>
        </div>
    </div>
@endsection
