<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbienteHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiente_horarios', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 20)->nullable();
            $table->timestamps();
        });
        Schema::table('ambiente_horarios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ambiente')->nullable();
            $table->foreign('id_ambiente')
                ->references('id')
                ->on('ambientes')
                ->onDelete('cascade');

                $table->unsignedBigInteger('id_horario')->nullable();
                $table->foreign('id_horario')
                    ->references('id')
                    ->on('horarios')
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
        Schema::dropIfExists('ambiente_horarios');
    }
}
