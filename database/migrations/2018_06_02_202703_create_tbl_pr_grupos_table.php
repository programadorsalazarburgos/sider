<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPrGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pr_grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_grupo', 100);
            $table->string('tenantId', 20);
            $table->integer('lugar_id')->unsigned();
            $table->foreign('lugar_id')->references('id')->on('tbl_pr_lugares'); 
            $table->integer('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('tbl_pr_disciplinas');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('observaciones', 200)->nullable();
            $table->integer('estado');
            $table->timestamps();
            $table->unique(['nombre_grupo', 'tenantId']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pr_grupos');
    }
}
