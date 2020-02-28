<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->softDeletes();

            $table->enum('type_doc', ['dni', 'passport']);
            $table->date('birthday')->nullable();
            $table->enum('genre', ['male', 'female']);
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('type_place', ['home', 'business', 'department', 'hotel', 'condominium']);
            $table->text('reference')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
