<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCapacitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_capacitacion', 55);
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->foreignId('id_modalidad');
            $table->foreign('id_modalidad')->references('id')->on('modalidad_capacitacion');
            $table->string('descripcion', 250)->nullable();
            $table->float('cantidad_horas', 5,2);
            $table->float('costo', 10, 2);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('capacitacion');
    }
}
