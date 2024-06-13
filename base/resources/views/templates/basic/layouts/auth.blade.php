<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link rel="stylesheet" href="{{ asset('assets/general/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/general/css/fontawesome.min.css') }}" >
    <link rel="stylesheet" href="{{asset('assets/general/css/line-awesome.min.css')}}"/>

    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/slick.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ $general->base_color }}&secondColor={{ $general->secondary_color }}">
</head>
<body>

@stack('fbComment')

@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp

@include($activeTemplate.'partials.loader')

@yield('content')


<script src="{{ asset('assets/general/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/general/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{asset($activeTemplateTrue.'js/popper.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/slick.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/odometer.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/jquery.appear.min.js')}}"></script>

<script src="{{asset($activeTemplateTrue.'js/jquery.validate.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>

@stack('script-lib')

@include('partials.plugins')

@include('partials.notify')

@stack('script')


<style>
/* cookie card */
.cookie-card {
    background: white;
    z-index: 9;
    padding: 60px 80px;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;

    &::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 5%;
        height: 100%;
        width: 90%;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        z-index: -1;

    }

    &::before {
        content: "";
        position: absolute;
        bottom: -20px;
        left: 10%;
        height: 100%;
        width: 80%;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        z-index: -1;

    }
    .content-wrap {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .title {
        font-size: 156px;
        font-weight: 700;
    }

    .subtitle {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 0px;
        text-align: center;
    }

    .back-btn {
        padding: 10px 17px;
        outline: 0px;
        border: none;
        color: white;
        border-radius: 6px;
        background: #4540F7;
        font-size: 19px;
        font-weight: 600;
    }

    .thumb-wrap {
        position: relative;
        rotate: 0px;
    }
}

@media (max-width: 766px) {

    /* cookie */
    .cookie-card{
        padding: 60px 10px;
        width: 96%;
    }
}
</style>

<script>
    (function ($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{route('home')}}/change/"+$(this).val() ;
        });

        $('.policy').on('click',function(){
            $.get('{{route('cookie.accept')}}', function(response){
                $('.cookies-card').addClass('d-none');
            });
        });
        $('.decline').on('click',function(){
            $.get("{{route('cookie.decline')}}", function(response){
                $('.cookies-card').addClass('d-none');
            });
        });


        setTimeout(function(){
            $('.cookies-card').removeClass('hide')
        },2000);

        var inputElements = $('[type=text],select,textarea');
        $.each(inputElements, function (index, element) {
            element = $(element);
            element.closest('.form-group').find('label').attr('for',element.attr('name'));
            element.attr('id',element.attr('name'))
        });

        $.each($('input, select, textarea'), function (i, element) {
            console.log(element);
            var elementType = $(element);
            if(elementType.attr('type') != 'checkbox'){
                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }
            }
        });

    })(jQuery);
</script>

</body>
</html>