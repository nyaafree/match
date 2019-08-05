<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message','user_id','board_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function board(){
        return $this->belongsTo(('App\Board'));
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

}
