<?php

namespace App\Http\Controllers\Story;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//トランザクション用
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
//auth　id 取得用
use Illuminate\Support\Facades\Auth;

use App\Article;
use App\DetailArticle;
use App\Tab;
use App\Classification;
use App\Structure;
use Carbon\Carbon;


class StoriesController extends Controller
{
    public function index(Request $request){
        //simplePaginate();は常に１番最後
        
        $stories=Article::orderBy('updated_at','desc')->paginate(8);
        //return redirect('/');
        return view('/story.index')->with([
            'stories'=>$stories
        ]);
    }


    public function manage(){//記事管理
        $id = Auth::id();
        $stories=Article::where('user_id',$id)->paginate(6);
        $tabs=Tab::where('user_id',$id)->get();

        return view('/story.manage')->with([
            'stories'=>$stories,
            'tabs'=>$tabs
        ]);
    }

    public function tab(Request $request){//Tab追加用
        $id = Auth::id();
        $count=Tab::where('user_id',$id)->count();
        if($count>=4){
            return redirect('/story/manage')->with('message', 'タブは４つまです');
        }

        $tab=new Tab();
        $form=$request->all();
  
        $tab->user_id=$id;
        $tab->tab=$request['tab'];
        $tab->save();
        return redirect('/story/manage');
    }
    public function deleteTab(Request $request){//Tab削除用
        $tab=Tab::find($request->id)->delete();
        return redirect('/story/manage');
    }

    public function add(Request $request){//記事追加
        $classifications=Classification::orderBy('id','asc')->get();
        $id = Auth::id();
        $tabs=Tab::where('user_id',$id)->get();
        return view('/story.add')->with([
            'classifications'=>$classifications,
            'tabs'=>$tabs
        ]);
    }
    public function create(Request $request){//記事追加
       
       
        
        DB::transaction(function () use ($request) {
            $form=$request->all();

            $article = new Article();
            $id = Auth::id();
            $article->user_id = $id;
            $article->classification_id=$form['classification'];
            $article->tab_id=$form['tab'];//idなので注意
            $article->tag1=$form['tag1'];
            $article->tag2=$form['tag2'];
            $article->tag3=$form['tag3'];
            $article->tag4=$form['tag4'];
            $article->tag5=$form['tag5'];
            if(isset($form['recommended'])){
                $article->recommended=true;
            }else{
                $article->recommended=false;
            }
            
            


            //画像
           
            if(isset($form['thumbnail'])) {
                $thumbnail=$form['thumbnail'];
                //現在時刻
                $now=Carbon::now();
                $fileName=$now.'_'.Auth::user()->id.'.jpg';
    
                //画像の保存先は「storage/app/public/thumbnail」というディレクトリに格納されます
                $save_path=$request->thumbnail->storeAs('public/thumbnail',$fileName);
          
                //画像を読み込むときのパスはstorage/img/xxx.jpeg"
                $form['thumbnail'] =str_replace('public/','storage/',$save_path);
              
                $article->thumbnail=$form['thumbnail'];
                //保存:storage/app/public
                //読込:public/storage
             }
            //-----　　画像  -----  //
         
            $article->save();
            
            $article_id=$article->id;
            $request = $request['stories'];
         
            /*  dd($request);
                array:5 [▼
                    0 => array:1 [▼
                        "paragraph" => "タイトルです"
                    ]
                    1 => array:1 [▶]
                    2 => array:1 [▶]
                    3 => array:1 [▶]
                    4 => array:1 [▶]
                ]
             */
            foreach ($request as $key => $val){
                
                //dd($key);>０
                //dd($val);>array:1 [▼"paragraph" => "タイトルです"]
               
                foreach($val as $structure =>$content)
                //dd($structure);>"paragraph"
                //dd($content);>"タイトルです"
               
                $detail_article=new DetailArticle;    
                $detail_article->article_id = $article_id;
               
                $detail_article->structure_id =$structure;

                $detail_article->content=$content;
                $detail_article->number=$key;

               

                $detail_article->save();
              }
        });

        return redirect('/story/manage');
    }
    

    public function detail(Request $request){
        $detail_story=Article::where('id',$request->id)->first();
        if(empty($detail_story)){
            return redirect('/');
        }
        \Debugbar::info($detail_story);
        \Debugbar::info($detail_story->detailarticles);
       
   
        return view('/story.detail',['detail_story'=>$detail_story]);
    }

    public function delete(Request $request){
        $article=Article::find($request->id)->delete();
        return redirect('/story/manage');
    }
}
