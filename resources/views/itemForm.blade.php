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
  </div>
@endsection

@section('footer')
  @include('includes.footer')
  @parent
@endsection
