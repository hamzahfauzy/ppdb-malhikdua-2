<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToBerkasPendaftarans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berkas_pendaftarans', function (Blueprint $table) {
            //
            $table->string('vaksin')->nullable();
            $table->string('upload_vaksin')->nullable();
            $table->string('no_kip')->nullable();
            $table->string('upload_kip')->nullable();
            $table->string('no_kks')->nullable();
            $table->string('upload_kks')->nullable();
            $table->string('no_pkh')->nullable();
            $table->string('upload_pkh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berkas_pendaftarans', function (Blueprint $table) {
            //
            $table->dropColumn(['vaksin','upload_vaksin','no_kip','upload_kip','no_kks','upload_kks','no_pkh','upload_pkh']);
        });
    }
}
