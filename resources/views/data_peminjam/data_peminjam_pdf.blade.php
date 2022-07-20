<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Peminjam</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<h4 class="text-center">Laporan Data Peminjam</h4>
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
            </tr>
        @endforeach
    </tbody>
</table>

<body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
