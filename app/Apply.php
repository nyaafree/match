<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $fillable = [
        'item_id','user_id','board_id','read','proposer_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function item(){
        return $this->belongsTo('App\Item');
    }

    public function board(){
        return $this->hasOne('App\Board');
    }
}


