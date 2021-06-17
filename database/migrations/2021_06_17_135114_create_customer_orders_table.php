<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->char('order_number', 10);
            $table->foreignId('status_order_id')->constrained();
            $table->foreignId('status_payment_id')->constrained();
            $table->foreignId('status_delivery_id')->constrained();
            $table->decimal('subtotal', 10,0);
            $table->decimal('discount_price', 10, 0)->nullable();
            $table->unsignedTinyInteger('discount_percentage')->nullable();
            $table->decimal('grand_total', 10, 0);
            $table->foreignId('voucher_id')->constrained();
            $table->foreignId('payment_id')->constrained();
            $table->foreignId('delivery_id')->constrained();
            $table->foreignId('customer_address_id')->constrained();
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
        Schema::dropIfExists('customer_orders');
    }
}
