@extends('layouts.template')
@section('title','記事閲覧')
@section('content')
<div class="container">

    <a href="/story/personal?id={{$detail_story->user['id']}}">
        <h4 class="mt-3 mb-2">＠{{$detail_story->user['name']}}
    </a>
    <span class="h6 text-muted">&nbsp;&nbsp;更新日 &nbsp; {{ date('Y年m月d日',strtotime($detail_story['updated_at'])) }}</span>
    </h4>

    <h1 class="mt-1 mb-2　border-bottom font-weight-bold">{{$detail_story->detailarticle[0]['content']}} </h1>
    @for($i=1;$i<=5;$i++)
        @isset($detail_story['tag'.$i])
            <a href="/story/index?tag={{$detail_story['tag'.$i]}}" class="badge badge-pill badge-primary m-1">{{$detail_story['tag'.$i]}}</a>
        @endisset
    @endfor


    <hr>
    
    @foreach($detail_story->detailarticle as $detailArticle)
        
        @if($detailArticle->structure_id == 2){{-- 2は段落 --}}
            <div class="alert alert-dark h2 mt-3">
                {!! nl2br(e($detailArticle->content)) !!}
            </div>
        @endif
      

        
        @if($detailArticle->structure_id == 3){{-- 3はletter 通常文字 --}}
            <p class="h4">
                {!! nl2br(e($detailArticle->content)) !!}
            </p>
        @endif
        
        @if($detailArticle->structure_id == 4){{-- 4はc_letter 色文字 --}}
            <p class="text-danger h4">
                {!! nl2br(e($detailArticle->content)) !!}
            </p>
        @endif

    @endforeach


</div>




@endsection