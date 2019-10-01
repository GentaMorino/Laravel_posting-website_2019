@extends('layouts.template')
@section('title','個人ページ')
@section('content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-lg-10 pl-3">
            {{--ここからタブ --}}
            <div class="text-center p-3">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item col-lg-2"><a href="/story/personal?id={{$user->id}}" class="nav-link active text-light bg-primary" >ホーム</a></li>
                    @foreach($tabs as $tab)     
                        <li class="nav-item col-lg-2"><a href="/story/personal?id={{$user->id}}&tab-id={{$tab->id}}" class="nav-link text-light bg-primary" >{{$tab->tab}}</a></li>
                    @endforeach
                </ul>
            </div>
            {{--ここまでタブ --}}
                    
           
            {{--ここからおすすめ--}}   
            @php
                $first_count=0;
                $second_count=0;
            @endphp
            <div id="example-2" class="carousel slide p-5 mx-auto" data-ride="carousel" style="width:400px">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container-fluid ">
                            @foreach($recommendeds as $recommended)
                                @if($first_count == 1)
                                    @php
                                        break; 
                                    @endphp
                                @endif
                                <div class="card">
                                    <a href="/story/detail?id={{$recommended->id}}">  
                                        @if(isset($recommended['thumbnail']))      
                                            <img src="/{{$recommended->thumbnail}}"  class="img-fluid img-thumbnail"    alt="画像がありません" style="height: 11rem; ">
                                        @else     
                                            <img src="/storage/thumbnail/no.jpg" class="img-fluid img-thumbnail"  alt="画像がありません" style="height: 11rem; ">
                                        @endif
                                    
                                        <div class="card-body">
                                            <h3 class="card-title h4 text-dark">{{$recommended->detailarticle[0]['content']}}</h3>
                                            <h6 class="card-subtitle text-secondary">更新日 &nbsp; {{ date('Y年m月d日',strtotime($recommended['updated_at'])) }} </h6>
                                        </div>
                                    </a>
                                </div>
                                @php
                                    $first_count++;
                                @endphp
                            @endforeach   
                        </div>
                    </div>
                    
                    @foreach($recommendeds as $recommended)
                        @if($second_count == 0)
                            @php
                                $second_count++; 
                                continue; 
                            @endphp
                        @endif
                        <div class="carousel-item">    
                            <div class="card">
                                <a href="/story/detail?id={{$recommended->id}}">  
                                    @if(isset($recommended['thumbnail']))      
                                        <img src="/{{$recommended->thumbnail}}"  class="img-fluid img-thumbnail"    alt="画像がありません" style="height: 11rem; ">
                                    @else     
                                        <img src="/storage/thumbnail/no.jpg" class="img-fluid img-thumbnail"  alt="画像がありません" style="height: 11rem; ">
                                    @endif
                                
                                    <div class="card-body">
                                        <h3 class="card-title h4 text-dark">{{$recommended->detailarticle[0]['content']}}</h3>
                                        <h6 class="card-subtitle text-secondary">更新日 &nbsp; {{ date('Y年m月d日',strtotime($recommended['updated_at'])) }} </h6>
                                    </div>
                                </a>
                            </div>            
                        </div>
                       
                    @endforeach
                    
                

                    <a class="carousel-control-prev" href="#example-2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="carousel-control-next" href="#example-2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            {{--ここまでおすすめ --}}

            <div class="card-deck m-3" >
                @foreach($articles as $article)            
                    <div class="col-md-3 pb-3 ">   
                        <div class="card">
                            <a href="/story/detail?id={{$article->id}}">  
                                @if(isset($article['thumbnail']))      
                                    <img src="/{{$article->thumbnail}}"  class="img-fluid img-thumbnail"    alt="画像がありません" style="height: 10rem;">
                                @else     
                                    <img src="/storage/thumbnail/no.jpg" class="img-fluid img-thumbnail"  alt="画像がありません" style="height: 10rem; ">
                                @endif
                            
                                <div class="card-body">
                                    <h3 class="card-title h4 text-dark">{{$article->detailarticle[0]['content']}}</h3>
                                    <h6 class="card-subtitle text-secondary">更新日 &nbsp; {{ date('Y年m月d日',strtotime($article['updated_at'])) }} </h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="center-block">
                    {{-- 複数条件　--}}
                    {{$articles->appends($page)->links() }}
            </div>

      
        </div>
        <div class="col-lg-2 text-center">
            <div>
                @if($user['img'])        
                    <img src="{{'/'.$user['img']}}" class="img-fluid img-thumbnail rounded-pill" alt="画像がありません" style="height: 11rem; ">
                @else     
                    <img src="/storage/img/no.jpg" class="img-fluid img-thumbnail rounded-pill" alt="画像がありません" style="height: 11rem; ">
                @endif    
            </div>
            <div class="h4 mt-2">
                {{$user->name}}
            </div>
            <div class="mt-4 text-left kai px-5">
                {!! nl2br(e($user->introduction)) !!}
            </div>
        </div>
    </div>
</div>
<script>
    //tab設定
    //$('#myTab a[href="#profile"]').tab('show');
</script>





@endsection