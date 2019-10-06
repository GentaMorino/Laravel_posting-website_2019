<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            //記事id
            $table->increments('id');
           
            //ユーザー_id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //画像
            $table->string('thumbnail')->nullable();

            //分類_id
            $table->integer('classification_id')->references('id')->on('classifications')->onDelete('cascade')->onUpdate('cascade');
            //タブ（フォルダ）_id
            $table->integer('tab_id')->references('id')->on('tabs')->onDelete('cascade')->onUpdate('cascade')->nullable();
            //タグ１_id
            $table->string('tag1')->nullable();
            $table->string('tag2')->nullable();
            $table->string('tag3')->nullable();
            $table->string('tag4')->nullable();
            $table->string('tag5')->nullable();

            //おすすめ
            $table->boolean('recommended')->nullable();
            //作成日、更新日
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
        Schema::dropIfExists('article');
    }
}
