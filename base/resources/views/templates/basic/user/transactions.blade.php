@extends($activeTemplate.'layouts.master')
@section('content')

<div class="dashboard-card-wrap">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="show-filter mb-3 text-end">
                <button type="button" class="btn btn--base showFilterBtn btn-sm">
                    <i class="las la-filter"></i> @lang('Filter')
                </button>
            </div>
            <div class="responsive-filter-card mb-4">
                <form action="">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Transaction Number')</label>
                            <input type="text" name="search" value="{{ request()->search }}" class="form-control form--control">
                        </div>
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Type')</label>
                            <select name="trx_type" class="form-select form--control">
                                <option value="">@lang('All')</option>
                                <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form--label">@lang('Remark')</label>
                            <select class="form-select form--control" name="remark">
                                <option value="">@lang('Any')</option>
                                @foreach($remarks as $remark)
                                <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1 align-self-end">
                            <button class="btn btn-primary w-100"><i class="las la-filter"></i> @lang('Filter')</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table--responsive--lg">
                <thead>
                    <tr>
                        <th>@lang('Trx')</th>
                        <th>@lang('Transacted')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Post Balance')</th>
                        <th>@lang('Detail')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td>
                            <strong>{{ $trx->trx }}</strong>
                        </td>

                        <td>
                            {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                        </td>

                        <td class="budget">
                            <span class="fw-bold @if($trx->trx_type == '+')text-success @else text-danger @endif">
                                {{ $trx->trx_type }} {{showAmount($trx->amount)}} {{ $general->cur_text }}
                            </span>
                        </td>

                        <td class="budget">
                        {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
                    </td>


                    <td>{{ __($trx->details) }}</td>
                </tr>
                @empty
                <tr>
                    <td class="text-muted text-center" colspan="5">{{ __($emptyMessage) }}</td>
                </tr>
                @endforelse
                </tbody>
            </table>
            @if($transactions->hasPages())
            <div class="card-footer">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection