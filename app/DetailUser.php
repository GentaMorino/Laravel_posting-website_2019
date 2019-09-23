<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//追加
use App\User;

class DetailUser extends Model
{
    protected $guarded=array('id');
//Eloquentのtimestampは便利だけど、使わない場合は無効にしておかないと「updated_at」がありませんと怒られる。
//無効にするには$timestampsをfalseにする
    public $timestamps = false;

    public static $rules=array(
        'img'=> 'file|image|mimes:jpeg,png,jpg,gif|max:3000',//3Mバイトまで

        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|confirmed',
    );
//$fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    protected $fillable = [
        'user_id', 'introduction', 'img',
    ];

    //関連づけ
    /*
    public function user(){
        //belongsTo :自分のテーブルに、相手テーブル.idの外部キーがある
        return $this->belongsTo('App\User');
        //user_id detailユーザテーブルに定義して
    }
    */
}
