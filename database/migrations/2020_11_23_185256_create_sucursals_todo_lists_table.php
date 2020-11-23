<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalsTodoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals_todo_lists', function (Blueprint $table) {
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('todo_list_id')->unsigned();

            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('cascade');
            $table->foreign('todo_list_id')->references('id')->on('todo_lists')->onDelete('cascade');

            $table->primary(['sucursal_id','todo_list_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursals_todo_lists');
    }
}
