@extends('layouts.template')
@section('title','TOPページ')
@section('content')
<div class="container-fluid">
    <div class="card-deck m-3">
        <div class="card">
            <a href="action('story\StoryesController@create')">
                <img src="images/sample.jpg" class="card-img-top"  alt="...">
            </a>
            <div class="card-body">
                <h3 class="card-title h4"><a href="detail.html" class="text-dark">画像タイトル画像タイトル</a></h3>
                <h6 class="card-subtitle text-secondary">更新日 &nbsp; 2019/9/5</h6>
            </div>
        </div>
        <div class="card">
            <a href="detail.html">
                <img src="images/test.jpg" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <h3 class="card-title h4"><a href="detail.html" class="text-dark">画像タイトル画像タイトル</a></h3>
                <h6 class="card-subtitle text-secondary">更新日 &nbsp; 2019/9/5</h6>
            </div>
        </div>
        <div class="card">
            <a href="detail.html">
                <img src="images/sample.jpg" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <h3 class="card-title h4"><a href="detail.html" class="text-dark">画像タイトル画像タイトル</a></h3>
                <h6 class="card-subtitle text-secondary">更新日 &nbsp; 2019/9/5</h6>
            </div>
        </div>
        <div class="card">
            <a href="detail.html">
                <img src="images/sample.jpg" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <h3 class="card-title h4"><a href="detail.html" class="text-dark">画像タイトル画像タイトル</a></h3>
                <h6 class="card-subtitle text-secondary">更新日 &nbsp; 2019/9/5</h6>
            </div>
        </div>
    </div>
</div>


@endsection