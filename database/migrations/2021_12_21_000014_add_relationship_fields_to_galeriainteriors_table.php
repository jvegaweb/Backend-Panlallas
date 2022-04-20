<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGaleriainteriorsTable extends Migration
{
    public function up()
    {
        Schema::table('galeriainteriors', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pantalla_id')->nullable();
            $table->foreign('id_pantalla_id', 'id_pantalla_fk_5315368')->references('id')->on('pantallas');
        });
    }
}
