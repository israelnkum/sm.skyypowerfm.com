<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('radio_station_id');
            $table->string('agency_name');
            $table->string('address')->nullable();
            $table->string('fax',15)->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('discount')->default(0);
            $table->string('contact_person');
            $table->integer('user_id');
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
        Schema::dropIfExists('agencies');
    }
}
