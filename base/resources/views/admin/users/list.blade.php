@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two responsive-filter-card">
                <form method="get">
                    @csrf
                    <div class="row gy-4 align-items-center">
                        <div class="col-lg-9 col-md-9">
                            <div class="row gy-4">
                                <div class="col-lg-6 col-md-4">
                                    <input type="text" name="search" value="{{ old('search', request()->search) }}"
                                        class="form--control w-100" placeholder="@lang('Username / Email / Mobile')">
                                </div>
                                <div class="col-lg-6 col-md-8">
                                    <div class="input-wrapper position-relative">
                                        <div class="input-group ">
                                            <select name="search_date" class="form--control w-100 select form-select">
                                                <option selected disabled>@lang('Filter with Date')</option>
                                                <option {{ request()->input('search_date') == 'today' ? 'selected' : '' }}
                                                    value="today">
                                                    @lang('Today')</option>
                                                <option
                                                    {{ request()->input('search_date') == 'yesterday' ? 'selected' : '' }}
                                                    value="yesterday">
                                                    @lang('Yesterday')</option>
                                                <option
                                                    {{ request()->input('search_date') == 'last_week' ? 'selected' : '' }}
                                                    value="last_week">
                                                    @lang('Last Week')</option>
                                                <option
                                                    {{ request()->input('search_date') == 'this_week' ? 'selected' : '' }}
                                                    value="this_week">
                                                    @lang('This Week')</option>
                                                <option
                                                    {{ request()->input('search_date') == 'this_month' ? 'selected' : '' }}
                                                    value="this_month">
                                                    @lang('This Month')</option>
                                                <option
                                                    {{ request()->input('search_date') == 'last_month' ? 'selected' : '' }}
                                                    value="last_month">
                                                    @lang('Last Month')</option>
                                                <option
                                                    {{ request()->input('search_date') == 'custom_date' ? 'selected' : '' }}
                                                    value="custom_date">@lang('Custom Date')</option>
                                            </select>
                                        </div>
                                        <div class="custom-date customdate_range d-none">
                                            <input class="datepicker-here form--control br-left--0  bg-white pe-2"
                                                name="date_range" type="search" data-range="true"
                                                data-multiple-dates-separator=" - " data-language="en"
                                                data-format="{{ $general->date_format }}" data-position='bottom right'
                                                placeholder="@lang('Start Date - End Date')" autocomplete="off"
                                                value="{{ request()->date_range }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="text-end">
                                <button type="submit" class="btn btn--global btn-outline--global w-100">
                                    <i class="fas fa-search"></i>
                                    @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Phone')</th>
                                <th>@lang('Country')</th>
                                <th>@lang('Joined')</th>
                                <th>@lang('Balance')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img class="thumb rounded-circle" src="{{ getImage(getFilePath('userProfile') . '/' . @$user->image, getFileSize('userProfile')) }}" alt="@lang('Profile Image')">
                                            </div>
                                            <div class="small">
                                                <h6 class="mb-0">{{ $user->fullname }}</h6>
                                                <a class="text-base link-underline-primary" href="{{ route('admin.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Email')">
                                        <span>
                                            {{ $user->email }}
                                        </span>
                                    </td>
                                    <td data-label="@lang('Phone')">
                                        {{ $user->mobile }}
                                    </td>
                                    <td data-label="@lang('Country')">
                                        <span class="fw-medium"
                                            title="{{ @$user->address->country }}">{{ $user->country_code }}</span>
                                    </td>
                                    <td data-label="@lang('Joined')">
                                        {{ showDateTime($user->created_at) }}
                                        <br>
                                        {{ diffForHumans($user->created_at) }}
                                    </td>
                                    <td data-label="@lang('Balance')">
                                        <span class="fw-medium">
                                            {{ $general->cur_sym }}{{ showAmount($user->balance) }}
                                        </span>
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <div class="button--group">
                                            <a data-bs-toggle="tooltip" data-bs-title="@lang('Details')"
                                                href="{{ route('admin.users.detail', $user->id) }}"
                                                class="btn btn--sm btn-outline-base">
                                                <i class="fa-solid fa-display"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{ $pageTitle }}" class="text-muted text-center" colspan="7">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if ($users->hasPages())
                        <div class="py-4">
                            {{ paginateLinks($users) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.dashboard') }}" />
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('select[name="search_date"]').on('click',function() {
                var selectedOption = $(this).val();
                if (selectedOption == 'custom_date') {
                    $('.customdate_range').removeClass('d-none');
                    $('.without_custom_date').addClass('d-none');
                    $('input[name="date_range"]').prop('required', true);
                    var currentDate = new Date().toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit'
                    });
                    $('input[name="date_range"]').val(currentDate + ' - ' + currentDate);
                } else {
                    $('.customdate_range').addClass('d-none');
                    $('.without_custom_date').removeClass('d-none');
                    $('input[name="date_range"]').prop('required', false);
                }
            });
            var perviousDateType = $('select[name="search_date"]').val();
            if(perviousDateType == 'custom_date')
            {
                $('.customdate_range').removeClass('d-none');
                $('.without_custom_date').addClass('d-none');
            }
        })(jQuery);
    </script>
@endpush