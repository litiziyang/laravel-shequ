<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->longText('content')->comment('内容');
            $table->integer('user_id')->comment('发帖人');
            $table->integer('like_num')->default(0)->comment('点赞次数');
            $table->integer('reply_num')->default(0)->comment('留言次数');
            $table->integer('post_id')->nullable()->comment('帖子id');
            $table->enum('status',['0','1'])->default('0')->comment('0:发表，1:已被删除');
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
        Schema::dropIfExists('posts');
    }
}
