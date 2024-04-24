<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

       Schema::create('ambientes',function (Blueprint $table) {
        $table->id();
        $table->string('departamento', 30);
        $table->integer('capacidad');
        $table->string('tipoDeAmbiente', 30);

        $table->unsignedBigInteger('id_ubicacion');
            $table->foreign('id_ubicacion')
                ->references('id')
                ->on('ubicacions')
                ->onDelete('cascade');
    });
    
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('ambientes');
    }
}

