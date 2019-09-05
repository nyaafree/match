<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" @yield('description') ">
    <meta name="keywords" content=" @yield('keywords') ">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Match | @yield('title', 'HOME')</title>

    <!-- Scripts -->
    <script src="{{ asset('/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script>window.Promise || document.write('<script src="//www.promisejs.org/polyfills/promise-7.0.4.min.js"><\/script>');</script>

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
                // $ftr.attr({'style' : 'position:fixed; top:' + ( window.innerHeight - $ftr.outerHeight() ) + 'px;'});
                $('.js-click-quit').on('click', function(){
                    if(!confirm('本当に退会しますか？')){
                        /* キャンセルの時の処理 */
                        return false;
                    }else{
                        /* OKの時の処理 */
                        return true;
                    }
                })

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

                   // laravelからエラーメッセージの入った変数$errorsを受け取る
                   let priceError = <?php echo $errors; ?>;
                   console.log(priceError);
                   console.log(priceError.length);
                   console.log(location.pathname);
                   // 価格検索フォームでエラーが発生した場合には下の処理を実行
                   if( priceError.length != 0 ){
                       if(priceError.lowPrice  || priceError.highPrice ){
                           // 価格検索フォームで検索後、Home画面にGET送信で遷移した場合にエラーメッセージをキャッチした場合にはハンバーガーメニューを自動的に開く
                           if(location.pathname == '/'){
                               $('.js-toggle-sp-menu').toggleClass('active');
                               $('.js-toggle-sp-menu-target').toggleClass('active');
                           }

                       }
                   }



            });







        </script>
    @show

</body>
</html>
