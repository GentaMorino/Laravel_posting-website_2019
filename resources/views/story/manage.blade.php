
@extends('layouts.template')
@section('title','記事管理')
@section('content')
<div class="container-fluid">
        <h1 class="h3 mt-3 mb-2">記事管理</h1>
        <div class="row">
            <div class="col-lg-6">
                <form class="mt-3" method="POST" action="/story/manage" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="tab" class="col-lg-1 col-form-label">
                            タブ
                        </label>
 
                        <div class="col-lg-3">
                            <input type="text" class="form-control" id="tab" name="tab" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                            @if (Session::has('message'))
                                <p class="text-danger">{{ session('message') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-2">
                        <input type="submit" class="btn btn-primary" value="タブ追加">
                    </div>
  
                </form>    
            </div>

            <div class="col-lg-6">
                @isset($tabs)
                    @foreach($tabs as $tab)
                        <div class="row mt-1">
                            <div class="col-lg-1">タブ:</div>
                            <div class="col-lg-3 h4">{{$tab->tab}}</div>
                            <div class="col-lg-2">
                              
                                
                                <button type="button" class="btn  btn-outline-danger btn-sm " data-toggle="modal" data-target="#delete_tab">
                                        削除
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="delete_tab">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                タブ:{{$tab->tab}}を削除しますか？
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                                                <button type="button" class="btn btn-danger"  onclick="event.preventDefault();　
                                                        document.getElementById('delete_tab-form').submit();">削除</button>
                                                <form id="delete_tab-form" action="/story/delete-tab?id={{$tab->id}}" method="POST" style="display: none;">
                                                        @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>

        <div class="float-right mb-2">
            <a class="btn btn-outline-primary btn-sm" href="/story/add" role="button">記事追加</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>サムネ</th>
                    <th>分類</th>
                    <th>タブ</th>
                    <th>タグ1</th>
                    <th>タグ2</th>
                    <th>タグ3</th>
                    <th>タグ4</th>
                    <th>タグ5</th>
                    <th>おすすめ</th>
                    <th>更新日</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stories as $story)
                    <tr>
                        <th>{{$story->detailarticle[0]['content']}}</th>
                       
                        <td style="width:150px">
                            @if(isset($story['thumbnail']))      
                                <img src="/{{$story->thumbnail}}" class="img-fluid img-thumbnail"  alt="画像がありません">
                            @else     
                                <img src="/storage/article_img/no.jpg" class="img-fluid img-thumbnail"  alt="画像がありません">
                            @endif
                        </td>

                        {{-- $story->classification['classification']  でclassifications['classification']　という風に”s”をつけたらなんかうまくいかない --}}
                        <td>{{$story->classification['classification']}}</td>
                        <td>{{$story->tab}}</td>
                        <td>{{$story->tag1 }}</td>
                        <td>{{$story->tag2 }}</td>
                        <td>{{$story->tag3 }}</td>
                        <td>{{$story->tag4 }}</td>
                        <td>{{$story->tag5 }}</td>
                        <td >
                            @if($story->recommended ==1 )
                                おすすめ
                            @endif
                        </td>
                        <td>{{ date('Y/m/d',strtotime($story['updated_at'])) }}</td>

                        <td>
                            <a href="/story/edit" class="btn btn-primary btn-sm">編集</a>&nbsp;/&nbsp;    
                            <button type="button" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#delete">
                                    削除
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="delete">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            本当記事を削除しますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                                            <button type="button" class="btn btn-danger"  onclick="event.preventDefault();　
                                                    document.getElementById('delete-form').submit();">削除</button>
                                            <form id="delete-form" action="/story/delete?id={{$story->id}}" method="POST" style="display: none;">
                                                    @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3">
                {{ $stories->links() }}
        </div>

    </div>



@endsection