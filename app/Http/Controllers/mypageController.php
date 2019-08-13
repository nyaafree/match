<?php

namespace App\Http\Controllers;

use App\User;
use App\Apply;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class mypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        // ログインユーザーが投稿した案件データすべてを取得
        $myItems = $user->items()->with(['user.photo','category','boards.apply.user'])->get();
        // ログインユーザーが応募した案件データすべてを取得
        $applyItems = $user->boards()->with(['item.user.photo','item.category'])->get();
        // ログインユーザーが案件詳細画面で投稿したコメントすべてそ取得
        $myComments = $user->comments()->with(['item.comments'])->get();
        // ログインユーザーが案件申し込み後の掲示板でやり取りしたダイレクトメッセージすべてを取得
        $myMessages = $user->messages()->with(['board.item'])->get();
        return(view('mypage.index',compact('user','categories','myItems','applyItems','myComments','myMessages')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function quit(){
    //     $user = User::findOrFail(Auth::user()->id);
    //     // ログインユーザーが持っているコメントデータ全てを消去
    //     $user->comments()->destroy();
    //     // ログインユーザーが持っているダイレクトメッセージデータ全てを消去
    //     $user->messages()->destroy();
    //     // ログインユーザーの案件申し込み情報を全て削除
    //     $user->applies()->destroy();
    //     // ログインユーザーの案件に申し込みがあった際のダイレクトメッセージをやり取りする掲示板情報を全て削除
    //     $user->boards()->destroy();
    //     // ログインユーザーの案件情報を全て削除
    //     $user->items()->destroy();
    //     // ログインユーザーのユーザー情報を全て削除
    //     $user->destroy();
    //     Session::flash('flash_message', '退会処理が完了しました');
    //     return redirect('/');
    // }
}
