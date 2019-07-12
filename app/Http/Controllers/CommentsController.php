<?php

namespace App\Http\Controllers;

use App\Item;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        return Comment::all();
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

    public function comment(Request $request){

        $input['item_id'] = $request->input(['id']);
        // $input['item_id'] = 4;
        $input['comment'] = $request->input(['comment']);
        // $input['user_id'] = Auth::user()->id;
        $user = Auth::user();
        dd($user);
        $input['user_id'] = $user->id;
        Comment::create($input);
        $item = Item::find($input['item_id']);
        $comments = $item->comments()->with(['user.photo','category'])->get();

        return $comments;


    }

    // $input = $request->all();
        // $input['user_id'] = Auth::user()->id;
        // $input['item_id'] = $id;
        // $comment = Comment::create($input);
        // Session::flash('flash_message','コメント投稿が完了しました！');
        // return redirect()->route('items.show',['id' => $id]);

    // $categories = Category::all();
    // $categories = json_encode($categories);
    // $id = $request->input(['id']);
    // if($id == 0){
    //     // $items = Item::with(['user.photo', 'category'])->find(1);
    //     $items = Item::with(['user.photo', 'category'])->get();
    //     $items = json_encode($items);
    // }else{
    //     $category = Category::find($id);
    //     $items = $category->items()->with(['user.photo','category'])->get();
    //     $items = json_encode($items);
    // }
    // return $items;
}
