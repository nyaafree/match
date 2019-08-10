<nav class="p-hamburger js-toggle-sp-menu-target">
       
<ul class="p-hamburger__menu">
        <form action="{{ url('search') }}" method="GET" class="hamburger-search">
                <input type="text" class="c-search__input" name="name">
                <span class="c-search__btnWrap">
                    <button class="c-search__btn btn-yellow" type="submit">
                        <i class="fa fa-search fa-fw"></i>Search
                    </button>
                </span>
        </form>
　
  <li class="p-hamburger__list js-nav-close"><a class="menu-link" href="/">TOP</a></li>
  @if (Auth::check())
    <li class="p-hamburger__list"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">Logout</a></li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <li class="p-hamburger__list"><a href="{{ url('/mypage') }}">Mypage</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="{{ url('profile/'.$loginUser->id.'/edit') }}" class="p-hamburger__link">プロフィール編集</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="{{ url('items/create') }}" class="p-hamburger__link">案件投稿</a></li>
    <li class="p-hamburger__list js-nav-close"> <a href="{{ url('mypage#register') }}" class="p-hamburger__link">登録案件一覧</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="{{ url('mypage#apply') }}" class="p-hamburger__link">応募案件一覧</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="{{ url('mypage#public') }}" class="p-hamburger__link">投稿コメント一覧</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="{{ url('mypage#direct') }}" class="p-hamburger__link">投稿ダイレクトメッセージ一覧</a></li>
  @else
    <li class="p-hamburger__list"><a href="{{ route('register') }} ">Register</a></li>
    <li class="p-hamburger__list"><a href="{{ route('login') }}">Login</a></li>
  @endif
  {{-- @include('includes.selectArea') --}}
  <li class="p-hamburger__list js-nav-close"><a href="{{ url('#category') }}" class="p-hamburger__link">案件種別表示</a></li>
  <li class="p-hamburger__list js-nav-close"><a href="{{ url('#paging') }}" class="p-hamburger__link">ページネーション</a></li>
</ul>
</nav>
