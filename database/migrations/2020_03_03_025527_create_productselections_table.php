<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductselectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productselections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_id')->unsigned();
            $table->foreign('option_id')->references('id')->on('productoptions');
            $table->integer('position')->default(0);
            $table->boolean('is_default')->default(false);
            $table->decimal('price',6,2)->default(0);
            $table->integer('qty')->default(1);
            $table->integer('parent_product_id')->unsigned();
            $table->foreign('parent_product_id')->references('id')->on('products');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('productselections');
    }
}
