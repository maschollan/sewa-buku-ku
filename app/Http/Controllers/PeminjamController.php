<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function lihat_data_peminjam()
    {
        $peminjam = [
            'Kholan Mustaqim',
            'Aldo Siapa',
            'Siapa Sih',
            'Mita Sang Lord'
        ];
        return view("peminjams.lihat_data_peminjam", compact('peminjam'));
    }
}
