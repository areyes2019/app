<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnnxnArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnnxn_articles', function (Blueprint $table) {
            $table->id('idArticle');
            $table->string('name');
            $table->string('model')->nullable();
            $table->integer('lines')->nullable();
            $table->string('size')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('cost');
            $table->decimal('price');
            $table->integer('discount')->default(0);
            $table->integer('type')->default(0);
            $table->integer('provider')->nullable();
            $table->integer('re_order')->default(0);
            $table->integer('visible')->default(1);
            $table->string('img_url')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->integer('popular')->default(0);
            $table->integer('idCategorie')->nullable();
            $table->integer('idCartridge')->nullable();
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
        Schema::dropIfExists('cnnxn__articles');
    }
}
