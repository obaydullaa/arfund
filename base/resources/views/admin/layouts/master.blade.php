<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $general->siteName($pageTitle ?? '') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ getImage(getFilePath('logoIcon') .'/' . @$general->image->favicon) }}">
    <link rel="stylesheet" href="{{ asset('assets/general/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/general/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/general/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/general/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/datepicker.min.css')}}">
    @stack('style-lib')

    <link href="{{asset('assets/general/css/summernote.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css') }}">

    @stack('style')
</head>

<body>

    <div class="dashboard-body">
        @yield('content')
    </div>

    @php
        $generals = App\Models\SiteSetting::first()->date_format;
    @endphp
    <script src="{{ asset('assets/general/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/general/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/general/js/select2.min.js')}}"></script>

    @include('partials.notify')
    @stack('script-lib')

    <script src="{{ asset('assets/general/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/general/js/summernote-init.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script>
        (function ($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{route('home')}}/change/"+$(this).val();
            });

        const format = "{{$generals}}";


        $.fn.datepicker.language['en'] = {
            days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            today: 'Today',
            clear: 'Clear',
            dateFormat: format,
            timeFormat: 'hh:ii aa',
            firstDay: 0
        };

        })(jQuery);
    </script>


    @stack('script')
</body>

</html>
