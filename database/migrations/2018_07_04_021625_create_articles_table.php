<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('標題');
            $table->string('photo')->comment('圖片');
            $table->char('features')->comment('特色');
            $table->char('short_desc')->comment('描述');
            $table->integer('view_num')->default(0)->comment('觀看次數');
            $table->integer('comment_num')->default(0)->comment('留言次數');
            $table->integer('like_num')->default(0)->comment('愛心數');
            $table->integer('status')->default(1)->comment('狀態 1:顯示 0:隱藏');
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
        Schema::dropIfExists('articles');
    }
}
