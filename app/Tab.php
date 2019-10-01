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
        //'user_id' => 'required',
        'tab' => 'required|max:10',
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
