<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('radio_station_id');
            $table->integer('order_id');
            $table->integer('program_id');
            $table->integer('agency_id');
            $table->integer('advert_id');
            $table->string('date',20)->nullable();
            $table->string('time',10)->nullable();
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
        Schema::dropIfExists('commercials');
    }
}
