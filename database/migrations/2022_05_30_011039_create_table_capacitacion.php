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
            $table->string('modalidad', 45);
            $table->string('descripcion', 250)->nullable();
            $table->integer('cantidad_horas');
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
