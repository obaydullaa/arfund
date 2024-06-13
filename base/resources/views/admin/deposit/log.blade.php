@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5 justify-content-center">
        @if (request()->routeIs('admin.deposit.list') ||
                request()->routeIs('admin.deposit.method') ||
                request()->routeIs('admin.users.deposits') ||
                request()->routeIs('admin.users.deposits.method'))
            <div class="col-xxl-3 col-sm-6">
                <a href="{{ route('admin.deposit.successful') }}">
                    <div class="card--main-success card-shape">
                        <div class="content-wrap">
                            <div class="content">
                                <h3 class="card-title">@lang('Successful Deposit')</h3>
                                <span class="icon-wrap">
                                    <i class="fa-solid fa-wallet"></i>
                                </span>
                            </div>
                            <h2 class="card-subtitle mb-2">{{ __($general->cur_sym) }}{{ showAmount($successful) }}</h2>
                        </div>
                        <span class="btn btn--global text-white w-100">@lang('View All')</span>
                    </div>
                </a>
            </div>


            <div class="col-xxl-3 col-sm-6">
                <a href="{{ route('admin.deposit.pending') }}">


                    <div class="card--main-warning card-shape">
                        <div class="content-wrap">
                            <div class="content">
                                <h3 class="card-title">@lang('Pending Deposit')</h3>
                                <span class="icon-wrap">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                </span>
                            </div>
                            <h2 class="card-subtitle mb-2">{{ __($general->cur_sym) }}{{ showAmount($pending) }}</h2>
                        </div>
                        <span class="btn btn--global text-white w-100">@lang('View All')</span>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a href="{{ route('admin.deposit.rejected') }}">


                    <div class="card--main-danger card-shape">
                        <div class="content-wrap">
                            <div class="content">
                                <h3 class="card-title">@lang('Rejected Deposit')</h3>
                                <span class="icon-wrap">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                </span>
                            </div>
                            <h2 class="card-subtitle mb-2">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                        </div>
                        <span class="btn btn--global text-white w-100">@lang('View All')</span>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a href="{{ route('admin.deposit.initiated') }}">


                    <div class="card--main card-shape">
                        <div class="content-wrap">
                            <div class="content">
                                <h3 class="card-title">@lang('Initiated Deposit')</h3>
                                <span class="icon-wrap">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                </span>
                            </div>
                            <h2 class="card-subtitle mb-2">{{ __($general->cur_sym) }}{{ showAmount($initiated) }}</h2>
                        </div>
                        <span class="btn btn--global text-white w-100">@lang('View All')</span>
                    </div>
                </a>
            </div>
        @endif


        <div class="col-lg-12 mt-5 mb-1">
            <div class="d-flex flex-wrap gap-2 justify-content-start justify-content-md-start">
                @if (!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method'))
                    <x-search-form dateSearch='yes' />
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Donor')</th>
                                <th>@lang('Campaign Title')</th>
                                <th>@lang('Gateway | Transaction')</th>
                                <th>@lang('Date & Time')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Conversion')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deposits as $deposit)
                                @php
                                    $details = $deposit->detail ? json_encode($deposit->detail) : null;
                                @endphp
                                <tr>
                                    <td data-label="@lang('Doner')">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img class="thumb rounded-circle"
                                                    src="{{ getImage(getFilePath('userProfile') . '/' . @$deposit->user->image, getFileSize('userProfile')) }}"
                                                    alt="@lang('Profile Image')">
                                            </div>

                                            <div class="small text--left">
                                                @if ($deposit->user)
                                                    <h6 class="mb-0">{{ @$deposit->user->fullname }}</h6>
                                                    <a class="text-base link-underline-primary"
                                                        href="{{ route('admin.users.detail', @$deposit->user->id) }}"><span>@</span>{{ @$deposit->user->username }}</a>
                                                @else
                                                    <h6 class="mb-0">{{ @$deposit->donation->fullname }}</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td data-label="@lang('Campaign Title')">
                                        @if (isset($deposit->campaign))
                                            <a href="{{ route('admin.campaign.details', $deposit->campaign->id) }}"
                                                class="fw-bold">
                                                @if (strlen($deposit->campaign->title) > 30)
                                                    {{ substr($deposit->campaign->title, 0, 30) . '...' }}
                                                @else
                                                    {{ $deposit->campaign->title }}
                                                @endif
                                            </a>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Gateway | Transaction')">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">
                                                <a
                                                    href="{{ appendQuery('method', @$deposit->gateway->alias) }}">{{ __(@$deposit->gateway->name) }}</a>
                                            </span>

                                            <small> {{ $deposit->trx }} </small>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Date & Time')">
                                        {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                    </td>

                                    <td data-label="@lang('Amount')">
                                        <div class="d-flex flex-column">
                                            <p>
                                                {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }} +
                                                <span class="text-danger"
                                                    title="@lang('charge')">{{ showAmount($deposit->charge) }} </span>
                                            </p>
                                            <strong title="@lang('Amount with charge')">
                                                {{ showAmount($deposit->amount + $deposit->charge) }}
                                                {{ __($general->cur_text) }}
                                            </strong>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Conversion')">
                                        <div class="d-flex flex-column">
                                            <span>
                                                1 {{ __($general->cur_text) }} = {{ showAmount($deposit->rate) }}
                                                {{ __($deposit->method_currency) }}
                                            </span>

                                            <strong>
                                                {{ showAmount($deposit->final_amount) }}
                                                {{ __($deposit->method_currency) }}
                                            </strong>

                                        </div>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @php echo $deposit->statusBadge @endphp
                                    </td>
                                    <td data-label="@lang('Action')">

                                        <a href="{{ route('admin.deposit.details', $deposit->id) }}"
                                            class="btn btn--sm btn-outline-base ms-1">
                                            <i class="fa-solid fa-display"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{ $pageTitle }}" class="text-muted text-center" colspan="7">
                                        {{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($deposits->hasPages())
                <div class="card-footer py-4">
                    @php echo paginateLinks($deposits) @endphp
                </div>
            @endif
        </div>
    </div>
@endsection
