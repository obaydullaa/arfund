@extends('admin.layouts.app')

@section('panel')
<div class="row gy-4   mb-5 justify-content-center">
    @if(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method'))
        <div class="col-xxl-3 col-sm-6">
            <a href="{{ route('admin.withdraw.approved') }}">
                <div class="card--main-success card-shape">
                    <div class="content-wrap">
                        <div class="content">
                            <h3 class="card-title">@lang('Approved Withdrawals')</h3>
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
            <a href="{{ route('admin.withdraw.pending') }}">
                <div class="card--main-warning card-shape">
                    <div class="content-wrap">
                        <div class="content">
                            <h3 class="card-title">@lang('Pending Withdrawals')</h3>
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
            <a href="{{ route('admin.withdraw.rejected') }}">
                <div class="card--main-danger card-shape">
                    <div class="content-wrap">
                        <div class="content">
                            <h3 class="card-title">@lang('Rejected Withdrawals')</h3>
                            <span class="icon-wrap">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </span>
                        </div>
                        <h2 class="card-subtitle mb-2">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                    </div>
                    <span class="btn btn--global text-white w-100">@lang('View All')</span>
                </div>
            </a>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <a href="{{ route('admin.withdraw.log') }}">
            <div class="card--main card-shape">
                <div class="content-wrap">
                    <div class="content">
                        <h3 class="card-title">@lang('Withdraw Charge')</h3>
                        <span class="icon-wrap">
                            <i class="fa-solid fa-percent"></i>
                        </span>
                    </div>
                    <h2 class="card-subtitle mb-2">{{ __($general->cur_sym) }}{{ showAmount(@$initiated) }}</h2>
                </div>
                <span class="btn btn--global text-white w-100">@lang('View All')</span>
            </div>
        </a>
        </div>

    @endif

    <div class="col-lg-12 mt-3">
        <div class="d-flex flex-wrap justify-content-start">
            <x-search-form dateSearch='yes' />
        </div>
    </div>

    <div class="col-lg-12">

            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Gateway | Transaction')</th>
                                <th>@lang('Date & Time')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Conversion')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $withdraw)
                            @php
                            $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                            @endphp
                            <tr>
                                <td data-label="@lang('User')">
                                    <div class="user-info">
                                        <div class="user-img">
                                            <img class="thumb rounded-circle"
                                                src="{{ getImage(getFilePath('userProfile').'/'. @$withdraw->user->image,getFileSize('userProfile')) }}"
                                                alt="@lang('Profile Image')">
                                        </div>

                                        <div class="small text--left">
                                            <h6 class="mb-0">{{ @$withdraw->user->fullname }}</h6>
                                            <a class="text-base link-underline-primary"
                                                href="{{ route('admin.users.detail', @$withdraw->user->id) }}"><span>@</span>{{ @$withdraw->user->username }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="@lang('Gateway | Transaction')">
                                    <div class="d-flex flex-nowrap">
                                        <span class="me-2">
                                            <a href="{{ appendQuery('method',@$withdraw->method->id) }}"> {{ __(@$withdraw->method->name) }}</a>
                                            <br>
                                            <small>{{ $withdraw->trx }}</small>
                                        </span>

                                    </div>
                                </td>
                                <td data-label="@lang('Date & Time')">
                                    {{ showDateTime($withdraw->created_at) }} <br>  {{ diffForHumans($withdraw->created_at) }}
                                </td>
                                <td data-label="@lang('Amount')">
                                    <div class="d-flex flex-nowrap justify-content-center">
                                       <p>
                                        {{ __($general->cur_sym) }}{{ showAmount($withdraw->amount ) }} - <span class="text-danger" title="@lang('charge')">{{ showAmount($withdraw->charge)}} </span>
                                       </p>
                                        <br>
                                        <strong class="ms-2" title="@lang('Amount after charge')">
                                        {{ showAmount($withdraw->amount-$withdraw->charge) }} {{ __($general->cur_text) }}
                                        </strong>
                                    </div>
                                </td>

                                <td data-label="@lang('Conversion')">
                                    <div class="d-flex flex-nowrap justify-content-center">
                                        1 {{ __($general->cur_text) }} =  {{ showAmount($withdraw->rate) }} {{ __($withdraw->currency) }}
                                        <br>
                                        <strong class="ms-2">{{ showAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }}</strong>
                                    </div>
                                </td>

                                <td data-label="@lang('Status')">
                                    @php echo $withdraw->statusBadge @endphp
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.withdraw.details', $withdraw->id) }}" class="btn btn--sm btn-outline-base ms-1">
                                        <i class="fa-solid fa-display"></i>
                                    </a>
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
            @if ($withdrawals->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($withdrawals) }}
            </div>
            @endif

    </div>
</div>

@endsection




