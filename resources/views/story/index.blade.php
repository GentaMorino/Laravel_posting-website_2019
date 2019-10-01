@extends('layouts.template')
@section('title','TOPページ')
@section('content')
<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid mt-3">
        <div class="container">
            <div class="row">
                @if(isset($keyword))
                    <div class="col-lg-2 h2">検索結果</div>
                    <div class="col-lg-4 h2">{{$keyword}}</div>
                @else
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4"></div>
                @endif
                
            </div>
        </div>
    </div>

    @isset($stories)
        <div class="card-deck m-3" >
            @foreach($stories as $story)
            <div class="col-md-3 mb-5">   
                <div class="card">
                    <a href="/story/detail?id={{$story->id}}">  
                        @if(isset($story['thumbnail']))      
                            <img src="/{{$story->thumbnail}}"  class="img-fluid img-thumbnail"    alt="画像がありません"  style="height: 13rem;">
                        @else     
                            <img src="/storage/thumbnail/no.jpg" class="img-fluid img-thumbnail"  alt="画像がありません"  style="height: 13rem;">
                        @endif
                    
                        <div class="card-body">
                            <h3 class="card-title h4 text-dark">{{$story->detailarticle[0]['content']}}</h3>
                            <h6 class="card-subtitle text-secondary">更新日 &nbsp; {{ date('Y年m月d日',strtotime($story['updated_at'])) }} </h6>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="center-block">
            @if(isset($page))
                {{ $stories->appends($page)->links() }}
            @else
                {{ $stories->links() }}
            @endif
        </div>
    @endisset
</div>
@endsection