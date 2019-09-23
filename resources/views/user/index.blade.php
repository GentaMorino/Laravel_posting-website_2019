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
                    @if($myInfo['img'])        
                        <img src="{{'/'.$myInfo['img']}}" class="img-fluid img-thumbnail rounded-pill" width="200" height="200" alt="画像がありません">
                    @else     
                        <img src="/storage/img/no.jpg" class="img-fluid img-thumbnail rounded-pill" width="200" height="200" alt="画像がありません">
                    @endif
                       
                </div>

                <div class="h4">
                    {{$myInfo->name}}
                </div>

                <div class="mt-4 text-left kai px-5">
                    {{$myInfo->introduction}}

                    <!--↓↓↓↓↓↓↓↓↓↓　　delete　　↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ -->
                    <div class="form-check mt-5">             
                        <button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#delete">
                            アカウントを削除する
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
                                        本当アカウントを削除しますか？
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                                        <button type="button" class="btn btn-warning"  onclick="event.preventDefault();　
                                                document.getElementById('delete-form').submit();">退会する</button>
                                        <form id="delete-form" action="/user/delete" method="POST" style="display: none;">
                                                @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <!-- ↑↑↑↑↑↑↑↑↑↑↑　delte ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑　-->
                    
                </div>  
        </div>
        <div class="col-3">
        </div> 
    </div>
</div>
@endsection


