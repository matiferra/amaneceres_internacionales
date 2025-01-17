<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_paises')->create('paises', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('nombre');
            $table->string('capital');
            $table->double('GMT_UTC');
            $table->double('latitud');
            $table->double('longuitud');
            $table->mediumInteger('id_continente')->unsigned();
            $table->foreign('id_continente')
                ->references('id')
                ->on('continentes');
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
        Schema::dropIfExists('paises');
    }
}
