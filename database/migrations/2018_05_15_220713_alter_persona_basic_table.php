<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPersonaBasicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_gen_persona', function (Blueprint $table) {
            $table->integer('escolaridad_id');
            $table->integer('estado_escolaridad');
            $table->integer('ocupacion_id');
    
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
            $table->dropColumn('escolaridad_id');
            $table->dropColumn('estado_escolaridad');
            $table->dropColumn('ocupacion_id');
        });
    }
}
