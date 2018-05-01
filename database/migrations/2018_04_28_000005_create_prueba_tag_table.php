<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePruebaTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prueba_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prueba_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();


            $table->foreign('prueba_id')->references('id')->on('pruebas');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prueba_tag');
    }
}
