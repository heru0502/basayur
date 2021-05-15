<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->constrained();
            $table->string('name');
            $table->decimal('price', 10,0);
            $table->decimal('special_price', 10,0)->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_always_available');
            $table->unsignedSmallInteger('stock')->nullable();
            $table->unsignedSmallInteger('size_per_unit');
            $table->string('unit', 20);
            $table->string('description', 700);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
