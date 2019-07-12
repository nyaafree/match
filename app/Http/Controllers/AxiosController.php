<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AxiosController extends Controller
{
    public function category(Request $request){
        $categories = Category::all();
        $categories = json_encode($categories);
        $id = $request->input(['id']);
        if($id == 0){
            $items = Item::with(['user.photo', 'category'])->get();
            $items = json_encode($items);
        }else{
            $category = Category::find($id);
            $items = $category->items()->with(['user.photo','category'])->get();
            $items = json_encode($items);
        }
        return $items;
        // return $category;

    }
}
