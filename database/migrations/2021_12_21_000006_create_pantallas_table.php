<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePantallasTable extends Migration
{
    public function up()
    {
        Schema::create('pantallas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_screen');
            $table->longText('features')->nullable();
            $table->string('url_tour')->nullable();
            $table->string('brochure')->nullable();
            $table->string('plants')->nullable();
            $table->string('link_video')->nullable();
            $table->string('mapa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
