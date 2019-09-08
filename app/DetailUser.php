<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//追加
use App\User;

class DetailUser extends Model
{
    protected $guarded=array('id');

    public static $rules=array(
        'user_id'=>'required'
    );

    //関連づけ
    public function detailuser(){
        //belongsTo :自分のテーブルに、相手テーブル.idの外部キーがある
        return $this->belongsTo('App\User');
    }
}
