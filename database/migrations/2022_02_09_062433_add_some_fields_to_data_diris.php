<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToDataDiris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_diris', function (Blueprint $table) {
            //
            $table->string('agama')->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('email')->nullable();
            $table->string('yang_membiayai_sekolah')->nullable();
            $table->string('nama_kepala_keluarga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_diris', function (Blueprint $table) {
            //
            $table->dropColumn(['agama','cita_cita','email','yang_membiayai_sekolah','nama_kepala_keluarga']);
        });
    }
}
