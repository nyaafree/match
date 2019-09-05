@extends('layouts.app')

@section('description','当サービスは会員になるとエンジニア向けの案件やサービス立ち上げ案を投稿、案件に応募ができます。
案件は単発案件、レベニューシアのいずれかを選択することができ、気になることがあれば案件詳細画面にて
案件投稿者に直接質問することが可能です。案件に応募した後にはサイト内でダイレクトメッセージのやり取り
をして、案件投稿者と応募者の条件がマッチした場合契約成立となります。')

@section('keywords','HOME,単発案件,レベニューシア')

@section('header')
  @parent
  @include('includes.header')
@endsection


@section('content')

    @include('includes.middleHeader')
    @include('includes.main')

@endsection

@section('footer')
  @include('includes.footer')
 
  @parent
@endsection


