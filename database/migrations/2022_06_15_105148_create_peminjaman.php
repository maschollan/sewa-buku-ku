<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignID('id_peminjam');
            $table->foreignID('id_buku');
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian');
            
            $table->foreign('id_peminjam')->references('id')->on('data_peminjams')->onDelete('cascade');
            $table->foreign('id_buku')->references('id')->on('data_buku')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
