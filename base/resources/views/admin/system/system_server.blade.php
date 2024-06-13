@extends('admin.layouts.app')
@section('panel')

<div class="row gy-4   mb-5">
    <div class="col-md-12">
        <div class="row gy-4">
            <div class="col-xl-6">
                <div class="card-two">
                    <h4 class="card-title mb-5">@lang('Server information')</h4>

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span>
                                <img width="30" height="30" src="{{ asset('assets/admin/images/server_php.png') }}" alt="@lang('image')">
                                @lang('PHP Version')
                            </span>
                            <span class="px-2">{{ $currentPHP }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span>
                                <img width="30" height="30" src="{{ asset('assets/admin/images/server_software.png') }}" alt="@lang('image')">
                                @lang('Server Software')
                            </span>
                            <span class="px-2">{{ @$serverDetails['SERVER_SOFTWARE'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span>
                                <img width="30" height="30" src="{{ asset('assets/admin/images/server_ip.png') }}" alt="@lang('image')">
                                @lang('Server IP Address')
                            </span>
                            <span class="px-2">{{ @$serverDetails['SERVER_ADDR'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span>
                                <img width="30" height="30" src="{{ asset('assets/admin/images/server.png') }}" alt="@lang('image')">
                                @lang('Server Protocol')
                            </span>
                            <span class="px-2">{{ @$serverDetails['SERVER_PROTOCOL'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span>
                                <img width="30" height="30" src="{{ asset('assets/admin/images/server_http.png') }}" alt="@lang('image')">
                                @lang('HTTP Host')
                            </span>
                            <span class="px-2">{{ @$serverDetails['HTTP_HOST'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span>
                                <img width="30" height="30" src="{{ asset('assets/admin/images/server_port.png') }}" alt="@lang('image')">
                                @lang('Server Port')
                            </span>
                            <span class="px-2">{{ @$serverDetails['SERVER_PORT'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card-two">
                    <h4 class="card-title mb-5">@lang('System information')</h4>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <img width="25" height="25" src="{{ siteFavicon() }}" alt="@lang('image')">
                                {{ ucFirst(systemDetails()['name']) }} @lang('Version')
                            </span>
                            <span class="px-2">{{ systemDetails()['version'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <img width="25" height="25" src="{{ asset('assets/admin/images/laravel.png') }}" alt="@lang('image')">
                                @lang('Laravel Version')
                            </span>
                            <span class="px-2">{{ @$laravelVersion }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <img width="25" height="25" src="{{ asset('assets/admin/images/timezone.png') }}" alt="@lang('image')">
                                @lang('Timezone')
                            </span>

                            <span class="px-2">{{ @$timeZone }}</span>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection
