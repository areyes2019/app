<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnnxnProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnnxn_productions', function (Blueprint $table) {
            $table->id('idJob')->autoIncrement();
            $table->integer('idOrder')->nullable();
            $table->integer('idQuotation')->nullable();
            $table->integer('status')->nullable();
            $table->decimal('rubber')->nullable();
            $table->decimal('design')->nullable();
            $table->integer('done_by')->nullable();
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
        Schema::dropIfExists('cnnxn_productions');
    }
}
