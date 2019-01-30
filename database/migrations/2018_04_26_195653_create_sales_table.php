<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customerID')->unsigned();
            $table->foreign('customerID')->references('id')->on('customers');
            $table->integer('productID')->unsigned();
            $table->foreign('productID')->references('id')->on('products');
            $table->bigInteger('invoicesInvoiceCode')->unsigned();
            $table->foreign('invoicesInvoiceCode')->references('id')->on('invoices');
            $table->integer('purchaseQuantity');
            $table->float('totalBill');
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
        Schema::dropIfExists('sales');
    }
}
