<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('radio_station_id');
            $table->integer('agency_id');
            $table->string('invoice_number',30);
            $table->longText('Description');
            $table->integer('qty');
            $table->string('vat',20);
            $table->string('vat_amount',20);
            $table->string('nhil',20);
            $table->string('nhil_amount',20);
            $table->string('getfund',20);
            $table->string('getfund_amount',20);
            $table->string('unit_price',20);
            $table->string('total_price',20);
            $table->string('taxable_amt',20);
            $table->string('final_amt_to_pay',20);
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
        Schema::dropIfExists('invoices');
    }
}
