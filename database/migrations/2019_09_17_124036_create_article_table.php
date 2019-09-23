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
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
            /*変更
            $table->integer('tag1_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('tag2_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('tag3_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('tag4_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('tag5_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade')->nullable();
            */
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
