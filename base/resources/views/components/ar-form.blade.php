@foreach($formData as $data)

    <div class="form-group mb-3 mt-2">
        <label class="{{ Route::is('user.*') ? 'form--label' : 'form-label' }}">{{ __($data->name) }}</label>
        @if($data->type == 'text')
            <input type="text" class="form--control w-100" name="{{ $data->label }}" value="{{ old($data->label) }}" placeholder="{{ @$data->placeholder }}" @if($data->is_required == 'required') required @endif>
        @elseif($data->type == 'email')
            <input type="email" class="form--control w-100" name="{{ $data->label }}" value="{{ old($data->label) }}" placeholder="{{ @$data->placeholder }}" @if($data->is_required == 'required') required @endif>
        @elseif($data->type == 'number')
            <input type="number" class="form--control w-100" name="{{ $data->label }}" value="{{ old($data->label) }}" placeholder="{{ @$data->placeholder }}" @if($data->is_required == 'required') required @endif>
        @elseif($data->type == 'date')
            <input name="date" type="search" data-range="false" data-multiple-dates-separator=" - " data-language="en"
            data-format="{{$general->date_format}}" class="datepicker-here form--control w-100 bg-white pe-2 br-right--0" data-position='bottom right'
                placeholder="@lang('Start Date - End Date')" autocomplete="off" value="">

        @elseif($data->type == 'textarea')
            <textarea
                class="form--control w-100"
                name="{{ $data->label }}" placeholder="{{ @$data->placeholder }}"
                @if($data->is_required == 'required') required @endif
            >{{ old($data->label) }}</textarea>
        @elseif($data->type == 'select')
            <select
                class="form--control form-select select w-100"
                name="{{ $data->label }}"
                @if($data->is_required == 'required') required @endif
            >
                <option value="">{{ @$data->placeholder != null ? @$data->placeholder : "@lang('Select One')" }}</option>
                @foreach ($data->options as $item)
                    <option value="{{ $item }}" @selected($item == old($data->label))>{{ __($item) }}</option>
                @endforeach
            </select>
        @elseif($data->type == 'checkbox')
            @foreach($data->options as $option)
                <div class="form-check">
                    <input
                        class="form-check-input"
                        name="{{ $data->label }}[]"
                        type="checkbox"
                        value="{{ $option }}"
                        id="{{ $data->label }}_{{ titleToKey($option) }}"
                    >
                    <label class="form-check-label" for="{{ $data->label }}_{{ titleToKey($option) }}">{{ $option }}</label>
                </div>
            @endforeach
        @elseif($data->type == 'radio')
            @foreach($data->options as $option)
                <div class="form-check">
                    <input
                    class="form-check-input"
                    name="{{ $data->label }}"
                    type="radio"
                    value="{{ $option }}"
                    id="{{ $data->label }}_{{ titleToKey($option) }}"
                    @checked($option == old($data->label))
                    >
                    <label class="form-check-label" for="{{ $data->label }}_{{ titleToKey($option) }}">{{ $option }}</label>
                </div>
            @endforeach
        @elseif($data->type == 'file')
            <input
            type="file"
            class="form--control w-100"
            name="{{ $data->label }}"
            @if($data->is_required == 'required') required @endif
            accept="@foreach(explode(',',$data->extensions) as $ext) .{{ $ext }}, @endforeach"
            >
            <pre class="text-base mt-1">@lang('Supported mimes'): {{ $data->extensions }}</pre>
        @endif
    </div>
@endforeach

@php
$generals = App\Models\SiteSetting::first()->date_format;
@endphp

@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/datepicker.min.css') }}">
@endpush

@push('script')
<script>
    (function ($) {
        "use strict";

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
@endpush



