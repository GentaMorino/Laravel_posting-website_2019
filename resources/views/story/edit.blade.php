@extends('layouts.template')
@section('title','記事編集')
@section('content')
<div class="container"  id="app">
    <h1 class="h3 mt-3 mb-2">記事編集</h1>
    <div class="row pb-4">
        <div class="col-lg-10">
            <form class="mt-3" method="POST" action="/story/edit" enctype="multipart/form-data" id="form">
                {{csrf_field()}} 
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="hidden" name="id" value={{$articles->id}}>

                <div class="mb-2 container-fluid">
                    <input type="submit" class="btn btn-primary" value="更新">
                </div>

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">Title</label>      
                    <div class="col-lg-8">
                        {{-- validation エラー--}}
                        @if($errors->has('title'))
                            {{$errors->first('title')}}
                        @endif
                        <input type="text" class="form-control" id="title" name="stories[0][1]" value="{{old('stories[0][1]',$articles->detailArticle[0]['content'])}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="customFile" class="col-lg-1 col-form-label">サムネ</label>
                    <div class="col-lg-8">
                        @if($errors->has('img'))
                            {{$errors->first('img')}}
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="thumbnail" >
                                <label class="custom-file-label" for="customFile" data-browse="参照">
                                    ファイル選択...

                                </label>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary reset">取消</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="classification" class="col-lg-1 col-form-label">分類</label>
                    <div class="col-lg-8">
                        <select class="form-control" id="classification" name="classification">
                            @foreach($classifications as $classification)
                                <option value="{{$classification->id}}" @if($classification->id ==$articles->classification_id)selected @endif >
                                    {{$classification->classification}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @isset($tabs)
                    <div class="form-group row">
                        <label for="tab_id" class="col-lg-1 col-form-label">タブ</label>
                        <div class="col-lg-8">
                            <select class="form-control" id="tab_id" name="tab_id">
                                 <option value="">設定しない</option>
                                @foreach($tabs as $tab)
                                    <option value="{{$tab->id}}">{{$tab->tab}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endisset

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">タグ</label>      
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="tag1" name="tag1" value="{{old('tag1',$articles['tag1'])}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">タグ</label>      
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="tag2" name="tag2" value="{{old('tag2',$articles['tag2'])}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">タグ</label>      
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="tag3" name="tag3" value="{{old('tag3',$articles['tag3'])}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">タグ</label>      
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="tag4" name="tag4" value="{{old('tag4',$articles['tag4'])}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">タグ</label>      
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="tag5" name="tag5" value="{{old('tag5',$articles['tag5'])}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-lg-1 col-form-label">推奨</label>      
                    <div class="col-lg-8">     
                       
                        <input type="checkbox" class="form-control" name="recommended" @if( $articles['recommended'] == true ) checked @endif>
                        {{-- <input type="checkbox" name="tag[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}" @if (is_array(old("tag")) && in_array("$tag->id", old('tag'), true)) checked @endif>  --}}
                    </div>
                </div>
                <hr>
                {{--ここから内容 --}}
                @php
                    $i=1;
                @endphp
            

                {{--  {{ dd($articles->detailArticle[0]['structure_id']) }} 結果は１　--}}
                @foreach($articles->detailArticle as $detail_article)
                    {{-- dd( $detail_article['structure_id']  )  結果は　１　取れてる 最初は titleからきてる
                         dd( $detail_article['content'])       結果は　"test"
                    --}}
                   
                    {{-- 段落　--}}
                    @isset($detail_article['content'])

                        @if($detail_article['structure_id']== 2)  
                           {{-- --}}
                            <div class="form-group row">
                                <label for="1" class="col-lg-1 col-form-label">段落</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="2" name=stories[{{$i}}][2] >{{ old('stories[$i][2]',$detail_article['content']) }}</textarea>
                                </div>
                                <div class="col-lg-1"><button type="button" class="btn btn-outline-danger"  onclick="return remove(this);" id="remove{{$i}}">削除</button></div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endif

                        {{-- 文字 --}}
                        @if($detail_article['structure_id']== 3)  
                            <div class="form-group row">
                                <label for="1" class="col-lg-1 col-form-label">文字</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="2" name=stories[{{$i}}][3] >{{ old('stories[$i][2]',$detail_article['content']) }}</textarea>
                                </div>
                                <div class="col-lg-1"><button type="button" class="btn btn-outline-danger"  onclick="return remove(this);" id="remove{{$i}}">削除</button></div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endif
                        

                        {{-- 色文字 --}}
                        @if($detail_article['structure_id']== 4)  
                            <div class="form-group row">
                                <label for="1" class="col-lg-1 col-form-label">色文字</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="2" name=stories[{{$i}}][4] >{{ old('stories[$i][2]',$detail_article['content']) }}</textarea>
                                </div>
                                <div class="col-lg-1"><button type="button" class="btn btn-outline-danger"  onclick="return remove(this);" id="remove{{$i}}">削除</button></div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endif
                    @endisset
                @endforeach
                {{--ここまで内容 --}}
            </form>
        </div>
        
        <div class="col-lg-2">
            <nav class="navbar navbar-fixed-top" role="navigation">
                <div class="container">
                    <button type="button" class="btn btn-link" id="paragraph">+段落</button>
                    <button type="button" class="btn btn-link" id="letter">+文字</button>
                    <button type="button" class="btn btn-link" id="c_letter">+色文字</button>
                 
                    <!-- 将来的に実装
                    <button type="button" class="btn btn-link" id="s_letter">+太文字</button>
                    <button type="button" class="btn btn-link" id="">+画像</button>
                    <button type="button" class="btn btn-link" id="">+リンク</button>
                    -->
                </div>
            </nav>
        </div>
    </div>
</div>


<script>
    $i=<?php echo $i; ?>;
    //将来的に段落・文字・・・・等を廃止し　要素の追加という風にまとめ、セレクトボックスで段落・文字という風に選択できるようにする、そのためのtest用
    $("#test").on("click",function(){ 
        $("#form").append(
            $('<div class="form-group row">'
            +'<label for="1" class="col-lg-1 col-form-label">段落</label>'
            +'<div class="col-lg-8"><textarea class="form-control" rows="3" name=stories['+$i+'][3]></textarea></div>'
            +'<div class="col-lg-1"><button type="button" class="btn btn-outline-danger"  onclick="return remove(this);" id="remove'+$i+'">削除</button></div>'
            +'</div>'));
        $i++
    });


    ////////////////////
    //2番段落
    $("#paragraph").on("click",function(){ 
        $("#form").append(
            $('<div class="form-group row">'
            +'<label for="1" class="col-lg-1 col-form-label">段落</label>'
            +'<div class="col-lg-8"><textarea class="form-control" rows="2" name=stories['+$i+'][2]></textarea></div>'
            +'<div class="col-lg-1"><button type="button" class="btn btn-outline-danger"  onclick="return remove(this);" id="remove'+$i+'">削除</button></div>'
            +'</div>'));
        $i++
    });

    //3番 文字
    $("#letter").on("click",function(){ 
        $("#form").append(
            $('<div class="form-group row">'
            +'<label for="1" class="col-lg-1 col-form-label">文字</label>'
            +'<div class="col-lg-8"><textarea class="form-control" rows="3" name=stories['+$i+'][3]></textarea></div>'
            +'<div class="col-lg-1"><button type="button" class="btn btn-outline-danger"  onclick="return remove(this);" id="remove'+$i+'">削除</button></div>'
            +'</div>'));
        $i++
    });

    //4番号　色文字（赤）
    $("#c_letter").on("click",function(){ 
        $("#form").append(
            $('<div class="form-group row">'
            +'<label for="1" class="col-lg-1 col-form-label">色文字</label>'
            +'<div class="col-lg-8"><textarea class="form-control" rows="3" name=stories['+$i+'][4]></textarea></div>'
            +'<div class="col-lg-1"><button type="button" class="btn btn-outline-danger" onclick="return remove(this);" id="remove'+$i+'" >削除</button></div>'
            +'</div>'));
        $i++
    });
    

    //未実装
    /*
    $("#s_letter").on("click",function(){ 
        $("#form").append(
                $('<div class="form-group row" id="remove'+$i+'"><label for="introduction" class="col-sm-2 col-form-label">大文字</label>'
                +'<div class="col-sm-8"><textarea class="form-control" rows="3" name=stories['+$i+'][6]></textarea>'
                +'<button type="button" class="btn btn-warning"　>削除</button>'
                +'</div></div>'));
        $i++
    });
    */

    
    //削除ボタンをしたら
    function remove(obj){   
        remove_id=obj.getAttribute('id');
        var test=$('#' + remove_id).parent().parent().remove();        
    }
 
  
    //画像関連
    $('.custom-file-input').on('change',function(){
        $(this).next('.custom-file-label').html($(this)[0].files[0].name);
    })
    //画像の取消
    $('.reset').click(function(){
        $(this).parent().prev().children('.custom-file-label').html('ファイル選択...');
        $('.custom-file-input').val('');
    })
</script>

 
@endsection