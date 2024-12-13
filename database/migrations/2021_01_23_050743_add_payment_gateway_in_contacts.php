<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentGatewayInContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
            $table->string('payment_gateway')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('checkout_url')->nullable();
            $table->string('expired_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
            $table->dropColumn([
                'payment_gateway',
                'payment_reference',
                'payment_code',
                'checkout_url',
                'expired_time',
            ]);
        });
    }
}
