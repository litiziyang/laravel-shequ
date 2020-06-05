<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('昵称');
            $table->integer('phone')->comment('电话号码')->unique();
            $table->date('birthday')->comment('生日')->default(date('yy-m-d',time()));
            $table->integer('height')->comment('身高')->default(0);
            $table->enum('status', ['0', '1', '2', '3'])->default('0')->comment("状态0:经期，1:备孕，2:怀孕，3:宝妈");
            $table->integer('cycle')->comment('周期')->default(0);
            $table->integer('duration')->comment('持续时间')->default(0);
            $table->string('address')->comment('地址')->default('未输入地址');
            $table->integer('godcoin')->comment('金币')->default(0);
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
        Schema::dropIfExists('users');
    }
}
