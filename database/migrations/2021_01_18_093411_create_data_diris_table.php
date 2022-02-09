<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDirisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_diris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formulir_id')->unsigned();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('tempat_tinggal');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('NIK');
            $table->string('anak_ke');
            $table->string('jumlah_saudara');
            $table->string('status');
            $table->timestamps();

            $table->foreign('formulir_id')->references('id')->on('formulirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_diris');
    }
}
