<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCapacitacionEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitacion_empleado', function (Blueprint $table) {
            $table->id();
            $table->string('comprobante_incripcion', 255)->nullable();
            $table->string('comprobante_finalizacion', 255)->nullable();
            $table->foreignId('id_empleado');
            $table->foreign('id_empleado')->references('id')->on('empleado');
            $table->foreignId('id_capacitacion');
            $table->foreign('id_capacitacion')->references('id')->on('capacitacion');
            $table->foreignId('id_estado_capacitacion');
            $table->foreign('id_estado_capacitacion')->references('id')->on('estado_capacitacion');
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
        Schema::dropIfExists('capacitacion_empleado');
    }
}
