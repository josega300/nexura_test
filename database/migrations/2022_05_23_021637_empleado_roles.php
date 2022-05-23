<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpleadoRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_roles', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->bigInteger('empleado_id')->unsigned()->index();
            $table->integer('rol_id')->unsigned()->index();
            $table->timestamps();
           
        });

        Schema::table('empleado_roles', function (Blueprint $table) {
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
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
