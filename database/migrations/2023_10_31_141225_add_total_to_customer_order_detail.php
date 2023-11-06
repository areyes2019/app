<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalToCustomerOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_customer_order_details', function (Blueprint $table) {
            $table->decimal('unit')->after('name')->default(0);
            $table->decimal('total')->after('unit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cnnxn_customer_order_details', function (Blueprint $table) {
            $table->dropColumn('unit');
            $table->dropColumn('total');
        });
    }
}
