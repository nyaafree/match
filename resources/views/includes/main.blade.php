<section id="main">
    <div class="p-panelArea">
        <h1 class="index-title">案件一覧</h1>
        {{-- <div class="flex-right">
            <form action="/category" method="GET">
                @csrf
                <select name="category" id="category_id" onchange="submit(this.form)" class="c-post__select">
                    <option class="c-post__option" value="0">全ての案件を表示</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if (!empty($_GET['category']))
                                {{ $_GET['category'] == $category->id ? 'selected' : '' }}
                            @endif>
                                {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div> --}}
        <div id="app">
                <item-component :categories="{{ $categories }}" :items="{{ $items }}" csrf="{{csrf_token()}}"></item-component>
        </div>
        {{-- @foreach ($items as $item)
            <a href="/items/{{ $item->id }}" class="c-panel">
                <div class="c-panel__container1">
                    <h2 class="c-panel__title">{{ $item->title }}</h2>
                    <div class="c-panel__prof">
                        <span>registered by</span>
                        <img src="{{ url('images/profile/'.$item->user->photo->filename) }}" class="c-panel__img">
                        <span>{{ $item->user->name }}</span>
                    </div>
                </div>
                <div class="c-panel__container2">
                    <h4 class="c-panel__category">{{ $item->category->name }}</h4>
                     if($item->category_id === 1): ?>
                        <div class="c-panel__price">¥{{ $item->lowPrice}} ~ {{ $item->highPrice }}</div>
                     endif ?>
                </div>
                <div class="c-panel__detail">
                    {!! str_limit(html_entity_decode($item->detail),200) !!}...read more
                </div>
            </a>
        @endforeach --}}
    </div>
</section>
