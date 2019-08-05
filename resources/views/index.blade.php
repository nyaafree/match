@extends('layouts.app')

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


