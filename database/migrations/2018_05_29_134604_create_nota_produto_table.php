<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_produto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')
            ->references('id')->on('produto')
            ->onDelete('cascade');
            $table->integer('nota_id')->unsigned();
            $table->foreign('nota_id')
            ->references('id')->on('nota')
            ->onDelete('cascade');
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
        Schema::dropIfExists('nota_produto');
    }
}
