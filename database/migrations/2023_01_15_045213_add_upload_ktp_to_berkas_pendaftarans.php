<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUploadKtpToBerkasPendaftarans extends Migration
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
            $table->string('upload_ktp_ayah')->nullable();
            $table->string('upload_ktp_ibu')->nullable();
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
            $table->dropColumn('upload_ktp_ayah');
            $table->dropColumn('upload_ktp_ibu');
        });
    }
}
