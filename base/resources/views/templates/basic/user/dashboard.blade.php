@extends($activeTemplate . 'layouts.master')
@section('content')

    @if ($general->kv && (auth()->user()->kv == 0 || auth()->user()->kv == 2))
        @if (auth()->user()->kv == 0)
        <div class="kyc-noty d-flex justify-content-between align-items-center dashboard-card-wrap" role="alert">
            <h4 class="alert-heading">@lang('KYC Verification required')</h4>
            <hr>
            <p class="mb-0">
                <a href="{{ route('user.kyc.form') }}" class="btn btn--base">
                    @lang('Click  Here to Verify')
                </a>
            </p>
        </div>
        @else
        <div class="kyc-noty d-flex justify-content-between align-items-center dashboard-card-wrap" role="alert">
            <h5 class="alert-heading">@lang('Your KYC is under review')</h5>
            <hr>
            <h5 class="text-warning">@lang('An admin will review and approve your KYC shortly.')</h5>
        </div>
        @endif
    @endif

    <div class="row gy-4">
        <div class="col-xl-12 col-lg-12">
            <!-- =========== Card Item Start Here =========== -->
            <div class="row gy-4 justify-content-center mb-4">    
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper bg--base">
                        <a class="link-href" href="{{ route('user.campaign.all') }}"></a>
                        <h4 class="contact-title">@lang('All Campaign')</h4>
                        <div class="single-info">
                            <div class="cont-icon">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $campaign['allCampaign'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper bg--success">
                        <a class="link-href" href="{{ route('user.campaign.success') }}"></a>
                        <h4 class="contact-title">@lang('Completed Campaign')</h4>
                        <div class="single-info">
                            <div class="cont-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $campaign['completed'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper bg--danger">
                        <a class="link-href" href="{{ route('user.campaign.pending') }}"></a>
                        <h4 class="contact-title">@lang('Pending Campaign')</h4>
                        <div class="single-info">
                            <div class="cont-icon">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $campaign['pending'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper bg--info">
                        <a class="link-href" href="{{ route('user.campaign.rejected') }}"></a>
                        <h4 class="contact-title">@lang('Rejected Campaign')</h4>
                        <div class="single-info">
                            <div class="cont-icon">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $campaign['rejected'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper two bg-outline--primary">
                        <h4 class="contact-title">@lang('Current Balance')</h4>
                        <div class="single-info">
                            <div class="cont-icon card-warning">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                            <div class="cont-text">
                                <h6>
                                    {{ $general->cur_sym }}{{ showAmount($campaign['currentBalance']) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper two bg-outline--success">
                        <a class="link-href" href="{{ route('user.withdraw.history') }}"></a>
                        <h4 class="contact-title">@lang('Withdrawal Amount')</h4>
                        <div class="single-info">
                            <div class="cont-icon card-warning">
                                <i class="fa-solid fa-list"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $general->cur_sym }}{{ showAmount($campaign['withdraw']) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper two bg-outline--dark">
                        <a class="link-href" href="{{ route('user.campaign.donation.received') }}"></a>
                        <h4 class="contact-title">@lang('Received Donation')</h4>
                        <div class="single-info">
                            <div class="cont-icon card-warning">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $general->cur_sym }}{{ showAmount($campaign['received_donation']) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_wrapper two bg-outline--base">
                        <a class="link-href" href="{{ route('user.campaign.donation.my') }}"></a>
                        <h4 class="contact-title">@lang('My Donation')</h4>
                        <div class="single-info">
                            <div class="cont-icon card-warning">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                            <div class="cont-text">
                                <h6>{{ $general->cur_sym }}{{ showAmount($campaign['my_donation']) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========== Card Item Start Here =========== -->
        </div>
    </div>

    {{-- Deposit Withdraw and Transaction Report Start --}}
    <div class="row gy-4  mb-5">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xl-6">
                    <div class="my-4">
                        <h5 class="card-title">@lang('Monthly Donation Report (12 Months)')</h5>
                    </div>
                    <div class="card-two">
                        <div id="donation-chart"></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="my-4">
                        <h5 class="card-title">@lang('Monthly Withdraw Report (12 Months)')</h5>
                    </div>
                    <div class="card-two">
                        <div id="withdraw-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Deposit Withdraw and Transaction Report End --}}
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/chart.js.2.8.0.js') }}"></script>
@endpush
@push('script')
    <script src="{{ asset('assets/admin/js/apexcharts.min.js') }}"></script>
    <script>
        "use strict";
        (function() {
            var options = {
                chart: {
                    type: 'bar',
                    stacked: false,
                    height: '310px',
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#373d3f', '#3366FF'],
                    }
                },
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                colors: ['{{ $chartColor }}', '{{ $chartColor }}'],
                series: [{
                    name: '@lang('Donations')',
                    type: 'area',
                    data: @json($donationChart['values'])
                }],
                fill: {
                    opacity: [0.85, 1],
                },
                labels: @json($donationChart['labels']),
                markers: {
                    size: 0
                },
                xaxis: {
                    type: 'text'
                },
                yaxis: {
                    min: 0
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return "$ " + y.toFixed(0);
                            }
                            return y;
                        }
                    }
                },
                legend: {
                    labels: {
                        useSeriesColors: true
                    },
                    markers: {
                        customHTML: [
                            function() {
                                return ''
                            },
                            function() {
                                return ''
                            }
                        ]
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#donation-chart"),
                options
            );
            chart.render();

            var withdrawOptions = {
                chart: {
                    type: 'bar',
                    stacked: false,
                    height: '310px',
                    toolbar: {
                        show: false
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#373d3f', '#3366FF'],
                        }
                    },
                    zoom: {
                        enabled: true,
                        type: 'x',  
                        autoScaleYaxis: true,  
                        zoomedArea: {
                            fill: {
                            color: '#90CAF9',
                            opacity: 0.4
                            },
                            stroke: {
                            color: '#0D47A1',
                            opacity: 0.4,
                            width: 1
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#373d3f', '#3366FF'],
                    }
                },
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                colors: ['{{ $chartColor }}', '{{ $chartColor }}'],
                series: [{
                    name: '@lang('Withdrawls')',
                    type: 'area',
                    data: @json($withdrawlsChart['values'])
                }],
                fill: {
                    opacity: [0.85, 1],
                },
                labels: @json($withdrawlsChart['labels']),
                markers: {
                    size: 0
                },
                xaxis: {
                    type: 'text'
                },
                yaxis: {
                    min: 0
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return "$ " + y.toFixed(0);
                            }
                            return y;
                        }
                    }
                },
                legend: {
                    labels: {
                        useSeriesColors: true
                    },
                    markers: {
                        customHTML: [
                            function() {
                                return ''
                            },
                            function() {
                                return ''
                            }
                        ]
                    }
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#withdraw-chart"),
                withdrawOptions
            );
            chart.render();

        })();
    </script>
@endpush