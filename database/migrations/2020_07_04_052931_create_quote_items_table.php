<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->unsigned()->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes');
            $table->integer('parent_item_id')->unsigned()->nullable();
            $table->foreign('parent_item_id')->references('id')->on('quote_items');
            $table->integer('selection_id')->unsigned()->nullable();
            $table->foreign('selection_id')->references('id')->on('product_selections');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->enum('product_type',['simple','bundle']);
            $table->string('name');
            $table->string('code');
            $table->text('description');
            $table->integer('qty');
            $table->decimal('price',6,2);
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
        Schema::dropIfExists('quote_items');
    }
}
