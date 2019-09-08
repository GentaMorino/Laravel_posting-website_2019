<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//追加
use App\User;
use App\DetailUser;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // 現在ログインしているユーザーの取得
        $user = Auth::user();
        // 現在ログインしているユーザーのID取得
        //$id = Auth::id();
        //$myInfo=User::where('id',$id)->first();
        //$myInfo=User::find($id);
        
 
        \Debugbar::info($user);
        return view('user.index', ['myInfo' => $user]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();

        $myInfo=User::find($id);
        if (empty($myInfo)) {
          abort(404);    
        }
        return view('user.edit', ['myInfo' => $myInfo]);
    }

    public function update(Request $request){
        $this->validate($request, User::$rules);

        $myInfo=User::find($request->id);

        $myInfo_form=$request->all();
        
        //画像があれば保存
        if (isset($myInfo_form['img'])) {
           
            $path = $request->file('img')->store('public/image');
            //$pathの中身はファイルのパスも含まれていますので,basenameメソッドを使ってファイル名のみ保存します。
            $myInfo->img = basename($path);
            unset($myInfo_form['img']);
         } elseif (isset($request->remove)) {
            $myInfo->img= null;
            unset($myInfo_form['remove']);
         }
        
        unset($myInfo_form['__token']);
        //d($myInfo_form);
        $myInfo->fill($myInfo_form)->save();
        
        //$now=Carbon::now();
        
        return redirect('user.edit');
    }
    
    public function delete(Request $request){
        $news=News::delete($request->id);
        $news->delete();
        return redirect('admin/news/');
    }

}
