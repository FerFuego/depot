<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_sucursals', function (Blueprint $table) {
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('sale_id')->unsigned();

            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('cascade');

            $table->primary(['sale_id','sucursal_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_sucursals');
    }
}
