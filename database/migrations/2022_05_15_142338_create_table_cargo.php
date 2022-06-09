<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre', 70);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('cargo')->insert(["nombre"=>"Administrador de Sistema", "created_at"=>now(), "updated_at"=>now()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo');
    }
}
