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
    @stack('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/slick.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/custom.css') }}">

    @stack('style')


<link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ $general->base_color }}&secondColor={{ $general->secondary_color }}">
</head>
<body>

    @include($activeTemplate.'partials.loader')
    @include($activeTemplate.'partials.user-sidenav')

    <div class="dashboard-wrapper">
        <div class="dashboard-container-wrapper">
            <div class="container-fluid">
                    @include($activeTemplate.'partials.user-sidenav-topheader')
                    @yield('content')
            </div>
        </div>    
    </div>
    <!-- ==================== Dashboard End Here ==================== -->


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
    @include('partials.notify')
    @include('partials.plugins')

    @stack('script')

    <script>
        (function ($) {
            "use strict";
            $(".langSel").on("change", function () {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

        })(jQuery);

    </script>

    <script>
        (function ($) {
            "use strict";

            $('form').on('submit', function () {
                if ($(this).valid()) {
                    $(':submit', this).attr('disabled', 'disabled');
                }
            });

            var inputElements = $('[type=text],[type=password],select,textarea');
            $.each(inputElements, function (index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for',element.attr('name'));
                element.attr('id',element.attr('name'))
            });

            $.each($('input, select, textarea'), function (i, element) {

                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }

            });

            $('.showFilterBtn').on('click',function(){
                $('.responsive-filter-card').slideToggle();
            });


            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

        })(jQuery);

    </script>
</body>
</html>