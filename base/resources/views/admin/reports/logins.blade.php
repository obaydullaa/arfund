@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Login at')</th>
                                <th>@lang('IP')</th>
                                <th>@lang('City | Country')</th>
                                <th>@lang('Browser | OS')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loginLogs as $log)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img class="thumb rounded-circle"
                                                    src="{{ getImage(getFilePath('userProfile').'/'. @$log->user->image,getFileSize('userProfile')) }}"
                                                    alt="@lang('Profile Image')">
                                            </div>

                                            <div class="small">
                                                <h6 class="mb-0">{{ @$log->user->fullname }}</h6>
                                                <a class="text-base link-underline-primary"
                                                    href="{{ route('admin.users.detail', @$log->user_id) }}"><span>@</span>{{ @$log->user->username }}</a>
                                            </div>
                                        </div>


                                    </td>
                                    <td data-label="@lang('Login at')">
                                        <div class="d-flex flex-column">
                                            <span>{{ showDateTime($log->created_at) }}</span>
                                            <span>{{ diffForHumans($log->created_at) }}</span>
                                        </div>
                                    </td>
                                    <td data-label="@lang('IP')">
                                        <span class="fw-bold">
                                            <a class="text-base hover-underline" href="{{ route('admin.report.login.ipHistory', [$log->user_ip]) }}">{{ $log->user_ip }}</a>
                                        </span>
                                    </td>
                                    <td data-label="@lang('City | Country')">
                                        <div class="d-flex flex-column">
                                            <span>{{ __($log->city) }}</span>
                                            <span>{{ __($log->country) }}</span>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Browser | OS')">
                                        <div class="d-flex flex-column">
                                            <span>{{ __($log->browser) }}</span>
                                            <span>{{ __($log->os) }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="5">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                @if ($loginLogs->hasPages())
                <div class="col-lg-12 mt-4">
                    {{ paginateLinks($loginLogs) }}
                </div>
                @endif
            </div>
        </div>


    </div>
@endsection



@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start">
        @if (request()->routeIs('admin.report.login.history'))
            <x-search-form placeholder="Enter Username" />
        @endif

        @if (request()->routeIs('admin.report.login.ipHistory'))
            <a href="https://www.ip2location.com/{{ $ip }}" target="_blank" class="btn btn--global btn--outline-global text-end">@lang('Lookup IP') {{ $ip }}</a>
        @endif
    </div>
@endpush

