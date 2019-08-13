<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\EditProfileRequest;

class profileController extends Controller
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
        //
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
        $user = User::findOrFail($id);
        return(view('profile',compact('user')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        if($file = $request->file('file')){
            // 画像ファイル名を設定
            $name = time().$file->getClientOriginalName();
            // 画像ファイルをimages/profile 配下に移動
            $file->move('images/profile', $name);
            // Photoモデルを使ってphotosテーブルにファイル名のデータを追加
            $image = Photo::create(['filename' => $name]);
            // UserモデルとPhotoモデルを紐づけられるようにusersテーブルにphoto_idを登録
            $input['photo_id'] = $image->id;
        }
        $user->update($input);
        Session::flash('flash_message', 'プロフィール編集が完了しました。');
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
        //
    }
}
