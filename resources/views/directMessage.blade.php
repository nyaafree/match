@extends('layouts.app')

@section('title', '取引掲示板')
@section('description', 'このページは案件への応募が完了したユーザーが案件投稿者とダイレクトメッセージをやり取りでき掲示板ページです。')
@section('keywords','取引掲示板,ダイレクトメッセージ')

@section('header')
@if (Session::has('flash_message'))
<div class="flash_message">
   {{ Session('flash_message')}}
</div>
@endif
  @parent
  @include('includes.header')
@endsection


@section('content')
    <div class="message-area">
        <div class="c-panel__container1">
            <h2 class="c-panel__title">{{ $item->title }}</h2>
            <div class="c-panel__prof js-show-profile">
                <span class="c-panel__span">registered by</span>
                @if ($item->user->photo != null)
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
        <p class="guide-message">
            案件応募が完了しましたので応募者様と提案者様との間で詳細条件についての交渉をお願い致します。
        </p>



        @if (empty($messages->count()))
        <p class="p-item__nothing">コメントはまだ投稿されていません。</p>
        @endif
        <div id="app">
                <message-area  messages="{{ $messages }}" item="{{ $item }}" user="{{ $user }}"/>
        </div>
        <div class="modal-window js-profile-window is-hide">
            <div class="p-modal">
                <div class="p-modal__container1">
                    @if ($item->user->photo != null)
                        <img src="{{ url('images/profile/'.$item->user->photo->filename) }}" class="p-modal__img">
                    @else
                        <img src="{{ url('images/profile/noimage.png') }}" class="p-modal__img">
                    @endif
                    <div class="p-modal__container2">
                        <h2 class="p-modal__title">ユーザー名:{{ $item->user->name}}</h2>
                        <h2 class="p-modal__title">自己紹介</h2>
                        <p class="p-modal__introduction">{{ $item->user->introduction }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cover js-profile-background is-hide">

        </div>
        <form action="{{ url('message/'.$board->id) }}" method="POST">
            @csrf
            <div class="p-item__container1">
                <textarea name="message" cols="30" rows="8" class="p-item__input">

                </textarea>
                <button type="submit" class="btn btn-lightblue">メッセージを投稿</button>
            </div>
            @include('mypage.includes.formErrors')
        </form>
    </div>

@endsection

@section('footer')
    <script>
        $(function(){
            $('.js-show-profile').on('click', function(event){
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
  @include('includes.footer')

  @parent
@endsection
