<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGenLugaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
        Schema::create('tbl_pr_lugares', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_lugar', 100);
            $table->string('tenantId', 20);
            $table->string('direccion', 100);
            $table->integer('barrio_id')->unsigned();
            $table->foreign('barrio_id')->references('id')->on('barrios');
            $table->integer('comuna_id')->unsigned();
            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->string('observaciones', 200)->nullable();
            $table->timestamps();
            $table->unique(['nombre_lugar', 'tenantId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pr_lugares');
    }
}
