<nav class="p-hamburger js-toggle-sp-menu-target">
    <ul class="p-hamburger__menu">
        @if ( ( Request::is('/') ) || ( !empty(Request::input('lowPrice')) || !empty(Request::input('highPrice')) || !empty(Request::input('name')) ) )
            <div class="p-price">
                <form action="{{ url('priceSearch') }}" method="GET" class="js-search-price">
                    <div class="p-price__wrapper">
                        ¥<input type="text" class="p-price__input" name="lowPrice" value="{{ old('lowPrice') }}"> ~
                        ¥<input type="text" class="p-price__input" name="highPrice" value="{{ old('highPrice') }}">
                        <span class="p-price__btnWrap">
                            <button class="p-price__btn btn-lightGreen " type="submit" >
                                <i class="fa fa-search fa-fw"></i>価格で絞り込む
                            </button>
                        </span>

                    </div>
                </form>
                    @include('includes.priceError')

            </div>
            <form action="{{ url('search') }}" method="GET" class="hamburger-search">
                <input type="text" class="c-search__input" name="name">
                <span class="c-search__btnWrap">
                    <button class="c-search__btn btn-yellow" type="submit">
                        <i class="fa fa-search fa-fw"></i>Search
                    </button>
                </span>
            </form>
        @else
            <li class="p-hamburger__list js-nav-close"><a class="menu-link" href="/">Home</a></li>

        @endif
        @if (Auth::check())

            @if (Request::is('mypage'))

                <li class="p-hamburger__list js-nav-close"> <a href="{{ url('mypage#register') }}" class="p-hamburger__link">登録案件一覧</a></li>
                <li class="p-hamburger__list js-nav-close"><a href="{{ url('mypage#apply') }}" class="p-hamburger__link">応募案件一覧</a></li>
                <li class="p-hamburger__list js-nav-close"><a href="{{ url('mypage#public') }}" class="p-hamburger__link">投稿コメント一覧</a></li>
                <li class="p-hamburger__list js-nav-close"><a href="{{ url('mypage#direct') }}" class="p-hamburger__link">投稿ダイレクトメッセージ一覧</a></li>
            @else
                <li class="p-hamburger__list"><a href="{{ url('/mypage') }}">Mypage</a></li>
            @endif
            <li class="p-hamburger__list js-nav-close"><a href="{{ url('profile/'.$loginUser->id.'/edit') }}" class="p-hamburger__link">プロフィール編集</a></li>
            <li class="p-hamburger__list js-nav-close"><a href="{{ url('items/create') }}" class="p-hamburger__link">案件投稿</a></li>
            <li class="p-hamburger__list"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <li class="p-hamburger__list"><a href="{{ route('register') }} ">Register</a></li>
            <li class="p-hamburger__list"><a href="{{ route('login') }}">Login</a></li>
        @endif
    </ul>
</nav>
