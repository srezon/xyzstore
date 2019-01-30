<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('productName');
            $table->string('productModel')->nullable();
            $table->integer('productCategoryID')->unsigned();
            $table->foreign('productCategoryID')->references('id')->on('categories');
            $table->integer('productBrandID')->unsigned();
            $table->foreign('productBrandID')->references('id')->on('brands');
            $table->integer('productQuantity');
            $table->float('productBuyingPrice');
            $table->float('productSellingPrice');
            $table->text('productNotes')->nullable();
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
        Schema::dropIfExists('products');
    }
}
