<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('rut')->unique();
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->integer('phone');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
