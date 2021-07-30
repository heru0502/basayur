<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullableVoucherIdInCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_id')->change();
        });
    }
}
