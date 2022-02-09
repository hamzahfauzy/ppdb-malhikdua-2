<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formulir_id')->unsigned();
            $table->string("upload_kk");
            $table->string("upload_akte");
            $table->string("no_seri_ijazah");
            $table->string("upload_ijazah");
            $table->string("no_seri_shun");
            $table->string("upload_shun");
            $table->string("no_peserta_un");
            $table->string("kartu_pemerintah");
            $table->string("upload_kartu_pemerintah");
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
        Schema::dropIfExists('berkas_pendaftarans');
    }
}
