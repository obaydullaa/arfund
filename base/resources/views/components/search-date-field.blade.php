
<div class="input-group w-auto flex-fill">
    <input name="date" type="search" data-range="true" data-multiple-dates-separator=" - " data-language="en"
    data-format="{{$general->date_format}}" class="datepicker-here form--control w-100 bg-white pe-2 br-right--0" data-position='bottom right'
        placeholder="@lang('Start Date - End Date')" autocomplete="off" value="{{ request()->date }}">
    <button class="btn btn-outline-base input-group-text"><i class="fa-regular fa-calendar"></i></button>
</div>

@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/datepicker.min.css') }}">
@endpush
