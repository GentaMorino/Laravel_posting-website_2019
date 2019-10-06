<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_articles', function (Blueprint $table) {
  
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');

            //$table->integer('structure_id')->references('id')->on('structures')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('structure_id')->unsigned();
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('restrict')->onUpdate('restrict');
            
            $table->text('content');
            $table->integer('number');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_articles');
    }
}
