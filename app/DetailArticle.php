<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailArticle extends Model
{
    protected $guarded=array('id');
    public $timestamps = false;


    public static $rules=array(  
        //追加
        'article_id' => 'required',
        'structure_id' => 'required',
        'content' => 'required|max:500',
        'number'=>'required',
    );

    public function article(){
        //belongsTo 自分のテーブルに、相手テーブル.idの外部キーがある。
        return $this->belongsTo('App\Article');
    }

    public function structures(){
        //belongsTo 自分のテーブルに、相手テーブル.idの外部キーがある。
        return $this->belongsTo('App\Structure');
    }
}
