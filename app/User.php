<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','photo_id'
    ];

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function applies(){
        return $this->hasMany('App\Apply');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function applyItems(){
        return $this->hasManyThrough('App\Item','App\Apply','user_id','id','id','item_id');
    }
    public function commentItems(){
        return $this->hasManyThrough('App\Item','App\Comment','user_id','id','id','item_id');
    }
    public function messageBoards(){
        return $this->hasManyThrough('App\Board','App\Message','user_id','id','id','board_id');
    }
    public function boards(){
        return $this->hasManyThrough('App\Board','App\Apply');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     //メソッド追加
     public function sendPasswordResetNotification($token)
     {
         $this->notify(new ResetPasswordNotification($token));
     }


}
