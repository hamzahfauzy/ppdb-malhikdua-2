<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFormulir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            //
            $table->string('kode_formulir')->nullable();
            $table->string('status')->nullable();
            $table->string('verificated_by')->nullable();
            $table->string('gelombang')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('staff_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            //
            $table->dropColumn(['status','staff_id','verificated_by','catatan','gelombang','kode_formulir']);
        });
    }
}
