@extends('layouts.template')
@section('title','アカウント管理')
@section('content')
<div class="container">
    <h1 class="h3 mt-3 mb-2">アカウント管理</h1>
    <a class="navbar-brand" href="/user/edit">編集</a>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6 text-center">
                <div>
                    <img src="images/test.jpg" class="img-fluid img-thumbnail rounded-pill" width="300" height="300" alt="">
                </div>
                <div class="h4">
                    {{$myInfo->name}}
                </div>
                <div class="mt-4 text-left kai px-5">
                    qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq
                    {{$myInfo->introduction}}
                </div>  
        </div>
        <div class="col-3">
        </div> 
    </div>
</div>
@endsection