<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('store_id');
            $table->string('name');
            $table->mediumText('description');
            $table->string('category');
            $table->integer('stock')->unsigned();
            $table->decimal('price', 5, 2)->nullable()->default(0.00);
            $table->string('image');
            $table->string('texture');
            $table->string('size');
            $table->string('location');
            $table->string('color');
            $table->integer('discount')->nullable();
            $table->string('imageUrl')->nullable();
            $table->timestamps();

            $table->foreign('store_id')->references('store_id')->on('partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

