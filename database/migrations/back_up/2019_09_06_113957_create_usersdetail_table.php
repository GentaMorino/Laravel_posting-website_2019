<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        
        Schema::create('usersdetail', function (Blueprint $table) {   
            /*削除
            $table->increments('id');
            $table->integer('user_id')->unique()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('introduction')->nullable();
            $table->string('img')->nullable();
            */
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
        Schema::dropIfExists('usersdetail');
       
    }
}
