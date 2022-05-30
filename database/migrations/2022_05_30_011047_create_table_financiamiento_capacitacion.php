<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFinanciamientoCapacitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financiamiento_capacitacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_capacitacion');
            $table->foreign('id_capacitacion')->references('id')->on('capacitacion');
            $table->foreignId('id_financiamiento');
            $table->foreign('id_financiamiento')->references('id')->on('financiamiento');
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
        Schema::dropIfExists('financiamiento_capacitacion');
    }
}
