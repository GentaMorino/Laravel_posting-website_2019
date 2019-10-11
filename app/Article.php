<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //$guardedは値を用意しておかない項目
    protected $guarded=array('id');
    
    public static $rules=array(
        'user_id'=> 'required',
        'classification_id'=>'required',
        'tab_id'=>'nullable|numeric',
        'tag1' =>'nullable|max:15',
        'tag2' =>'nullable|max:15',
        'tag3' =>'nullable|max:15',
        'tag4' =>'nullable|max:15',
        'tag5' =>'nullable|max:15',
        'thumbnail'=> 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:3000',
        
    );

    //sつけたら値取れずsつけないように
    public function detailArticle(){
        //相手テーブルに、自分テーブル.idへの外部キーがある。
        return $this->hasMany('App\DetailArticle');
      
    }

    public function classification(){
        //belongsTo :自分のテーブルに、相手テーブル.idの外部キーがある
        return $this->belongsTo('App\Classification');
    }

    public function tab(){
        //belongsTo :自分のテーブルに、相手テーブル.idの外部キーがある
        return $this->belongsTo('App\Tab');
    }

    public function user(){
        //belongsTo :自分のテーブルに、相手テーブル.idの外部キーがある
        return $this->belongsTo('App\User');
    }


}
