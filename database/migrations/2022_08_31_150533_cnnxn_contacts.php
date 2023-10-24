<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CnnxnContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnnxn_contacts', function (Blueprint $table) {
            $table->id('idContact')->autoIncrement();
            $table->integer('type')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('zone')->nullable();
            $table->string('zip')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('company')->nullable();
            $table->integer('store_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            $table->dropColumn('idContact')->autoIncrement();
            $table->dropColumn('type')->nullable();
            $table->dropColumn('name')->nullable();
            $table->dropColumn('email')->nullable();
            $table->dropColumn('phone')->nullable();
            $table->dropColumn('mobile')->nullable();
            $table->dropColumn('address')->nullable();
            $table->dropColumn('zone')->nullable();
            $table->dropColumn('zip')->nullable();
            $table->dropColumn('tax_id')->nullable();
            $table->dropColumn('company')->nullable();
            $table->dropColumn('store_id')->nullable();
            $table->timestamps();
    }
}
