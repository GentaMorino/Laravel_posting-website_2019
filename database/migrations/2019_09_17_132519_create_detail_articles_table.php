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
            $table->integer('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('structure_id')->references('id')->on('structures')->onDelete('cascade')->onUpdate('cascade');
            $table->text('content');
            $table->integer('number');
            //$table->timestamps();
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
