<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

//追加
use App\DetailUser;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction', 'img',
    ];

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

    public static $rules=array(
        'img'=> 'file|image|mimes:jpeg,png,jpg,gif|max:3000',//3Mバイトまで
        //追加
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|confirmed',
        'introduction'=>'max:1000',
    );

    //関連づけ
    /*detailuserは削除、userに追加する。
    理由はedit時にdetailuserが初めて作られるわけだが、
    user情報は作られてるのに、detailuserが作られていないため、何かと都合が悪い
    public function detailuser(){
        //hasOne:hasManyだけど外部キーがUNIQUE。の時hasOne
        //hasMany:相手テーブルに、自分テーブル.idへの外部キーがある。
        return $this->hasOne('App\DetailUser');
    }
    */
    public function tabs(){
        //相手テーブルに、自分テーブル.idへの外部キーがある。
        return $this->hasMany('App\Tab'); 
    }
    //sつけないと値取れない
    public function articles(){
        //相手テーブルに、自分テーブル.idへの外部キーがある。
        return $this->hasMany('App\Article'); 
    }
}
