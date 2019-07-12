<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title','category_id','detail','user_id','lowPrice','highPrice'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

}
