<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//追加
use App\User;
use App\DetailUser;
use App\Http\Controllers\Auth\RegisterController;
//auth用Auth::id();などで使用
use Illuminate\Support\Facades\Auth;
//pasowrd hash化
use Illuminate\Support\Facades\Hash;
//画像削除用
use Illuminate\Support\Facades\Storage;
use App\Register;
//時間用
use Carbon\Carbon;
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
        
        $id = Auth::id();
        $myInfo=User::find($id);
        if (empty($myInfo)) {
          abort(404);    
        }
        return view('user.edit', ['myInfo' => $myInfo]);
    }

    public function update(Request $request){
        /*
        $register=new RegisterController;
        $validator=$register->pubvalidator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        */
      
        $this->validate($request, DetailUser::$rules);
        //ユーザ情報
        $myInfo= Auth::user();
        //フォームから送られてきた情報
        $myInfo_form=$request->all();
        //passowrd hash化
        $myInfo_form['password']=Hash::make($request->password);

        
        //--------画像処理--------

        //画像があれば保存
        if (isset($myInfo_form['img'])) {

            //画像削除
            $delete=str_replace('storage/img/','',$myInfo->img);
            Storage::delete('public/img/'.$delete);

            //現在時刻
            $now=Carbon::now();
            $fileName=$now.'_'.Auth::user()->id . '.jpg';

            //画像の保存先は「storage/app/public/img」というディレクトリに格納されます
            $save_path=$request->img->storeAs('public/img',$fileName);
            //画像を読み込むときのパスはstorage/img/xxx.jpeg"
            $myInfo_form['img'] =str_replace('public/','storage/',$save_path);

            //保存:storage/app/public
            //読込:public/storage
         } elseif (isset($request->remove)) {
            $myInfo->img= null;
            unset($myInfo_form['remove']);
         }
 
        
        //非表示フィールド削除
        unset($myInfo_form['__token']);
        $myInfo->fill($myInfo_form)->save();
        return redirect('user/index');
    }
    
    public function delete(Request $request){
        $id = Auth::id();
        User::find($id)->delete();
       
        return redirect('/');
    }

    public function getAuth(Request $request){
        $param=['message'=>'ログインしてください'];
        return view('hello.auth',$param);
    }
    public function postAuth(Request $request){
        $email=$request->email;
        $password=$request->passowrd;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $msg="ログインしました";
        }else{
            $msg="メールアドレスかパスワードが違います";
        }
        return view('/',['message'=>$msg]);
    }

}
