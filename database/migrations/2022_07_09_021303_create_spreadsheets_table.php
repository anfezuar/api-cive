<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpreadsheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spreadsheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo');
            $table->unsignedBigInteger('conductor');
            $table->string('origen');
            $table->string('destino');
            $table->string('usuario');
            $table->string('updated_by')->nullable();
            $table->foreign('vehiculo')->references('id')->on('vehicles');
            $table->foreign('conductor')->references('id')->on('drivers');
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
        Schema::dropIfExists('spreadsheets');
    }
}
