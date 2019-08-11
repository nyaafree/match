@extends('layouts.app')

@section('header')
  @parent
  @include('includes.header')
@endsection

@section('content')
    <div class="background-creamGreen">
        @include('auth.includes.register')
    </div>
@endsection

@section('footer')
  @parent
  @include('includes.footer')
@endsection


