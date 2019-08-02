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
        // dd($json);
        $items = Item::with('user.photo','category')->orderBy('created_at','DESC')->get();
        $jsons = json_encode($items);
        // $array = json_decode( $jsons , true ) ;
        // $jsons = json_encode($array['data']);
        // $items = Item::with('user.photo','category')->orderBy('created_at','DESC')->get();
        // dd($item2,$items);
        // dd($items);
        // dd($items);
        // dd($items);
        // dd($json2);
        return view('index',compact('categories','items','jsons'));
    }
}
