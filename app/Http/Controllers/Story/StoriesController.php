<?php

namespace App\Http\Controllers\Story;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoriesController extends Controller
{
    public function index(){
        return redirect('/');
    }
}
