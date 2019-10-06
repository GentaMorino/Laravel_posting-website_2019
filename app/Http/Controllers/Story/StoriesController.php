<?php

namespace App\Http\Controllers\Story;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//トランザクション用
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
//auth　id 取得用
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Article;
use App\DetailArticle;
use App\Tab;
use App\Classification;
use App\Structure;
use Carbon\Carbon;
use App\User;

//画像削除用
use Illuminate\Support\Facades\Storage;

class StoriesController extends Controller
{
    public function index(Request $request){
        if(isset($request['keyword'])){//keyword検索
            $keyword=$request['keyword'];
            //simplePaginate();は常に１番最後
            $stories=Article::whereHas('DetailArticle',function($q) use($keyword){
                $q->where('content','like','%'.$keyword.'%');
            })->orWhere('tag1','like','%'.$keyword.'%')
            ->orWhere('tag2','like','%'.$keyword.'%')
            ->orWhere('tag3','like','%'.$keyword.'%')
            ->orWhere('tag4','like','%'.$keyword.'%')
            ->orWhere('tag5','like','%'.$keyword.'%')
            ->orderBy('updated_at','desc')->paginate(8);
        }else if(isset($request['tag'])){//tag検索
            $keyword=$request['tag'];
            $stories=Article::Where('tag1','like','%'.$keyword.'%')
                ->orWhere('tag2','like','%'.$keyword.'%')
                ->orWhere('tag3','like','%'.$keyword.'%')
                ->orWhere('tag4','like','%'.$keyword.'%')
                ->orWhere('tag5','like','%'.$keyword.'%')
                ->orderBy('updated_at','desc')->paginate(8); 
        }else if(isset($request['classification'])){
            $keyword=$request['classification'];
            
            $stories=Article::whereHas('Classification',function($q) use($keyword){
                $q->where('classification',$keyword);
            })->orderBy('updated_at','desc')->paginate(8);;
            
        }else{//通常検索なし
            $stories=Article::orderBy('updated_at','desc')->paginate(8);
  
        }

        //viewへ
        if(isset($keyword)){
            
            $page=array(
                'keyword'=>$keyword
            );
            if(isset($request['tag'])){//タグ検索時
                return view('/story.index')->with([
                    'stories'=>$stories,
                    'keyword'=>'#'.$keyword,
                    'page'=>$page,
                ]);
            }else{//タグ以外の検索
                
                return view('/story.index')->with([
                    'stories'=>$stories,
                    'keyword'=>$keyword,
                    'page'=>$page,
                ]);

            }
        }else{//デフォルト、検索してない
            return view('/story.index')->with([
                'stories'=>$stories
            ]);
        }
    }


    public function manage(){//記事管理
        $id = Auth::id();
        $stories=Article::where('user_id',$id)->orderBy('updated_at','desc')->paginate(6);
        $tabs=Tab::where('user_id',$id)->get();

        return view('/story.manage')->with([
            'stories'=>$stories,
            'tabs'=>$tabs
        ]);
    }

