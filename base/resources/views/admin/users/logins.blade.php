@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">

        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="card-body p-0">
                    <div class="table-wrap">
                        <table class="table table--responsive--xl table-hover">
                            <thead>
                            <tr>
                                <th class="text--left">@lang('User')</th>
                                <th>@lang('Login at')</th>
                                <th>@lang('IP')</th>
                                <th>@lang('City | Country')</th>
                                <th>@lang('Browser | OS')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($loginLogs as $log)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img class="thumb rounded-circle" src="{{ getImage(getFilePath('userProfile').'/'. @$log->user->image,getFileSize('userProfile')) }}" alt="@lang('Profile Image')">
                                            </div>

                                            <div class="small text--left">
                                                <h6 class="mb-0">{{ @$log->user->fullname }}</h6>
                                                <a class="text-base link-underline-primary" href="{{ route('admin.users.detail', @$log->user->id) }}"><span>@</span>{{ @$log->user->username }}</a>
                                            </div>
                                        </div>

                                    </td>

                                    <td data-label="@lang('Login at')">
                                        <div class="d-flex flex-column">
                                            <span class="me-2">{{showDateTime($log->created_at) }}</span>
                                            <span>{{diffForHumans($log->created_at) }}</span>
                                        </div>
                                    </td>

                                    <td data-label="@lang('IP')">
                                        <span class="fw-bold">
                                            <a href="{{route('admin.report.login.ipHistory',[$log->user_ip])}}">{{ $log->user_ip }}</a>
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
                                    <td data-label="@lang('Action')">
                                        <div class="button--group">
                                            <a  title="@lang('IP Search')" href="https://www.ip2location.com/{{ $log->user_ip }}" target="_blank" class="btn btn--sm btn-outline-base">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="6">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if($loginLogs->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($loginLogs) }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

