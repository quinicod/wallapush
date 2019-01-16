<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto');
            $table->unsignedInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->float('precio');
            $table->boolean('nuevo');
            $table->string('img');
            $table->string('descripcion', 1000);
            $table->unsignedInteger('id_vendedor');
            $table->foreign('id_vendedor')->references('id')->on('users');
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
        Schema::dropIfExists('anuncios');
    }
}
