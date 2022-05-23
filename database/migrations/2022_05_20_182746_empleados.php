<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empleados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('id');
            //Tipos dato form
            //nombre
            $table->string('nombre', 100);
            //email
            $table->string('email', 100);
            //sexo
            $table->char('sexo', 1);
            //area_id
            $table->integer('area_id')->unsigned()->index();
            //boletin
            $table->integer('boletin');
            //descripcion 
            $table->text('descripcion');
            
            $table->timestamps();

            //$table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });        

        Schema::table('empleados', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
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
