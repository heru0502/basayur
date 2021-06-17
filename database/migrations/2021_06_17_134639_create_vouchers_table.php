<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->boolean('is_active')->default(false);
            $table->string('title');
            $table->string('content', 1000)->nullable();
            $table->unsignedTinyInteger('percentage')->nullable();
            $table->decimal('fixed_discount',10,0)->nullable();
            $table->decimal('min_purchase',10,0);
            $table->decimal('max_discount',10,0)->nullable();
            $table->unsignedInteger('max_usage');
            $table->unsignedInteger('total_usage')->default(0);
            $table->date('start_at');
            $table->date('end_at');
            $table->string('image_url')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}
