<?php

namespace App\Http\Controllers;

use App\Item;
use App\Apply;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddItemRequest;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
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
        $input['lowPrice'] = $request->lowPrice.'000';
        $input['highPrice'] = $request->highPrice.'000';
       }else{
        $input['lowPrice'] = null;
        $input['highPrice'] = null;
       }
       $input['user_id'] = Auth::user()->id;
       $item = Item::create($input);
       Session::flash('flash_message','案件投稿が完了しました！');
       return redirect('/mypage');
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
        $comments = $item->comments()->with(['user.photo','category'])->get();
        // $applicantComments = '';
        // $proposerComments = '';
        // foreach ($comments as $key => $value) {
        //     if($value->user_id != $item->user_id){
        //         $applicantComments = $value;
        //     }else{
        //         $proposerComments = $value;
        //     }
        // }
        // $applicantComments = json_encode($applicantComments);
        // $proposerComments = json_encode($proposerComments);
        // dd($applicantComments,$proposerComments);
        // $comments = json_encode($comments);
        // dd(json_encode($comments));
        return(view('panelContent',compact('item','user','comments')));
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

    public function list(){
        $items = Item::with('user.photo','category')->get();
        return $items;
    }


}
