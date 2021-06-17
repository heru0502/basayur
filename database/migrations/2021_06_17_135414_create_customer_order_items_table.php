<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('customer_orders');
            $table->foreignId('menu_id')->constrained();
            $table->decimal('original_price', 10,0);
            $table->unsignedTinyInteger('dicount')->default(0);
            $table->decimal('selling_price',10,0);
            $table->unsignedSmallInteger('qty');
            $table->unsignedSmallInteger('total_price');
            $table->unsignedSmallInteger('size_per_unit');
            $table->foreignId('unit_id')->constrained();
            $table->string('note', 1000)->nullable();
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
        Schema::dropIfExists('customer_order_items');
    }
}
