<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableModalidadCapacitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidad_capacitacion', function (Blueprint $table) {
            $table->id();
            $table->string('modalidad', 55);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        DB::table('modalidad_capacitacion')->insert(["modalidad"=>"Virtual", "created_at"=>now(), "updated_at"=>now()]);
        DB::table('modalidad_capacitacion')->insert(["modalidad"=>"Presencial", "created_at"=>now(), "updated_at"=>now()]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modalidad_capacitacion');
    }
}
