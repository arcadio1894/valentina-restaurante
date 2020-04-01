<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('type_doc', ['dni', 'passport']);
            $table->string('document');
            $table->date('birthday')->nullable();
            $table->enum('genre', ['male', 'female']);
            $table->string('phone')->nullable();
            //$table->string('address')->nullable();
            //$table->enum('type_place', ['home', 'business', 'department', 'hotel', 'condominium']);
            //$table->text('reference')->nullable();

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
        Schema::dropIfExists('customers');
    }
}
