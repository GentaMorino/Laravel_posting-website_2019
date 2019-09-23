<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tab extends Model
{
    protected $guarded=array('id');
    //Eloquentのtimestampは便利だけど、使わない場合は無効にしておかないと「updated_at」がありませんと怒られる。
    //無効にするには$timestampsをfalseにする
    public $timestamps = false;

    public static $rules=array(
        //'img'=> 'file|image|mimes:jpeg,png,jpg,gif|max:3000',//3Mバイトまで

        //'name' => 'required|string|max:255',
        //'email' => 'required|string|email|max:255',
        //'password' => 'required|string|min:8|confirmed',
    );

    public function articles(){
        //相手テーブルに、自分テーブル.idへの外部キーがある。
        return $this->hasMany('App\Article'); 
    }
    public function user(){
        //belongsTo :自分のテーブルに、相手テーブル.idの外部キーがある
        return $this->belongsTo('App\User');
    }

 
    
}
