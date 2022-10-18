<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cnnxn_contacts', function (Blueprint $table) {
            $table->decimal('dicount')->after('tax_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cnnxn_contacts', function (Blueprint $table) {
            $table->dropColumn('dicount');
        });
    }
}
