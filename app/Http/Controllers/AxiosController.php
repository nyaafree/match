<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Board;
use App\Comment;
use App\Message;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddCommentRequest;

class AxiosController extends Controller
{
    public function category(Request $request){
        // カテゴリIDを取得
        $id = $request->input(['id']);
        if($id == 0){
            // カテゴリIDが0なら全案件データを取得
            // VueでLaravelのリレーションが使えるようにwithを使ってモデル間のリレーションもデータに追加する
            $items = Item::with(['user.photo', 'category'])->orderBy('created_at','DESC')->get();
            // Json形式に変換
            $items = json_encode($items);
        }else{
            // カテゴリIDが1（単発案件）または2（レベニューシア案件）ならそれそれに属するデータのみを取得
            $category = Category::find($id);
            $items = $category->items()->with(['user.photo','category'])->orderBy('created_at','DESC')->get();
            $items = json_encode($items);
        }
        return $items;

    }

    public function storeComment(AddCommentRequest $request){

        $input['item_id'] = $request->input(['id']);
        $input['comment'] = $request->input(['comment']);
        $input['user_id'] = $request->input(['user_id']);
        Comment::create($input);
        $item = Item::find($input['item_id']);
        // 案件申し込みページにつけられたコメントをすべて取得する(VueでLaravelのリレーションを使えるように設定しておく)
        $comments = $item->comments()->with(['user.photo','category'])->get();

        return $comments;


    }

    public function itemComments($id){ // 要改善
        // 案件詳細ページにつけられた全てのコメントデータを取得
        return Item::findOrFail($id)->comments()->with(['user.photo','category'])->get();
    }


    public function editMycomment(Request $request, $id){
        // 自分が投稿した案件詳細ページへのコメント１つ１つを編集
        Comment::findOrFail($id)->update(['comment' => $request->input(['content'])]);
    }

    public function fetchComment(Request $request, $id){
        // ID指定されたコメントデータを取得
       return Comment::findOrFail($id);

    }
    public function deleteComment($id){
        // ID指定されたコメントを削除
        return Comment::destroy($id);

    }
    public function myComments(Request $request, $id){
        // 指定されたユーザーIDを持っているユーザーのコメントデータを全て取得
        $user = User::find($id);
        return $user->comments()->with(['item.comments'])->get();

    }
    public function editMessage(Request $request, $id){
        // 指定されたIDのダイレクトメッセージデータを編集
        Message::findOrFail($id)->update(['message' => $request->input(['content'])]);
    }
    public function messageUpdate(Request $request, $id){
        //  指定されたIDのダイレクトメッセージデータを取得
        return Message::findOrFail($id);
    }
    public function messageDelete($id){
        // 指定されたIDのダイレクトメッセージデータを削除
        return Message::destroy($id);
    }
    public function myMessages(Request $request, $id){
        // 指定されたユーザーIDを持ったユーザーのダイレクトメッセージデータ一覧を取得
        return User::find($id)->messages()->with(['board.item'])->get();

    }
    public function publicItems(Request $request, $id){
        return User::find($id)->commentItems()->groupBy('item_id')->with(['comments'])->get();
    }

}
