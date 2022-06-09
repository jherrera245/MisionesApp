<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDepartamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('departamento')->insert(["nombre"=>"Desarrollo", "created_at"=>now(), "updated_at"=>now()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamento');
    }
}
