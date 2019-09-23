@extends('layouts.template')
@section('title','TOPページ')
@section('content')
<div class="container-fluid">
<div class="card-deck m-3" >
    @foreach($stories as $story)
       
    <div class="col-md-3">   
        <div class="card">
            <a href="/story/detail?id={{$story->id}}">  
                @if(isset($story['thumbnail']))      
                    <img src="/{{$story->thumbnail}}"  class="img-fluid img-thumbnail"    alt="画像がありません" style="height: 11rem; width:30rem;">
                @else     
                    <img src="/storage/thumbnail/no.jpg" class="img-fluid img-thumbnail"  alt="画像がありません">
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
        {{ $stories->links() }}
</div>

          
    
</div>



@endsection