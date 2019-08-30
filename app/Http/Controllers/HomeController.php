<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function __construct()
    // {
    //     View::share('allItems', Auth::user()->items);
    // }

    public function index()
    {
        $categories = Category::all();
        $categories = json_encode($categories);
        $items = Item::with('user.photo','category','applies')->orderBy('created_at','DESC')->get();
        $jsons = json_encode($items);
        $user = json_encode(Auth::user());

        return view('index',compact('categories','items','jsons','user'));
    }

    public function filter(Request $request){
        // 検索フォームからフリーワードで検索して、案件タイトルまたは案件詳細情報に合致した案件データ一覧を取得
        $categories = Category::all();
        $categories = json_encode($categories);

        $items = Item::
                        where('title','like','%'.$request->input('name').'%')->
                        orWhere('detail','like','%'.$request->input('name').'%')
                        ->with('user.photo','category')->orderBy('created_at','DESC')->get();
        $jsons = json_encode($items);
        return view('index',compact('categories','items','jsons'));
    }
}
