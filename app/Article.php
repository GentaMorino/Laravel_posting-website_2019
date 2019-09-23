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


}
