@extends('layouts.app')

@section('header')
  @include('includes.header')
@endsection

@section('content')
    @parent
    <div class="background-creamGreen">
        @include('auth.includes.login')
        @include('mypage.includes.formErrors')
    </div>
@endsection

@section('footer')
    @include('includes.footer')
    @parent
@endsection
