<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriainteriorPantallaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('galeriainterior_pantalla', function (Blueprint $table) {
            $table->unsignedBigInteger('pantalla_id');
            $table->foreign('pantalla_id', 'pantalla_id_fk_5315366')->references('id')->on('pantallas')->onDelete('cascade');
            $table->unsignedBigInteger('galeriainterior_id');
            $table->foreign('galeriainterior_id', 'galeriainterior_id_fk_5315366')->references('id')->on('galeriainteriors')->onDelete('cascade');
        });
    }
}
