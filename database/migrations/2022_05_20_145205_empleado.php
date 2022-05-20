<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empleado', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('id');
            //Tipos dato form
            //nombre
            $table->string('nombre', 100);
            //email
            $table->string('email', 100);
            //sexo
            $table->char('name', 1);
            //area_id
            $table->bigInteger('area_id')->unsinged();
            //boletin
            $table->integer('votes');
            //descripcion 
            $table->text('description');
            
            $table->timestamps();

            $table->foreing('area_id')->references('id')->on('areas')->onDelete('cascade');
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
