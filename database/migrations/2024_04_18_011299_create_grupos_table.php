<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('grupo', 20);
        });

        Schema::table('grupos', function (Blueprint $table) {
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
        Schema::dropIfExists('grupos');
    }
}
