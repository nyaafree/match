@extends('layouts.app')

@section('header')
  @include('includes.header')
@endsection

@section('content')
    @parent
    <div class="background-creamGreen">
        @include('auth.includes.login')
    </div>
@endsection

@section('footer')
    @include('includes.footer')
    @parent  
@endsection
