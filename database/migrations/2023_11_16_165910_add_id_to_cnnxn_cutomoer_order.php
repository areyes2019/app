<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToCnnxnCutomoerOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_customer_orders', function (Blueprint $table) {
            $table->integer('idCustomer')->after('slug')->nullable();
            $table->integer('type')->after('idCustomer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cnnxn_cutomoer_order', function (Blueprint $table) {
            $table->dropColumn('idCustomer');
            $table->dropColumn('type');
        });
    }
}
