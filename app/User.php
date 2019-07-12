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
