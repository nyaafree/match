<section id="sidebar">
    <ul class="p-side">
        <li class="p-side__li">
            <a href="{{ url('profile/'.$user->id.'/edit') }}" class="p-side__link">プロフィール編集</a>
        </li>
        <li class="p-side__li">
            <a href="{{ url('items/create') }}" class="p-side__link">案件投稿</a>
        </li>
        <li class="p-side__li">
            <a href="{{ url('mypage#register') }}" class="p-side__link">登録案件一覧</a>
        </li>
        <li class="p-side__li">
            <a href="{{ url('mypage#apply') }}" class="p-side__link">応募案件一覧</a>
        </li>
        <li class="p-side__li">
            <a href="{{ url('mypage#public') }}" class="p-side__link">投稿コメント一覧</a>
        </li>
        <li class="p-side__li">
            <a href="{{ url('mypage#direct') }}" class="p-side__link">ダイレクトメッセージ一覧</a>
        </li>
        <li class="p-side__li">
            <a href="{{ url('mypage/quit') }}" class="p-side__link js-click-quit">退会する</a>
        </li>

    </ul>
</section>
