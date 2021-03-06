<?php

namespace App\Http\Controllers;

use App\Item;
use App\Apply;
use App\Board;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddItemRequest;
use App\Http\Requests\EditItemRequest;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      $categories = Category::all();
      return(view('itemForm',compact('user','categories')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddItemRequest $request)
    {
       $input = $request->all();
       if($input['category_id'] == 1){
        // 単発案件を登録した場合は最小価格と最大価格と登録できるようにする
        // また1000円単位で価格を設定できるように入力フォームの方では千の位から入力するようにしているので
        // 入力した値を1000倍してからDBに登録する
        $input['lowPrice'] = $request->lowPrice.'000';
        $input['highPrice'] = $request->highPrice.'000';
       }else{
        // レベニューシア案件を登録した場合は最小価格、最大価格ともにnullとして登録
        $input['lowPrice'] = null;
        $input['highPrice'] = null;
       }
       $input['user_id'] = Auth::user()->id; // 案件投稿者のユーザーIDを設定
       $item = Item::create($input);
       Session::flash('flash_message','案件投稿が完了しました！');
       return redirect('mypage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $item = Item::find($id);
        // 案件詳細ページにつけられているコメントをすべて取得(LaravelのリレーションをVueでも使えるように設定)
        $comments = $item->comments()->with(['user.photo','category'])->get();
        // appliesテーブルから該当するする案件への応募レコードを検索して、それからログインユーザーが案件に応募してる場合はそのレコードのみを取得
        $applyOrNot = DB::table('applies')->where('item_id',$id)->where('user_id',$user->id)->get();
        // dd($applyOrNot);
        return(view('panelContent',compact('item','user','comments','applyOrNot')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Auth::user();
      $categories = Category::all();
      $item = Item::findOrFail($id);
      return(view('itemEditForm',compact('user','categories','item')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $input = $request->all();
        if($input['category_id'] == 1){
            // 単発案件を登録した場合は最小価格と最大価格と登録できるようにする
            // また1000円単位で価格を設定できるように入力フォームの方では千の位から入力するようにしているので
            // 入力した値を1000倍してからDBに登録する
            $input['lowPrice'] = $request->lowPrice.'000';
            $input['highPrice'] = $request->highPrice.'000';
        }else{
            // レベニューシア案件を登録した場合は最小価格、最大価格ともにnullとして登録
            $input['lowPrice'] = null;
            $input['highPrice'] = null;
        }
        $input['user_id'] = Auth::user()->id;

        $item->update($input);
        Session::flash('flash_message','案件編集が完了しました');

        return redirect('/mypage');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // 案件への申し込み情報を削除
        Apply::where('item_id', $id)->delete();
        // 案件申し込み後にやり取りされたダイレクトメッセージを削除
        $boards = Item::find($id)->boards;
        // dd($boards);
        foreach ($boards as $board) {
            $board->messages()->delete();
        }
        // 案件申し込み後のダイレクトメッセージをやり取りする掲示板の情報を削除
        Board::where('item_id', $id)->delete();
        // 案件詳細画面につけられたコメント情報を削除
        Comment::where('item_id', $id)->delete();
         // 案件情報を削除
         Item::destroy($id);
        Session::flash('flash_message', '案件削除完了しました');
        return redirect('/mypage');

    }


}
