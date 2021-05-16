<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitIdToMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('unit');
            $table->foreignId('unit_id')->after('size_per_unit')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('unit')->after('size_per_unit');
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
}
