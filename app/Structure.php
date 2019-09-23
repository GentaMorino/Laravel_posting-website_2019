<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $guarded=array('id');
    public $timestamps = false;

    public function detailArticles(){
        return $this->hasMany('App\DetailArticle');
    }
}
