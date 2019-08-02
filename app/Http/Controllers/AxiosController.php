<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Comment;
use App\Message;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AxiosController extends Controller
{
    public function category(Request $request){
        $categories = Category::all();
        $categories = json_encode($categories);
        $id = $request->input(['id']);
        if($id == 0){
            // $items = Item::with(['user.photo', 'category'])->find(1);
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
    public function delete($id){
        return Item::destroy($id);
    }

    public function index(){


    }
    public function comment(Request $request, $id){
        Comment::findOrFail($id)->update(['comment' => $request->input(['rcomment'])]);
    }
    public function fetch(Request $request, $id){
       return Comment::findOrFail($id);

    }
    public function destroy($id){
        return Comment::destroy($id);

    }
    public function all(Request $request, $id){
        $user = User::find($id);
        return $user->comments()->with(['item'])->get();

    }
    public function message(Request $request, $id){
        Message::findOrFail($id)->update(['message' => $request->input(['rmessage'])]);
    }
    public function messageUpdate(Request $request, $id){
        return Message::findOrFail($id);
    }
    public function messageDelete($id){
        return Message::destroy($id);
    }
    public function allMessages(Request $request, $id){
        // $user = User::find($id);
        // return $user->messages()->with(['board.item'])->get();
        return Message::findOrFail($id);
    }

}
