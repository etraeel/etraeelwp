<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> WEB PAX وب پکس</title>
    <link rel="stylesheet" href="{{asset('css/normalize.css')}} ">
    <link rel="stylesheet" href="{{asset('css/all.css')}} ">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}} ">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}} ">
    <link rel="stylesheet" href="{{asset('css/fontiran.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">



</head>

<body>


<div class="container">

    @include('master/header')
    <section style="background: linear-gradient(135deg , rgba(26,188,156) 20%, rgba(41,128,185) 80%)!important;" >
            @yield('content')

    </section>

</div>

@include('master/footer')


<script src="{{asset('js/app.js')}}"></script>

<script >

    menu = $('.menu');
    menu.hide();
    $('#menu-icon').click(function () {
        menu.toggle(500);
    });

    logo = $('#site-logo');
    logo.click(function () {
        window.location.href = '/';
    })
</script>


</body>

</html>
