<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->char('order_code');

            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained('users');

            $table->foreignId('product_id')->constrained();
            $table->integer('amount');

            // 0: cancelled, 1: pending, 2: Success
            $table->enum('payment_status', [0, 1, 2]);
            // 0: pending, 1: shipping, 2: Received
            $table->enum('shipping_status', [0, 1, 2]);

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
        Schema::dropIfExists('orders');
    }
}
