@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-card-wrap mt-0">
                <div class="col-lg-12">
                    <div class="order-wrap">
                        <div class="table-responsive">
                            <table class="table table--responsive--lg">
                                <thead>
                                    <tr>
                                        <th>@lang('trx').</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Mobile')</th>
                                        <th>@lang('Country')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($donations as $item)
                                    <tr>
                                        <td data-label="@lang('trx')">{{ @$item->deposit->trx }}</td>
                                        <td data-label="@lang('name')">{{ __($item->fullname) }}</td>
                                        <td data-label="@lang('Email')">{{$item->email }}</td>
                                        <td data-label="@lang('Mobile')">{{$item->mobile}}</td>
                                        <td data-label="@lang('Country')">{{$item->country}}</td>
                                        <td data-label="@lang('Amount')">{{ $general->cur_sym }}{{ showAmount($item->donation) }}</td>
                                        <td data-label="@lang('Action')">
                                            <div class="div">
                                                <a class="table-btn table-btn--base" href="{{ route('user.campaign.donation.details', $item->id) }}"
                                                    title="Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">
                                            <p class="text-center"> {{ __($emptyMessage) }}</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($donations->hasPages())
                            <div class="pt-3">
                                {{ paginateLinks($donations) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection