<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => '不動産アプリ',
        'category_id' => 1,
        'detail' => '不動産業を営む会社です。
        お客様と弊社間のやりとりをオンラインチャット内でやりとり可能なアプリの開発を依頼したいと考えております。
        ・弊社スタッフ複数人が同時にアクセス可能にする(ラインの場合は一台ログインするとアクセス不可)
        極力価格を抑えたいので単純にチャットルーム形式で会話のできる仕様のみでオッケーです。',
        'user_id' => 10,
        'lowPrice' => 50000,
        'highPrice' => 100000
        
        
        
    ];
});
