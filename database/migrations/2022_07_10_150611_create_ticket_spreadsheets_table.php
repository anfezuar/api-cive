<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSpreadsheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_spreadsheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_spreadsheet');
            $table->unsignedBigInteger('id_ticket');
            $table->foreign('id_spreadsheet')->references('id')->on('spreadsheets');
            $table->foreign('id_ticket')->references('id')->on('tickets');
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
        Schema::dropIfExists('ticket_spreadsheets');
    }
}
