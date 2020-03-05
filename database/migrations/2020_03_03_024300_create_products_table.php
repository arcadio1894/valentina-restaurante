<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->string('code');
            $table->string('name');
            $table->text('description');
            $table->enum('type',['simple','bundle']);
            $table->string('small_image')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price',6,2);
            $table->integer('initial_stock')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('position')->default(0);
            $table->enum('status',['enabled','disabled'])->default('enabled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
