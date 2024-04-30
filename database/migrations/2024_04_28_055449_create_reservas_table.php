<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('id_ambiente');
        $table->foreign('id_ambiente')
            ->references('id')
            ->on('ambientes');
        
        $table->unsignedBigInteger('id_usuario_materia');
        $table->foreign('id_usuario_materia')
            ->references('id')
            ->on('usuario_materias');
        
        $table->unsignedBigInteger('id_acontecimiento');
        $table->foreign('id_acontecimiento')
            ->references('id')
            ->on('acontecimientos');
        
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
        Schema::dropIfExists('reservas');
    }
}
