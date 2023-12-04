<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrandTotalToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_customer_orders', function (Blueprint $table) {
            $table->decimal('grand_total')->after('total')->nullable();           
            $table->decimal('total_sum')->after('tax')->nullable();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cnnxn_customer_orders', function (Blueprint $table) {
            $table->dropColumn('grand_total');           
            $table->dropColumn('total_sum');           
        });
    }
}
