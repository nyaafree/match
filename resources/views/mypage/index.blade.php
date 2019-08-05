@extends('layouts.app')

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
