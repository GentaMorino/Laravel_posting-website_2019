<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $guarded=array('id');
    public $timestamps = false;

    public static $rules=array(  
        //追加
        'structure' => 'required',
    );

    public function detailArticles(){
        return $this->hasMany('App\DetailArticle');
    }
}
