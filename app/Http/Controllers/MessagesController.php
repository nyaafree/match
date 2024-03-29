<?php

namespace App\Http\Controllers;

use App\Board;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddMessageRequest;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function message(AddMessageRequest $request, $id){
        // ダイレクトメッセージをやり取りする掲示板を取得
        $board = Board::findorFail($id);
        $input['message'] = $request->message;
        // メッセージ送信者のユーザーIDを登録
        $input['user_id'] = Auth::user()->id;
        // ダイレクトメッセージがやり取りされている掲示板のIDを登録
        $input['board_id'] = $id;
        Message::Create($input);
        // メッセージを送信した後はメッセージをやり取りしてる掲示板にリダイレクトする
        return redirect()->route('board',[$board]);

    }
}
