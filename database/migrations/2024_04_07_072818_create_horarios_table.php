<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->time('horaini')->nullable(false);
            $table->time('horafin')->nullable(false);
            $table->string('estado', 20)->nullable();
            $table->timestamps();
        });
        Schema::table('horarios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ambiente')->nullable();
            $table->foreign('id_ambiente')
                ->references('id')
                ->on('ambientes')
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
        Schema::dropIfExists('periodos');
    }
}
