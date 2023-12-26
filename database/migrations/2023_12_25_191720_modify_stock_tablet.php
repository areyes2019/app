<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStockTablet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_stock', function (Blueprint $table) {
            $table->renameColumn('cost','total_cost');
            $table->renameColumn('total','total_price');
            $table->renameColumn('total_value','profit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('cnnxn_stock', function (Blueprint $table) {
            $table->renameColumn('total_cost','cost');
            $table->renameColumn('total_price','total');
            $table->renameColumn('profit','total_value');
        });
    }
}
