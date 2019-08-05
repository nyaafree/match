<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); // 案件タイトル
            $table->integer('category_id')->index(); // 単発ORレベニューシア
            $table->longText('detail'); // 詳細
            $table->integer('user_id')->index(); // 投稿者ID
            $table->integer('active')->default(0); // デフォルト値は0。締め切りの場合は1
            $table->integer('lowPrice')->nullable(); // 単発案件の最小価格
            $table->integer('highPrice')->nullable(); // 単発案件の最大価格
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
        Schema::dropIfExists('items');
    }
}
