<?php

namespace App\Http\Controllers;

use App\Item;
use App\Apply;
use App\Board;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id){
        if(Item::find($id)->user_id == Auth::user()->id){
            return redirect('/items/'.$id)->with('flash_message', '自分で投稿した案件には応募できません');
        }
        $applies = Item::find($id)->applies;
        foreach ($applies as $value) {
            if($value->user_id == Auth::user()->id){
                return redirect('/items/'.$id)->with('flash_message', 'この案件にはすでに応募してあります');
            }
        }
        $item = Item::findOrFail($id);
        $input2['applicant_id'] = Auth::user()->id;
        $input2['proposer_id'] = $item->user_id;
        $input2['item_id'] = $item->id;
        $board = Board::create($input2);
        // dd($board);

       $input['user_id'] = Auth::user()->id;
       $input['item_id'] = $id;
       $input['board_id'] = $board->id;
       $input['proposer_id'] = $item->user_id;
       $apply = Apply::create($input);

    //    dd($board->apply_id);


       $input3['apply_id'] = $apply->id;
       $board->update($input3);

       return redirect()->route('board',[$board])->with('flash_message','応募完了しました！');
    }

    public function show($id){
        // $messages = Message::all();
        $board = Board::findOrfail($id);
        $messages = $board->messages()->with(['user.photo','category'])->get();
        $applicant_id = $board->applicant_id;
        $item = $board->item;
        $user = Auth::user();
        $apply = $board->apply;
        // dd($apply);
        // dd($item->user_id);
        // dd($apply->user_id);
        if($item->user_id != $user->id && $applicant_id != $user->id){
            return redirect('/');
        }
        if($board->proposer_id == $user->id){
            $input['read'] = true;
            $apply->update($input);
        }
        return view('directMessage',compact('item','board','messages','user'));
    }
}
