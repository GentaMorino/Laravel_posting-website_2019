<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailArticle extends Model
{
    protected $guarded=array('id');
    public $timestamps = false;

    public function detailuser(){
        //belongsTo 自分のテーブルに、相手テーブル.idの外部キーがある。
        return $this->belongsTo('App\Article');
    }

    public function structures(){
        //belongsTo 自分のテーブルに、相手テーブル.idの外部キーがある。
        return $this->belongsTo('App\Structure');
    }
}
