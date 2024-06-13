@extends('admin.layouts.app')
@section('panel')
    {{-- Dashboard Card Start --}}
    <div class="row gy-4   mb-5">
        {{-- User Card Start --}}
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.users.all') }}">
                <div class="wizard-one wizard-one--main">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Total Users')</h6>

                        <div class="icon-wrap">
                            <i class="fa-solid fa-users"></i>

                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $widget['total_users'] }}</h6>
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.users.email.verified')}}">
                <div class="wizard-one wizard-one--success">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Verified Users')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $widget['verified_users'] }}</h6>
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.users.mobile.unverified') }}">
                <div class="wizard-one wizard-one--warning">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Mobile Unverified')</h6>

                        <div class="icon-wrap">
                            <i class="fa-solid fa-mobile-retro"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $widget['mobile_unverified_users'] }}</h6>
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.users.email.unverified') }}">
                <div class="wizard-one wizard-one--info">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Email Unverified')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-envelope-open"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $widget['email_unverified_users'] }}</h6>
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- User Card End --}}

        {{-- Campaign Card Data Start  --}}
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.campaign.index') }}">
                <div class="wizard-one card-two-style wizard-one--success">
                    <div class="content-wrap">
                        <h6 class="title">@lang('All Campaign')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                    </div>
                    <div class="header-wrap">
                        <h6 class="amount">{{ $campaigns['all_campaign'] }}</h6>
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.campaign.running') }}">
                <div class="wizard-one card-two-style wizard-one--info">
                    <div class="content-wrap">
                        <h6 class="title">@lang('Campaign Running')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-person-running"></i>
                        </div>
                    </div>
                    <div class="header-wrap">
                        <h6 class="amount">{{ $campaigns['running'] }}</h6>
                      
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.campaign.pending') }}">
                <div class="wizard-one card-two-style wizard-one--danger">
                    <div class="content-wrap">  
                        <h6 class="title">@lang('Campaign Pending')</h6>     
                        <div class="icon-wrap">
                            <i class="fa-solid fa-spinner"></i>
                        </div>
                    </div>
                    <div class="header-wrap"> 
                        <h6 class="amount">{{ $campaigns['pending'] }}</h6> 
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.campaign.rejected') }}">
                <div class="wizard-one card-two-style wizard-one--main">
                    <div class="content-wrap">
                        <h6 class="title">@lang('Campaign Rejected')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    <div class="header-wrap">
                        <h6 class="amount">{{ $campaigns['rejected'] }}</h6>
                        <div class="button-wrap">
                            <span class="wz-btn">@lang('View All')</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- Campaign Card Data End  --}}

        {{-- Deposit Card Start --}}
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.deposit.list') }}">
                <div class="wizard-two wizard-outline--success">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Total Deposit')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($deposit['total_deposit_amount']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-money-bill"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.deposit.pending') }}">
                <div class="wizard-two wizard-outline--warning">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Pending Deposit')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($deposit['total_deposit_pending']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.deposit.rejected') }}">
                <div class="wizard-two wizard-outline--danger">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Rejected Deposit')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-ban"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($deposit['total_deposit_rejected']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-ban"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.deposit.list') }}">
                <div class="wizard-two wizard-outline--info">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Deposit Charge')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($deposit['total_deposit_charge']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Deposit Card End --}}


        {{-- Withdraw Card Start --}}
        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.withdraw.log') }}">
                <div class="wizard-two wizard-two-solid--success">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Total Withdraw')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($withdrawals['total_withdraw_amount']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.withdraw.pending') }}">
                <div class="wizard-two wizard-two-solid--warning">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Pending Withdraw')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-arrow-rotate-right"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($withdrawals['total_withdraw_pending']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-arrow-rotate-right"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.withdraw.rejected') }}">
                <div class="wizard-two wizard-two-solid--danger">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Rejected Withdraw')</h6>
                        <div class="icon-wrap">
                            <i class="fa-brands fa-creative-commons-nc"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($withdrawals['total_withdraw_rejected']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-brands fa-creative-commons-nc"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('admin.withdraw.log') }}">
                <div class="wizard-two wizard-two-solid--info">
                    <div class="header-wrap">
                        <h6 class="title">@lang('Withdraw Charge')</h6>
                        <div class="icon-wrap">
                            <i class="fa-solid fa-percent"></i>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <h6 class="amount">{{ $general->cur_sym }}{{ showAmount($withdrawals['total_withdraw_charge']) }}</h6>
                        <span class="icon-bg">
                            <i class="fa-solid fa-percent"></i>
                        </span>
                        <div class="button-wrap">
                            <span class="wz-btn"><i class="fa-solid fa-arrow-up"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Withdraw Card End --}}

    </div>
    {{-- Dashboard Card End --}}



    {{-- Deposit Withdraw and Transaction Report Start --}}
    <div class="row gy-4  mb-5">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xl-6">
                    <div class="my-4">
                        <h5 class="card-title">@lang('Monthly Deposit & Withdraw Report (12 Months)')</h5>
                    </div>
                    <div class="card-two broder-0">
                        <div id="apex-bar-chart"> </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="my-4">
                        <h5 class="card-title">@lang('Transactions Report (30 Days)')</h5>
                    </div>
                    <div class="card-two">
                        <div id="apex-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Deposit Withdraw and Transaction Report End --}}

    {{-- Newly Registerd User Start --}}
    <div class="row gy-4  mb-5">
        <div class="col-lg-12 mt-3 mb-1">
            <h5 class="card-title">@lang('Latest Registered User')</h5>
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
                                <th>@lang('Joined At')</th>
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
                                                <img class="thumb rounded-circle"
                                                    src="{{ getImage(getFilePath('userProfile') . '/' . @$user->image, getFileSize('userProfile')) }}"
                                                    alt="@lang('Profile Image')">
                                            </div>

                                            <div class="small">
                                                <h6 class="mb-0">
                                                    {{ $user->firstname != null && $user->lastname != null ? $user->fullname : $user->username }}
                                                </h6>
                                                <a class="text-base link-underline-primary"
                                                    href="{{ route('admin.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Email')">
                                        {{ $user->email }}
                                    </td>

                                    <td data-label="@lang('Phone')">
                                        {{ $user->mobile }}
                                    </td>
                                    <td data-label="@lang('Country')">
                                        <span class="fw-medium"
                                            title="{{ @$user->address->country }}">{{ $user->country_code }}</span>
                                    </td>
                                    <td data-label="@lang('Join At')">
                                        {{ showDateTime($user->created_at) }} <br>
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
                                    <td data-label="@lang('Empty Message')" class="text-muted text-center" colspan="7">
                                        {{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Newly Registerd User End --}}


    {{-- Supprt Ticket Start --}}
    <div class="row gy-4  mb-5">
        <div class="col-lg-12 mt-3 mb-1">
            <h5 class="card-title">@lang('Support Message')</h5>
        </div>

        <div class="col-md-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Ticket')</th>
                                <th>@lang('Subject')</th>
                                <th>@lang('Submitted By')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Priority')</th>
                                <th>@lang('Last Reply')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $item)
                                <tr>
                                    <td data-label="@lang('Ticket')">
                                        <a href="{{ route('admin.ticket.view', $item->id) }}">
                                            #{{ $item->ticket }}
                                        </a>
                                    </td>
                                    <td data-label="@lang('Subject')">
                                        <span class="fw-bold">
                                            {{ strLimit($item->subject, 30) }}
                                        </span>
                                    </td>

                                    <td data-label="@lang('Submitted By')">
                                        <div class="d-flex flex-column">
                                            @if ($item->user_id)
                                                <a class="fw-bold" href="{{ route('admin.users.detail', $item->user_id) }}"> {{  ucwords(@$item->user->fullname) }}</a>
                                            @else
                                                <p class="fw-bold"> {{ ucwords(@$item->name) }}</p>
                                            @endif
                                            <span>{{ $item->email }}</span>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @php echo $item->statusBadge; @endphp
                                    </td>
                                    <td data-label="@lang('Priority')">
                                        @if ($item->priority == Status::PRIORITY_LOW)
                                            <span class="badge badge--primary">@lang('Low')</span>
                                        @elseif($item->priority == Status::PRIORITY_MEDIUM)
                                            <span class="badge  badge--warning">@lang('Medium')</span>
                                        @elseif($item->priority == Status::PRIORITY_HIGH)
                                            <span class="badge badge--danger">@lang('High')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Last Reply')">
                                        {{ diffForHumans($item->last_reply) }}
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.ticket.view', $item->id) }}"
                                            class="btn btn--sm btn-outline-base ms-1">
                                            <i class="fa-solid fa-display"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>

                                    <td class="text-muted text-center" colspan="7" data-label="@lang('Error Data')">
                                        {{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- Supprt Ticket End --}}
