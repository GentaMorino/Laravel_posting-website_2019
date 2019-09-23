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
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$myInfo->name)}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">メールアドレス</label>

                <div class="col-sm-9">
                    @if($errors->has('email'))
                        {{$errors->first('email')}}
                    @endif
                    <input type="email" class="form-control" id="email" name="email"  value="{{old('email',$myInfo->email)}}">
                </div>
            </div>
 
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">パスワード <span class="badge badge-pill badge-danger">8文字以上です</span></label>

                <div class="col-sm-9">
                    @if($errors->has('password'))
                        {{$errors->first('password')}}
                    @endif
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 col-form-label">パスワード再入力</label>
                
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
                </div>
            </div>
 
  
            <div class="form-group row">
                <label for="introduction" class="col-sm-3 col-form-label">自己紹介</label>
                <div class="col-sm-9">
                    @if($errors->has('introduction'))
                        {{$errors->first('introduction')}}
                    @endif
                    <textarea class="form-control" id="introduction" rows="20" name="introduction">@isset($myInfo->introduction){{old('introduction',$myInfo->introduction)}}@endisset</textarea>
                </div>
            </div>
        
      
            <div class="form-group row">
                <label for="customFile" class="col-sm-3 col-form-label">画像（追加）</label>
                <div class="col-sm-9">
                    @if($errors->has('img'))
                        {{$errors->first('img')}}
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="img" >
                            <label class="custom-file-label" for="customFile" data-browse="参照">ファイル選択...</label>
                        </div>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary reset">取消</button>
                        </div>
                    </div>
                </div>
            </div>


     
 
   
            <div class="mb-2 container-fluid">
                <input type="submit" class="btn btn-primary" value="更新登録">
            </div>
        </form>
    </div>

</div>

<script>
    $('.custom-file-input').on('change',function(){
        $(this).next('.custom-file-label').html($(this)[0].files[0].name);
    })
    //ファイルの取消
    $('.reset').click(function(){
        $(this).parent().prev().children('.custom-file-label').html('ファイル選択...');
        $('.custom-file-input').val('');
    })
</script>

@endsection