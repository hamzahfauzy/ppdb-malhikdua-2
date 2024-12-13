<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToDataPendidikans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_pendidikans', function (Blueprint $table) {
             $table->string('NSM')->nullable();
            $table->string('prestasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_pendidikans', function (Blueprint $table) {
            //
            $table->dropColumn(['NSM','prestasi']);
        });
    }
}
