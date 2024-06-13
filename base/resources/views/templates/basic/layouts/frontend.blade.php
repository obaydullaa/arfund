<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link rel="stylesheet" href="{{ asset('assets/general/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/general/css/fontawesome.min.css') }}" >
    <link rel="stylesheet" href="{{asset('assets/general/css/line-awesome.min.css')}}">
    @stack('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/slick.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ $general->base_color }}">
</head>
<body>

@stack('fbComment')

@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp

@include($activeTemplate.'partials.loader')
@include($activeTemplate.'partials.header')

@if(request()->route()->uri != '/' && (request()->route()->uri != route('user.data')))
    @include($activeTemplate.'partials.breadcrumb')
@endif

@yield('content')

@include($activeTemplate.'partials.cookie')
@include($activeTemplate.'partials.footer')


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
        setTimeout(function(){
            $('.cookies-card').removeClass('hide')
        },2000);



        $.each($('input, select, textarea'), function (i, element) {

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