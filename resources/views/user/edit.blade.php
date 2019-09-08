@extends('layouts.template')
@section('title','アカウント編集')
@section('content')
<div class="container">
    <h1 class="h3 mt-3 mb-2">アカウント編集</h1>
    <div class="container pb-4">

    <form class="mt-3" method="POST" action="/user/edit" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">名前</label>

                <div class="col-sm-9">
                    @if($errors->has('name'))
                        {{$errors->first('name')}}
                    @endif
                    <input type="text" class="form-control" id="name" name="name" value="{{$myInfo->name}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">メールアドレス</label>

                <div class="col-sm-9">
                    @if($errors->has('email'))
                        {{$errors->first('email')}}
                    @endif
                    <input type="email" class="form-control" id="email" name="email"  value="{{$myInfo->email}}">
                </div>
            </div>
 
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">パスワード</label>

                <div class="col-sm-9">
                    @if($errors->has('passowrd'))
                        {{$errors->first('password')}}
                    @endif
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="password2" class="col-sm-3 col-form-label">パスワード再入力</label>
                
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password2" name="password2" value="">
                </div>
            </div>
 
  
            <div class="form-group row">
                <label for="speciality" class="col-sm-3 col-form-label">自己紹介</label>
                <div class="col-sm-9">
                    @if($errors->has('introduction'))
                        {{$errors->first('introduction')}}
                    @endif
                    <textarea class="form-control" id="speciality"  rows="20" name="introduction" value="{{$myInfo->introduction}}"></textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="addImage" class="col-sm-3 col-form-label">画像（変更）</label>
                <div class="col-sm-9">
                    @if($errors->has('img'))
                        {{$errors->first('img')}}
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="addImage" name="img" lang="ja">
                        <label class="custom-file-label" for="addImage">ファイル選択...</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">画像（削除）</label>
                <div class="col-sm-9">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="removeImg">
                        <label class="form-check-label" for="removeImg">削除</label>
                    </div>
                    <img src="{{$myInfo->img}}" alt="画像がありません" class="img-fluid img-thumbnail">
                    
                </div>
            </div>
            <div class="mb-2 container-fluid">
                <input type="submit" class="btn btn-primary" value="更新登録">
            </div>
        </form>
    </div>
</div>


@endsection