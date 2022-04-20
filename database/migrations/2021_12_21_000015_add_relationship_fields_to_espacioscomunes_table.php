<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEspacioscomunesTable extends Migration
{
    public function up()
    {
        Schema::table('espacioscomunes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pantalla_id')->nullable();
            $table->foreign('id_pantalla_id', 'id_pantalla_fk_5315369')->references('id')->on('pantallas');
        });
    }
}
