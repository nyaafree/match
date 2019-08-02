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

    public function boards(){
        return $this->hasMany('App\Board');
    }

    public function applies(){
        return $this->hasMany('App\Apply');
    }
    // public function latestComments(){
    //     return $this->hasMany('App\Comment')->orderBy('created_at','DESC')->take(1)->get();
    // }

    // public function applyBoard(){
    //     return $this->hasManyThrough('App\Board','App\Apply','item_id','apply_id','id','id');
    // }

}
