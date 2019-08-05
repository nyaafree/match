<?php

namespace App\Providers;

use App\Apply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ログインしている場合には'loginUser'にログインユーザーのデータを、'applyNumbers'にログインユーザーが未読の案件応募掲示板の数を格納して
        // 全てのviewファイルで使えるようにしておく
        view()->composer('*', function($view){
            if(Auth::check()){
                $view->with('loginUser', Auth::user());
                $view->with('applyNumbers', Apply::where('proposer_id',Auth::user()->id)->where('read',0)->get());
            }
          });

    }
}
