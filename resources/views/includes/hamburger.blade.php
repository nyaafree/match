<nav class="p-hamburger js-toggle-sp-menu-target">
    {{-- @include('includes.searchPosts') --}}
<ul class="p-hamburger__menu">
  <li class="p-hamburger__list js-nav-close"><a class="menu-link" href="/">TOP</a></li>
  @if (Auth::check())
    <li class="p-hamburger__list"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">Logout</a></li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <li class="p-hamburger__list"><a href="{{ url('/mypage') }}">Mypage</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="/profile/{{ $loginUser->id }}/edit" class="p-hamburger__link">プロフィール編集</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="/items/create" class="p-hamburger__link">案件投稿</a></li>
    <li class="p-hamburger__list js-nav-close"> <a href="/mypage#register" class="p-hamburger__link">登録案件一覧</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="/mypage#apply" class="p-hamburger__link">応募案件一覧</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="/mypage#public" class="p-hamburger__link">投稿コメント一覧</a></li>
    <li class="p-hamburger__list js-nav-close"><a href="/mypage#direct" class="p-hamburger__link">ダイレクトメッセージ一覧</a></li>
  @else
    <li class="p-hamburger__list"><a href="{{ route('register') }} ">Register</a></li>
    <li class="p-hamburger__list"><a href="{{ route('login') }}">Login</a></li>
  @endif
  {{-- @include('includes.selectArea') --}}
  
</ul>
</nav>
