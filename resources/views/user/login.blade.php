@extends('layouts.template')
@section('title','ログイン')
@section('content')
<div class="container">
    <h1 class="h3 mt-3 mb-2">アカウント編集</h1>
    <div class="container pb-4">

    <form class="mt-3" method="POST" action="/user/postauth">
            {{csrf_field()}}



            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">メールアドレス</label>

                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email"  value="{{old('email')}}">
                </div>
            </div>
 
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">パスワード</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>
            </div>
   
            <div class="mb-2 container-fluid">
                <input type="submit" class="btn btn-primary" value="ログイン">
            </div>
        </form>
    </div>
</div>


@endsection