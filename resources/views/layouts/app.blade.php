<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Match</title>

    <!-- Scripts -->
    <script src="{{ asset('/vendor/jquery/jquery-3.3.1.min.js') }}"></script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Righteous|Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kosugi+Maru|Sawarabi+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">



</head>
<body>
    @section('header')

    @show
    
    @yield('content')

    @section('footer')
        <script src="{{ asset('js/app.js')}}"></script>
        <script>
            $(function(){

                var $ftr = $('#footer');
                if ( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
                    $ftr.attr({'style' : 'position:fixed; top:' + ( window.innerHeight - $ftr.outerHeight() ) + 'px;'});
                };

                 $('.js-toggle-sp-menu').on('click', function () {
                     $(this).toggleClass('active');
                     $('.js-toggle-sp-menu-target').toggleClass('active');
                 });

                 $('.js-nav-close').on('click', function(){
                    $('.js-toggle-sp-menu').toggleClass('active');
                    $('.js-toggle-sp-menu-target').toggleClass('active');
                 });

                 $('.js-click-show-applies').on('click',function(){
                    $('.js-display-none').toggleClass("is-hide");
                 });

                 $('.js-click-hide').on('click',function(){
                    $('.js-display-none').toggleClass("is-hide");
                 });

                 $(document).ready(function(){
                    $('.flash_message').slideDown('slow');

                     setTimeout(function(){
                         $('.flash_message').slideUp('slow');
                     },5000);
                 });
            });







        </script>
    @show

</body>
</html>
