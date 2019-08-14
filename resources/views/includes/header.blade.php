<header id="header">
    <nav class="p-nav">
        <div class="p-nav__container1">
            <a href="{{ url('/') }}" class="p-nav__title">Match</a>
            @include('includes.searchItems')
            @if (Auth::check())
                <div class="bell-area">
                    <i class="fas fa-bell bell-color js-click-show-applies"></i>
                    <span class="apply-number">{{ count($applyNumbers) }}</span>
                    <ul class="show-applies js-display-none is-hide">
                        <span class="area-hide js-click-hide"><i class="far fa-times-circle"></i></span>
                        @if (count($loginUser->items) != 0)
                        {{-- 変数 $loginUserは全てのサイト内の全てのページでヘッダー部分にログインユーザーの通知情報を表示するために
                        app/Providers/ComposerServiceProvider.phpに定義してある。変数$applyNumbersも同様 --}}
                            @foreach ($loginUser->items as $item)
                                <?php $applies = $item->applies ?>
                                @foreach ($applies as $apply)
                                    @if ($apply->read === 0)
                                        <li><a href="{{ url('board/'.$apply->board->id) }}">{{ $apply->item->title }}に{{ $apply->user->name }}さんからの応募がありました。</a></li>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                        @if (count($applyNumbers) == 0)
                            <li>案件に対する最新の応募はありません</li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
        <ul class="p-nav__menus u-right">
            @if(Auth::check())
                <li class="p-nav__li"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li class="p-nav__li"><a href="{{ url('/mypage') }}">Mypage</a></li>
            @else
                <li class="p-nav__li"><a href="{{ route('register') }} ">Register</a></li>
                <li class="p-nav__li"><a href="{{ route('login') }}">Login</a></li>
            @endif
        </ul>
    </nav>
    <div class="menu-trigger js-toggle-sp-menu">
     <span></span>
     <span></span>
     <span></span>
     </div>
     @include('includes.hamburger');
 </header>
