@extends('layouts.app')

@section('header')
  @parent
  @if (Session::has('flash_message'))
      <div class="flash_message">
          {{ Session('flash_message')}}
      </div>
  @endif
  @include('includes.header')
@endsection

@section('content')
  <div class="p-item">
        <div class="c-panel__container1">
            <h2 class="c-panel__title">{{ $item->title }}</h2>
            <div class="c-panel__prof js-show-profile" data-user="{{ $item->user }}" id="user">
                <span class="c-panel__span">registered by</span>
                @if( $item->user->photo != null)
                    <img src="{{ url('images/profile/'.$item->user->photo->filename) }}" class="c-panel__img">
                @else
                    <img src="{{ url('images/profile/noimage.png') }}" class="c-panel__img">
                @endif
                <span class="c-panel__span">{{ $item->user->name }}</span>


            </div>
        </div>
        <div class="c-panel__container2">
            <h4 class="c-panel__category">{{ $item->category->name }}</h4>
            <?php if($item->category_id === 1): ?>
                <div class="c-panel__price">¥{{ $item->lowPrice}} ~ {{ $item->highPrice }}</div>
            <?php endif ?>
        </div>
        <div class="c-panel__detail">
            {{ $item->detail }}
        </div>
        <div class="flex-side">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-hashtags="match" data-show-count="false">Tweet</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

            <form action="{{ url('/apply/'.$item->id) }}" method="POST">
            @csrf
                <button class="btn btn-purple">応募する</button>
            </form>
            
        </div>

        <p class="guide-message">
            案件について何か気になることがあればコメントしてみましょう
        </p>
        <h2 class="p-item__comment">コメント一覧</h2>
        @if (empty($comments->count()))
            <p class="p-item__nothing">コメントはまだ投稿されていません。</p>
        @endif
        <div id="app">
            <comment-area  comments="{{ $comments }}" item="{{ $item }}" user="{{ $user }}" baseUrl="{{ json_encode(url('/')) }} "/>
        </div>
        @include('mypage.includes.formErrors');

  </div>
@endsection

@section('footer')
<div class="modal-window js-profile-window is-hide">
        <div class="p-modal">
            <div class="p-modal__container1">
                @if($item->user->photo != null)
                    <img src="{{ url('images/profile/'.$item->user->photo->filename) }}" class="p-modal__img">
                @else
                    <img src="{{ url('images/profile/noimage.png') }}" class="p-modal__img">
                @endif
                <div class="p-modal__container2">
                    <h2 class="p-modal__title">ユーザー名:{{ $item->user->name}}</h2>
                    <h2 class="p-modal__title">自己紹介</h2>
                    <p class="p-modal__introduction">
                        
                        {{ $item->user->introduction }}
                    </p>
                </div>
            </div>
        </div>


    </div>
    <div class="cover js-profile-background is-hide">

    </div>
  @include('includes.footer')
  <script>
      $(function(){
        $('.js-show-profile').on('click', function(event){
                    // event.stopPropagation();
                     console.log('clicked!!');
                     $('.js-profile-window').toggleClass('is-hide');
                     $('.js-profile-background').toggleClass('is-hide');






                 });
                 $('.js-profile-background').on('click', function(){
                        $('.js-profile-window').toggleClass('is-hide');
                        $(this).toggleClass('is-hide');
                 });
      });
  </script>
  @parent
@endsection
