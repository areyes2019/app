<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CnnxnMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnnxn_categories',function(Blueprint $table){
            $table->id('idCategorie')->autoIncrement();
            $table->string('name')->unique();
            $table->integer('main')->default(0);
            $table->integer('order')->default(0);
            $table->string('slug');
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
        
    }
}
