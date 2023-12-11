<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyItemsInArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_articles', function (Blueprint $table) {
            $table->decimal('design')->default(0)->change();
            $table->decimal('cost')->default(0)->change();
            $table->decimal('price')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cnnxn_articles', function (Blueprint $table){
            $table->decimal('design')->change();
            $table->decimal('cost')->change();
            $table->decimal('price')->change();
        });
    }
}
