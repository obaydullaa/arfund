<link rel="stylesheet" href="{{ asset('assets/general/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{asset('assets/general/css/notify.css')}}">
<script src="{{ asset('assets/general/js/iziToast.min.js') }}"></script>

@if (session()->has('notify'))
    @foreach (session('notify') as $msg)
        <script>
            "use strict";
            iziToast.{{ $msg[0] }}({
                message: "{{ __($msg[1]) }}",
                position: "topRight",
                backgroundColor: '#fff',
                timeout: 5000,
                icon: 'icon-class icon-class-{{ $msg[0] }}',
                close: true
            });
        </script>
    @endforeach
@endif

@if (isset($errors) && $errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        "use strict";
        @foreach ($errors as $error)
            iziToast.error({
                message: '{{ __($error) }}',
                position: "topRight",
                icon: 'icon-class-error',
                close: true,
                backgroundColor: '#fff',
            });
        @endforeach
    </script>
@endif

<script>
    "use strict";

    function notify(status, message) {
        console.log(status, message);
        if (typeof message == 'string') {
            iziToast[status]({
                message: message,
                position: "topRight",
                backgroundColor: '#fff',
                timeout: 5000,
                icon: `icon-class icon-class-${status}`,
            });
        } else {
            $.each(message, function(i, val) {
                iziToast[status]({
                    message: val,
                    position: "topRight",
                    backgroundColor: '#fff',
                    timeout: 5000,
                    icon: `icon-class icon-class-${status}`,
                });
            });
        }
    }
</script>





