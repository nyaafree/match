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
        // 自分で投稿した案件には応募できないようにする
        if(Item::find($id)->user_id == Auth::user()->id){
            return redirect('/items/'.$id)->with('flash_message', '自分で投稿した案件には応募できません');
        }
        $applies = Item::find($id)->applies;
        foreach ($applies as $value) {
            // ログインユーザーがすでにこの案件に応募してる場合には、応募できないようにする
            if($value->user_id == Auth::user()->id){
                return redirect('/items/'.$id)->with('flash_message', 'この案件にはすでに応募してあります');
            }
        }
        $item = Item::findOrFail($id);
        $input2['applicant_id'] = Auth::user()->id; // 案件申し込みした人のユーザーID
        $input2['proposer_id'] = $item->user_id; // 案件登録者のユーザーID
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
        $messages = $board->messages()->with(['user.photo','category'])->get(); // VueでLaravelのリレーションを使えるように設定。
        $applicant_id = $board->applicant_id;
        $item = $board->item;
        $user = Auth::user();
        $apply = $board->apply;
        // dd($apply);
        // dd($item->user_id);
        // dd($apply->user_id);
        if($item->user_id != $user->id && $applicant_id != $user->id){
            // ダイレクトメッセージをやり取りする掲示板にアクセスできるのは案件投稿者もしくは案件申し込み者のみで、違う場合には案件詳細ページにリダイレクト
            return redirect('/items/'.$item->id)->with('flash_message','案件投稿者もしくは案件申し込み者しかこの掲示板にアクセスできません。');
        }
        if($board->proposer_id == $user->id){
            // 案件投稿者がダイレクトメッセージをやり取りする掲示板にアクセスしたらappliesテーブルのreadカラムをfalse(デフォルト設定)からtrueに変更する
            // appliesテーブルのreadカラムがfalseの場合はheaderのベルマークのアイコンに案件申し込みの未読通知を表示して、trueになったら未読通知から消えるようにする
            $input['read'] = true;
            $apply->update($input);
        }
        return view('directMessage',compact('item','board','messages','user'));
    }
}
