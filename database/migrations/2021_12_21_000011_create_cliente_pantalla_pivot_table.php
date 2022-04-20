<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientePantallaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cliente_pantalla', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id', 'cliente_id_fk_5251920')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('pantalla_id');
            $table->foreign('pantalla_id', 'pantalla_id_fk_5251920')->references('id')->on('pantallas')->onDelete('cascade');
        });
    }
}
