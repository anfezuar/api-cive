<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemittancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittances', function (Blueprint $table) {
            $table->id();
            $table->string('origen');
            $table->string('destino');
            $table->double('valor');
            $table->unsignedBigInteger('cedula_destinatario');
            $table->string('direccion_destinatario');
            $table->unsignedBigInteger('cedula_remitente');
            $table->string('direccion_remitente');
            $table->string('contenido');
            $table->string('usuario');
            $table->boolean('puerta');
            $table->unsignedBigInteger('vehiculo');
            $table->string('estado');
            $table->foreign('cedula_destinatario')->references('id')->on('customers');
            $table->foreign('cedula_remitente')->references('id')->on('customers');
            $table->foreign('vehiculo')->references('id')->on('vehicles');
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
        Schema::dropIfExists('remittances');
    }
}
