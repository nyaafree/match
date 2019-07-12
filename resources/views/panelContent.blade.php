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
            <div class="c-panel__prof">
                <span>registered by</span>
                <img src="{{ url('images/profile/'.$item->user->photo->filename) }}" class="c-panel__img">
                <span>{{ $item->user->name }}</span>
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
        <div class="flex-right">
            <button class="btn btn-purple">応募する</button>
        </div>
        <h2 class="p-item__comment">コメント一覧</h2>
        @if (empty($comments->count()))
            <p class="p-item__nothing">コメントはまだ投稿されていません。</p>
        @endif
        <div id="app">
            <comment-area  comments="{{ $comments }}" item="{{ $item }}"/>
        </div>
        {{-- <h2 class="p-item__comment">コメント一覧</h2>
        @if (empty($comments->count()))
           <p class="p-item__nothing">コメントはまだ投稿されていません。</p>
        @else
        <div class="c-comment"><!--①LINE会話全体を囲う-->
            @foreach ($comments as $comment)

                @if ($comment->user_id != $item->user_id)
                    <!--②左コメント始-->
                    <div class="c-comment__questioner">
                        <div class="c-comment__imgArea">
                            <img src="{{ url('/images/profile/'.$comment->user->photo->filename) }}" alt="" class="c-comment__image">
                        </div>
                        <div class="c-comment__question">
                            <div class="c-comment__says">
                               <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                  <!--②/左コメント終-->
                @else
                <!--③右コメント始-->
                  <div class="c-comment__answer">
                    <p>
                        {{ $comment->comment}}
                    </p>
                  </div>
                  <!--/③右コメント終-->
                @endif



           @endforeach
          </div><!--/①LINE会話終 !-->
        @endif
            <form action="/comments/{{ $item->id }}" method="POST">
                @csrf
                <div class="p-item__container1">
                    <textarea name="comment" cols="30" rows="8" class="p-item__input">

                    </textarea>
                    <button type="submit" class="btn btn-lightblue">コメントする</button>
                </div>
            </form> --}}


  </div>
@endsection

@section('footer')
  @include('includes.footer')
  @parent
@endsection
