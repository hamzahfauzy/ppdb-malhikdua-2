<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formulir_id')->unsigned();
            $table->string("NISN");
            $table->string("sekolah_asal");
            $table->string("NPSN");
            $table->string("angkatan_lulus");
            $table->text("alamat");
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
        Schema::dropIfExists('data_pendidikans');
    }
}
