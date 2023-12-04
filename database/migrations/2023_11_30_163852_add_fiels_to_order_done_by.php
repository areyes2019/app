<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFielsToOrderDoneBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_customer_orders', function (Blueprint $table) {
            $table->integer('rubber_by')->after('status')->nullable();
            $table->integer('art_by')->after('status')->nullable();
            $table->string('instructions')->after('status')->nullable();
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
            $table->dropColumn('rubber_by');
            $table->dropColumn('art_by');
            $table->dropColumn('instructions');
        });
    }
}