    public function tab(Request $request){//Tab追加用
        $this->validate($request, Tab::$rules);
        $id = Auth::id();
        $form=$request->all();
        if(!isset($form['tab'])){
            return redirect('/story/manage')->with('message', '値がありません');
        }

        $count=Tab::where('user_id',$id)->count();
        if($count>=4){
            return redirect('/story/manage')->with('message', 'タブは４つまです');
        }


        $tab=new Tab();
        $tab->user_id=$id;
        $tab->tab=$form['tab'];
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
            $validator= Validator::make($article->toArray(),Article::$rules)->validate();
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
               
                foreach($val as $structure =>$content){
                    //dd($structure);>"paragraph"
                    //dd($content);>"タイトルです"
                
                    $detail_article=new DetailArticle;    
                    $detail_article->article_id = $article_id;
                    $detail_article->structure_id =$structure;
                    $detail_article->content=$content;
                    $detail_article->number=$key;

                    $validator= Validator::make($detail_article->toArray(),DetailArticle::$rules)->validate();
                    $detail_article->save();
                }
            }
        });

        return redirect('/story/manage');
    }

    public function edit(Request $request){
        
        $articles=Article::find($request['id']);
        $classifications=Classification::orderBy('id','asc')->get();
        $tabs=Tab::where('user_id',Auth::id())->get();
        
        /*dd($articles->detailArticle);
        Collection {#510 ▼
            #items: array:4 [▶]
        }
        */
        return view('/story.edit')->with([
            'articles'=>$articles,
            'classifications'=>$classifications,
            'tabs'=>$tabs
        ]);
    }//編集

    //編集
    public function update(Request $request){
        $transaction=DB::transaction(function () use ($request) {
            //$  validate
            $article_id=$request->id;
            $article=Article::find($article_id);
            $user_id = Auth::id();
            $form=$request->all();
           
            unset($form['__token']);

            $article->user_id=$user_id;
            //$article->thumbnail=
            $article->classification_id=$form['classification'];
            if(isset($form['tab_id'])){
                $article->tab_id=$form['tab_id'];
            }
            
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

            if(isset($form['thumbnail'])) {
                //画像削除
                $delete=str_replace('storage/thumbnail/','',$article->thumbnail);
              
                //str_replace( $検索文字列 , $置換後文字列 , $検索対象文字列 [, int $count ] )
                Storage::delete('public/thumbnail/'.$delete);
                
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
           
            $validator= Validator::make($article->toArray(),Article::$rules)->validate();
       
            /*この書き方だとトランザクション強制終了なので注意！
            if($validator->fails()){
                //return redirect()->back()->withErrors($validator)->withInput();
            }
            */
            $article->save();
            //ここから内容
            DetailArticle::where('article_id',$article_id)->delete();


            $detail_articles = $form['stories'];
                 
            /*  dd($request);
                array:5 [▼
                    0 => array:1 [▼
                        　使用している文字のid=>内容
                        "paragraph" => "タイトルです"
                    ]
                    1 => array:1 [▶]
                    2 => array:1 [▶]
                    3 => array:1 [▶]
                    4 => array:1 [▶]
                ]
             */
            foreach ($detail_articles as $key => $val){
                
                //dd($key);>０
                //dd($val);>array:1 [▼"paragraph" => "タイトルです"]
               
                foreach($val as $structure =>$content){
                    //dd($structure);>"paragraph"
                    //dd($content);>"タイトルです"
               
                    $detail_article=new DetailArticle;    
                    $detail_article->article_id = $article_id;
                    $detail_article->structure_id =$structure;
                    $detail_article->content=$content;
                    $detail_article->number=$key;

                    $validator= Validator::make($detail_article->toArray(),DetailArticle::$rules)->validate();
   
                    $detail_article->save();
                }
                
            }
              
            return 'success';
            
        });
        if($transaction == 'success'){
            return redirect('/story/manage');
        }else{
            return $transaction;
        }
    
    }//編集
    

    public function detail(Request $request){
        $detail_story=Article::where('id',$request->id)->whereHas('DetailArticle',function($q){
            $q->orderBy('number','asc');
        })->first();
        if(empty($detail_story)){
            return redirect('/');
        }
        //\Debugbar::info($detail_story);
        //\Debugbar::info($detail_story->detailarticles);
        return view('/story.detail',['detail_story'=>$detail_story]);
    }

    public function delete(Request $request){
        $article=Article::find($request->id)->delete();
        return redirect('/story/manage');
    }

    public function personal(Request $request){
        $user_id=$request['id'];
       
        $recommendeds=Article::where('user_id',$user_id)->where('recommended',true)->orderBy('updated_at','desc')->get();
       
        $tabs=Tab::where('user_id',$user_id)->get();
        $user=User::find($user_id);

        //ページネーション 条件引き継ぎ


        if(isset($request['tab-id'])){
            $tab_id=$request['tab-id'];
            $articles=Article::where('user_id',$user_id)->where('tab_id',$tab_id)->orderBy('updated_at','desc')->paginate(8);
            $page=array(
                'id'=>$user_id,
                'tab-id'=>$tab_id,
            );
        }else{
            $articles=Article::where('user_id',$user_id)->orderBy('updated_at','desc')->paginate(8);
            $page=array(
                'id'=>$user_id
            );
        }

        return view('/story/personal')->with([
            'articles'=>$articles,
            'user'=>$user,
            'recommendeds'=>$recommendeds,
            'page'=>$page,
            'tabs'=>$tabs
        ]);
    }
}
