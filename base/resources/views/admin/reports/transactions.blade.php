@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">

        <div class="col-lg-12">
            <div class="show-filter d-flex flex-row flex-wrap gap-3 justify-content-between align-items-center mb-4">
                <h4 class="mb-0">{{ $pageTitle }}</h4>
                <button type="button" class="btn btn--global btn--outline-global showFilterBtn text-end"><i
                        class="fa-solid fa-filter"></i> @lang('Filter')</button>
            </div>
            <div class="card-two responsive-filter-card mb-4">
                <div class="card-body">
                    <form>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label class="mb-2">@lang('TRX/Username')</label>
                                <input type="text" name="search" value="{{ request()->search }}"
                                    class="form--control w-100">
                            </div>
                            <div class="flex-grow-1">
                                <label class="mb-2">@lang('Type')</label>
                                <select name="trx_type" class="form--control w-100 select form-select form--select">
                                    <option value="">@lang('All')</option>
                                    <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                    <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label class="mb-2">@lang('Remark')</label>
                                <select class="form--control select form-select w-100 form--select" name="remark">
                                    <option value="">@lang('Any')</option>
                                    @foreach ($remarks as $remark)
                                        <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                            {{ __(keyToTitle($remark->remark)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label class="mb-2">@lang('Date')</label>
                                <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - "
                                    data-language="en" class="datepicker-here form--control w-100"
                                    data-format="{{ $general->date_format }}" data-position='bottom right'
                                    placeholder="@lang('Start date - End date')" autocomplete="off" value="{{ request()->date }}">
                            </div>
                            <div class="flex-grow-1 align-self-end">
                                <button class="btn w-100  btn--global btn-outline-global"><i
                                        class="fa-solid fa-magnifying-glass"></i>
                                    @lang('Search')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th class="text--left">@lang('User')</th>
                                <th>@lang('TRX')</th>
                                <th>@lang('Transaction Date Time')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img class="thumb rounded-circle"
                                                    src="{{ getImage(getFilePath('userProfile') . '/' . @$trx->user->image, getFileSize('userProfile')) }}"
                                                    alt="@lang('Profile Image')">
                                            </div>

                                            <div class="small text--left">
                                                <h6 class="mb-0">{{ @$trx->user->fullname }}</h6>
                                                @if (isset($trx->user))
                                                    <a class="text-base link-underline-primary"
                                                        href="{{ route('admin.users.detail', $trx->user->id) }}"><span>@</span>{{ $trx->user->username }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td data-label="@lang('TRX')">
                                        <strong>{{ $trx->trx }}</strong>
                                    </td>

                                    <td data-label="@lang('Transaction Date Time')">
                                        {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                    </td>

                                    <td data-label="@lang('Amount')">
                                        <span
                                            class="fw-bold @if ($trx->trx_type == '+') text-success @else text-danger @endif">
                                            {{ $trx->trx_type }} {{ showAmount($trx->amount) }} {{ $general->cur_text }}
                                        </span>
                                    </td>

                                    <td data-label="@lang('Post Balance')">
                                        {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
                                    </td>

                                    <td data-label="@lang('Details')">{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{ $pageTitle }}" class="text-muted text-center" colspan="6">
                                        {{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="row">
                        @if ($transactions->hasPages())
                            <div class="col-lg-12">
                                {{ paginateLinks($transactions) }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/datepicker.min.css') }}">
@endpush


@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });
        })(jQuery)
    </script>
@endpush
