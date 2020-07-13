<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->unsigned()->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('customer_address_id')->unsigned()->nullable();
            $table->foreign('customer_address_id')->references('id')->on('locations');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('telephone');
            $table->string('document_number');
            $table->enum('document_type',['dni', 'passport']);
            $table->enum('place_type',['home', 'business', 'department', 'hotel', 'condominium']);
            $table->text('address');
            $table->text('reference');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('zone_id')->unsigned()->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->integer('shipping_id')->unsigned()->nullable();
            $table->foreign('shipping_id')->references('id')->on('shipping_methods');
            $table->string('shipping_code');
            $table->string('shipping_name');
            $table->decimal('shipping_amount',6,2);
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
        Schema::dropIfExists('quote_addresses');
    }
}
