@extends('layout.master')
@section('content')
    <div class="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        <div>
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ $user->name }}" autofocus>
                                @error('nama')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" autofocus>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="password_lama" class="col-md-4 col-form-label text-md-right">Password Lama</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password_lama') is-invalid @enderror"
                                    name="password_lama">
                                @error('password_lama')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="password_baru" class="col-md-4 col-form-label text-md-right">Password Baru</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password_baru') is-invalid @enderror"
                                    name="password_baru">
                                @error('password_baru')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>
                            <div class="col-md-6">
                                <select name="level" class="form-control">
                                    <option value="peminjam" @if($user->level == "peminjam") selected="selected" @endif>peminjam</option>
                                    <option value="admin" @if($user->level == "admin") selected="selected" @endif>admin</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <button type="sumbit" class="btn btn-primary">Edit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
