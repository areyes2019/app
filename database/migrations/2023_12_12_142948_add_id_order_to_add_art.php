<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdOrderToAddArt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_add_art', function (Blueprint $table) {
            $table->integer('idOrder')->after('idLine')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cnnxn_add_art', function (Blueprint $table) {
            $table->dropColumn('idOrder');
        });
    }
}
