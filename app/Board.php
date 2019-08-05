<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
        'applicant_id','proposer_id','item_id','apply_id'
    ];

    public function item(){
        return $this->belongsTo('App\Item');
    }

    public function apply(){
        return $this->belongsTo('App\Apply');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }
}
