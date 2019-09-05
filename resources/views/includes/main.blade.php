<section id="main">
    <div class="p-panelArea">
        <h1 class="index-title">案件一覧</h1>
        <div id="app">
            <item-area :categories="{{ $categories }}" :items="{{ $jsons }}" csrf="{{csrf_token()}}"
            @if (!empty($user))
              user="{{ $user }}"
            @endif
            >
            </item-area>
        </div>
    </div>
</section>
