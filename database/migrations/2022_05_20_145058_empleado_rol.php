<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpleadoRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empleado_rol', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->bigInteger('empleado_id')->unsinged();
            $table->bigInteger('rol_id')->unsinged();
            $table->timestamps();
            $table->foreing('empleado_id')->references('id')->on('empleado')->onDelete('cascade');
            $table->foreing('rol_id')->references('id')->on('rol')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
