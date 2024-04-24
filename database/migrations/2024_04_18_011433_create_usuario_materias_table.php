<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_materias', function (Blueprint $table) {
            $table->id();
        });
        Schema::table('usuario_materias', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            }    
        );
        Schema::table('usuario_materias', function (Blueprint $table) {
            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')
                ->references('id')
                ->on('materias')
                ->onDelete('cascade');
            }    
        );   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario__materias');
    }
}