@endsection

@push('script')
    <script src="{{ asset('assets/admin/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/chart.js.2.8.0.js') }}"></script>
    <script>
        "use strict";
        var options = {
            series: [{
                name: 'Total Deposit',
                data: [
                    @foreach ($months as $month)
                        {{ getAmount(@$depositsMonth->where('months', $month)->first()->depositAmount) }},
                    @endforeach
                ]
            }, {
                name: 'Total Withdraw',
                data: [
                    @foreach ($months as $month)
                        {{ getAmount(@$withdrawalMonth->where('months', $month)->first()->withdrawAmount) }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'bar',
                height: 450,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($months),
            },
            yaxis: {
                title: {
                    text: "{{ __($general->cur_sym) }}",
                    style: {
                        color: '#2ea7b9'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "{{ __($general->cur_sym) }}" + val + " "
                    }
                }
            },
            colors: ['#FF5733', '#3366FF']
        };

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
        chart.render();



        var options = {
            colors: ['#FF5733', '#3366FF'],

            chart: {
                height: 450,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#FF5733', '#3366FF'],
                }
            },
            series: [{
                    name: "Plus Transactions",
                    data: [
                        @foreach ($trxReport['date'] as $trxDate)
                            {{ getAmount(@$plusTrx->where('date', $trxDate)->first()->amount ?? 0) }},
                        @endforeach
                    ]
                },
                {
                    name: "Minus Transactions",
                    data: [
                        @foreach ($trxReport['date'] as $trxDate)
                            {{ getAmount(@$minusTrx->where('date', $trxDate)->first()->amount ?? 0) }},
                        @endforeach
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                },
                colors: ['#FF5733', '#3366FF']
            },
            stroke: {
                curve: 'smooth',
                width: 2,
                colors: ['#FF5733', '#3366FF']
            },
            xaxis: {
                categories: [
                    @foreach ($trxReport['date'] as $trxDate)
                        "{{ $trxDate }}",
                    @endforeach
                ]
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        chart.render();
    </script>
@endpush

@push('style')
    <style>
        .apexcharts-legend .apexcharts-legend-series:nth-child(1) .apexcharts-legend-marker {
            background: #FF5733 !important;
            color: #FF5733 !important;
        }

        .apexcharts-legend .apexcharts-legend-series:nth-child(2) .apexcharts-legend-marker {
            background: #3366FF !important;
            color: #3366FF !important;
        }
    </style>
@endpush
