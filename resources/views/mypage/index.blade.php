@extends('layouts.app')

@section('title','マイページ')
@section('description', 'このページはマイページです。マイページでは登録案件、応募案件の確認や投稿コメント、投稿ダイレクトメッセージの確認、
編集、削除ができます。また各案件の応募完了後の取引掲示板の一覧も確認できるのですぐに取引に移る事が出来ます。')
@section('keywords', 'マイページ,登録案件,応募案件,コメント,ダイレクトメッセージ,取引掲示板')

@section('header')
@if (Session::has('flash_message'))
<div class="flash_message">
   {{ Session('flash_message')}}
</div>
@endif
  @include('includes.header')
@endsection

@section('content')
    <div class="flex-main">
        @include('mypage.includes.sidebar')
        @include('mypage.includes.main')
    </div>
@endsection

@section('footer')

  @include('includes.footer')
  @parent

@endsection
