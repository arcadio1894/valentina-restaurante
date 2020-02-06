<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->enum('service',['delivery','pickup','full']);
            $table->string('image')->nullable();
            $table->text('address');
            $table->string('phone');
            $table->string('attention_schedule');
            $table->decimal('latitude',12,10);
            $table->decimal('longitude',12,10);
            $table->integer('order')->default(0);
            $table->enum('status',['enabled','disabled'])->default('enabled');
            $table->softDeletes();
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
        Schema::dropIfExists('stores');
    }
}
