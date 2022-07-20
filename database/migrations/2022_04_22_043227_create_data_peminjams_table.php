<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPeminjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjam')->unique();
            $table->string('nama_peminjam');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('foto');
            $table->foreignId('id_user');
            $table->foreignID('id_jenis_kelamin');
            $table->foreign('id_user')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('id_jenis_kelamin')
            ->references('id')->on('jenis_kelamin')
            ->onDelete('cascade');
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
        Schema::dropIfExists('data_peminjams');
    }
}
