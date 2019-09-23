<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{action('Story\StoriesController@index')}}">Top</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown">
                    カテゴリー
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @isset($classifications)
                        @foreach($classifications as $classification)
                            <a class="dropdown-item" href="#">{{$classification->classification}}</a>
                        @endforeach
                    @endisset
                </div>

                @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="/login">ログイン</a>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="/user/index">アカウント管理</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/story/manage">記事管理</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();　document.getElementById('logout-form').submit();">
                            ログアウト
                            <!-- {{ __('Logout') }} -->
                        </a>

                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="キーワードを入力">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">検索</button>
        </form>
    </div>
</nav>
