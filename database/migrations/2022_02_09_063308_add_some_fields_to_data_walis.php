<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToDataWalis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_walis', function (Blueprint $table) {
            //
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('no_handphone')->nullable();
            $table->string('penghasilan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_walis', function (Blueprint $table) {
            //
            $table->dropColumn(['tempat_lahir','tanggal_lahir','no_handphone','penghasilan']);
        });
    }
}
