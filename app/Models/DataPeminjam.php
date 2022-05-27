<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeminjam extends Model
{
    use HasFactory;

    protected $table = "data_peminjams";

    public function telepon()
    {
        return $this->hasOne(Telepon::class, 'id_peminjam');
    }

    public function jenis_kelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'id_jenis_kelamin');
    }
}
