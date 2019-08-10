@extends('layouts.app')

@section('header')
  @parent
  @include('includes.header')
@endsection

@section('content')

  <div class="flex-main">
     @include('mypage.includes.sidebar')
      <div class="c-post">
        <div id="app">
            <item-form :user="{{ json_encode($user) }}" :categories="{{ json_encode($categories) }}"
        :olds="{{ json_encode(old()) }}"/>
        </div>
        @include('mypage.includes.formErrors')
     </div>

      {{-- <div class="c-post">
            <h1 class="c-post__title">案件投稿</h1>
            <div class="c-post__formArea">
                <form action="/items" method="POST" class="c-post__form">
                    @csrf
                    <div class="c-post__inputGroup">
                        <label for="title" class="c-post__labelTitle">案件タイトル</label>
                        <input type="text" class="c-post__input" name="title" id="title">
                    </div>
                    <div class="c-post__inputGroup">
                        <label for="category_id" class="c-post__labelTitle">案件カテゴリ</label>
                        <select name="category_id" id="category_id" class="c-post__select">
                            <option  selected class="c-post__option" value="0">カテゴリを選択してください</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">
                                    {{ $category->name }}
                              </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="c-post__inputGroup">
                        <label for="detail" class="c-post__labelTitle">詳細情報</label>
                        <textarea name="detail" class="c-post__input text-left" id="detail" cols="30" rows="10">

                        </textarea>
                    </div>
                    <div class="c-post__inputGroup">
                        <label for="" class="c-post__labelTitle">価格帯（単発案件のみ選択してください）</label>
                        <div class="c-post__priceWrapper">

                           <div>
                               <input type="text" name="lowPrice" class="c-post__price"><span>000</span>
                           </div>
                           <span class="c-post__center">〜</span>
                           <div>
                               <input type="text" name="highPrice" class="c-post__price"><span>000</span>
                           </div>
                        </div>
                    </div>
                    <div class="c-post__submit">
                        <button type="submit" class="btn-purple btn-wide">投稿する</button>
                    </div>
                    @include('mypage.includes.formErrors')
                </form>
            </div>
      </div> --}}
  </div>
@endsection

@section('footer')
  @include('includes.footer')
  @parent
@endsection
