<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_status')->default('Pending');
            $table->text('order_description')->nullable();
            $table->dateTime('order_date');
            $table->dateTime('shipping_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('completion_date')->nullable();
            $table->string('payment_type');
            $table->integer('total_products');
            $table->integer('sub_total');
            $table->boolean('is_returned')->default(false);
            $table->timestamps();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
    }
};
