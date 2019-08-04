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

    }
    public function delete($id){
        return Item::destroy($id);
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
        
        return Message::findOrFail($id);
    }

}
