<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('datos', function (Blueprint $table) {
            $table->id();
            $table->string('continente');
            $table->string('pais');
            $table->string('capital');
            $table->time('GMT_UTC');
            $table->double('latitud');
            $table->double('longuitud');
            $table->mediumInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('datos');
    }
}
