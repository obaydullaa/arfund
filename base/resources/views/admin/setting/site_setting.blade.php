@extends('admin.layouts.app')
@section('panel')

    <div class="row gy-4   mb-5 row align-items-center">
        <div class="col-xl-12">
            <div class="card-two mb-4">
                <div class="card-header">
                    <div class="row">
                        @include('admin.partials.tab.general')
                    </div>

                </div>
            </div>

            <div class="card-two">
                <h5 class="card-title mb-3">@lang('Site Setting')</h5>
                <div class="card-body pt-1">
                    <form action="{{ route('admin.setting.update') }}" method="POST">
                        @csrf
                        <div class="row gy-2">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group ">
                                    <label class="mb-2"> @lang('Site Title')</label>
                                    <input class="form--control w-100" type="text" name="site_name" required
                                        value="{{ $general->site_name }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group ">
                                    <label class="mb-2">@lang('Currency')</label>
                                    <input class="form--control w-100" type="text" name="cur_text" required
                                        value="{{ $general->cur_text }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group ">
                                    <label class="mb-2">@lang('Currency Symbol')</label>
                                    <input class="form--control w-100" type="text" name="cur_sym" required
                                        value="{{ $general->cur_sym }}">
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-md-6">
                                <label class="mb-2"> @lang('Timezone')</label>
                                <select class="form--control w-100 select2-basic" name="timezone">
                                    @foreach ($timezones as $key => $timezone)
                                        <option value="{{ @$key }}">{{ __($timezone) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="mb-2"> @lang('Site Base Color')</label>
                                <div class="input-group input-group-text-color">
                                    <span class="input-group-text">
                                        <input type='text' class="colorPicker" value="{{ $general->base_color }}">
                                    </span>
                                    <input type="text" class="color-input form--control w-100 colorCode"
                                        name="base_color" value="{{ $general->base_color }}">
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-md-6">
                                <label class="mb-2"> @lang('Date Format')</label>
                                <select name="date_format" class="form--control w-100 select form-select">
                                    <option {{ $general->date_format == 'mm-dd-yyyy' ? 'selected' : '' }}
                                        value="mm-dd-yyyy">@lang('MM-DD-YYYY')</option>
                                    <option {{ $general->date_format == 'dd-mm-yyyy' ? 'selected' : '' }}
                                        value="dd-mm-yyyy">@lang('DD-MM-YYYY')</option>
                                    <option {{ $general->date_format == 'yyyy-mm-dd' ? 'selected' : '' }}
                                        value="yyyy-mm-dd">@lang('YYYY-MM-DD')</option>
                                </select>
                            </div>


                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('style')
    <style>
        .input-group-text-color .input-group-text {
            padding: 0;
            border: 0;
            background: transparent !important;
            border: none !important;
        }

        .input-group-text-color .sp-replacer.sp-light {
            border: 0;
            padding: 0;
            border-radius: 0;
        }

        .input-group-text-color .sp-replacer.sp-light .sp-preview {
            height: 48px;
            margin-right: 4px;
            border-radius: 4px;
            width: 105px;
            border: none
        }

        .sp-preview-inner, .sp-alpha-inner, .sp-thumb-inner{
            border-radius: 4px;
        }

        .input-group-text-color .sp-replacer{
            background: transparent !important;
        }
        .input-group-text-color .sp-replacer.sp-light .sp-dd {
            display: none;
        }

    </style>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function (color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function () {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("{{ $currentTimezone }}").select2();

        })(jQuery);

    </script>



@endpush


