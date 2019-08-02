@extends('layouts.app')

@section('header')
  @parent
  @include('includes.header')
@endsection

@section('content')
    <div class="flex-main">
        @include('mypage.includes.sidebar')
        <div class="p-prof">
            <h1 class="p-prof__title">プロフィール編集</h1>
            <div class="p-prof__formArea">
              <form action="/profile/{{ $user->id }}" method="POST" class="p-prof__form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="p-prof__inputWrapper1">
                    <div class="p-prof__inputGroup">
                        <label for="image" class="p-prof__labelTitle">画像</label>
                        <div>
                            <img src="{{ url('/images/profile/'.$user->photo['filename']) }}" alt="" class="p-prof__image js-img-preview" width="50%">
                        </div>
                        <input type="file" name="file" id="image" class="js-img-input">
                    </div>
                </div>
                <div class="p-prof__inputWrapper2">
                    <div class="p-prof__inputGroup">
                        <label for="name" class="p-prof__labelTitle">名前</label>
                        <input type="text" class="p-prof__input" value="{{ $user->name }}" name="name" id="name">
                    </div>
                    <div class="p-prof__inputGroup">
                        <label for="email" class="p-prof__labelTitle">メールアドレス</label>
                        <input type="text" class="p-prof__input" value="{{ $user->email }}" name="email" id="email">
                    </div>
                    <div class="p-prof__inputGroup">
                        <label for="introduction" class="p-prof__labelTitle">自己紹介</label>
                        <textarea name="introduction" class="p-prof__input text-left" id="introduction" cols="30" rows="10">
                            {{ $user->introduction }}
                        </textarea>
                    </div>
                    <div class="p-prof__inputGroup flex-reverse">
                        <button type="submit" class="btn btn-purple">編集</button>
                    </div>
                </div>

              </form>
            </div>
        </div>
    </div>

    @component('mypage.includes.formErrors')

    @endcomponent
@endsection

@section('footer')
  @include('includes.footer')
  @parent
  <script>
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    $('.js-img-preview').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('.js-img-input').change(function(){
            readURL(this);
        });
  </script>
@endsection
