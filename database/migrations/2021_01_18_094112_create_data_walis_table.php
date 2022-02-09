<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataWalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_walis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formulir_id')->unsigned();
            $table->string('nama');
            $table->string("NIK");
            $table->string("hubungan_dengan_pendaftar");
            $table->string("pekerjaan");
            $table->string("pendidikan");
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
        Schema::dropIfExists('data_walis');
    }
}
