@extends('layouts.template')
@section('title','記事閲覧')
@section('content')
<div class="container">

    <h4 class="mt-3 mb-2">作成者<span class="h5">&nbsp;&nbsp;更新日 &nbsp; {{ date('Y年m月d日',strtotime($detail_story['updated_at'])) }}</span></h4>
    <h1 class="mt-1 mb-2　border-bottom">{{$detail_story->detailarticle[0]['content']}} </h1>
    <a href="#" class="badge badge-pill badge-primary">タグ</a>
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