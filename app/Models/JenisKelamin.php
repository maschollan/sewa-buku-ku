<?php

namespace App\Models;

use App\Models\DataPeminjam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisKelamin extends Model
{
    use HasFactory;

    protected $table = "jenis_kelamin";

    protected $fillable = ['nama_jenis_kelamin'];
    
    public function data_peminjams()
    {
        return $this->hasMany(DataPeminjam::class, 'id_jenis_kelamin');
    }
}
