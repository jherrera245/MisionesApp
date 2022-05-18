<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 75);
            $table->string('apellidos', 75);
            $table->string('dui', 10)->unique();
            $table->foreignId('id_nivel_academico');
            $table->foreign('id_nivel_academico')->references('id')->on('nivel_academico');
            $table->foreignId('id_departamento');
            $table->foreign('id_departamento')->references('id')->on('departamento');
            $table->foreignId('id_cargo');
            $table->foreign('id_cargo')->references('id')->on('cargo');
            $table->string('telefono');
            $table->boolean('coordinador')->default(false);
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
        Schema::dropIfExists('empleado');
    }
}
