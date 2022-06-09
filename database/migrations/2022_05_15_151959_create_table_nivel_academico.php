<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNivelAcademico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_academico', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',70);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('nivel_academico')->insert(["nombre"=>"Ing. Desarrollo de Software", "created_at"=>now(), "updated_at"=>now()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nivel_academico');
    }
}
