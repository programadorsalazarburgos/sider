<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_gen_persona', function (Blueprint $table) {
            $table->integer('departamento_residencia_id');
            $table->integer('municipio_residencia_id');
            $table->string('direccion_residencia', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_gen_persona', function (Blueprint $table) {
            $table->dropColumn('departamento_residencia_id');
            $table->dropColumn('municipio_residencia_id');
            $table->dropColumn('direccion_residencia');
        });
    }
}
