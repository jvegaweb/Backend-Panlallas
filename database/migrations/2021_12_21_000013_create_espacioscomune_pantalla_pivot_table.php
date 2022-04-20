<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspacioscomunePantallaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('espacioscomune_pantalla', function (Blueprint $table) {
            $table->unsignedBigInteger('pantalla_id');
            $table->foreign('pantalla_id', 'pantalla_id_fk_5315367')->references('id')->on('pantallas')->onDelete('cascade');
            $table->unsignedBigInteger('espacioscomune_id');
            $table->foreign('espacioscomune_id', 'espacioscomune_id_fk_5315367')->references('id')->on('espacioscomunes')->onDelete('cascade');
        });
    }
}
