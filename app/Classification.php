<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $guarded=array('id');
    public $timestamps = false;

    public function article(){
        //相手テーブルに、自分テーブル.idへの外部キーがある。
        return $this->hasMany('App\Article');
    }
}
