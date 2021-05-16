<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIsAlwaysAvailableToInStockToMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->renameColumn('is_always_available', 'in_stock');
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
            $table->renameColumn('in_stock', 'is_always_available');
        });
    }
}
