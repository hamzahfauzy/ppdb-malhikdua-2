<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pendaftar');
            $table->string('no_wa');
            $table->string('email');
            $table->string('nama_calon_siswa');
            $table->string('alumni');
            $table->string('sebutkan_nama_sekolah');
            $table->string('domisili');
            $table->string('alamat');
            $table->string('tipe_pembayaran');
            $table->string('biaya_pembayaran');
            $table->string('tiket')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('contacts');
    }
}
