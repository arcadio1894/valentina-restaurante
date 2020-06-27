<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOndeleteProductselectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productselections', function (Blueprint $table) {
            $table->dropForeign(['option_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productselections', function (Blueprint $table) {
            $table->foreign('option_id')->references('id')->on('productoptions')->onDelete('cascade');
        });
    }
}
