@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4  mb-5">
        <div class="col-lg-7 col-md-10">
            <x-search-form dateSearch='yes' />
        </div>
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--lg table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Trx') | @lang('Campaign Title')</th>
                                <th>@lang('Donor') | @lang('Country')</th>
                                <th>@lang('Email') | @lang('Mobile')</th>
                                <th>@lang('Donation')</th>
                                <th>@lang('Payment Method')</th>
                                <th>@lang('Donation Date')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr>
                                    <td data-label="@lang('Trx') | @lang('Campaign Title')">
                                        <a class="d-block"
                                            href="{{ route('admin.campaign.details', $donation->campaign_id) }}">
                                            {{ strLimit(@$donation->campaign->title, 25) }}
                                        </a>
                                        {{ @$donation->deposit->trx }}
                                    </td>
                                    <td data-label="data-label="@lang('Donor') | @lang('Country')""><span
                                            class="d-block fw-bold">{{ __($donation->fullname) }}</span>
                                        {{ $donation->country }}
                                    </td>
                                    <td data-label="@lang('Email') | @lang('Mobile')">{{ $donation->email }} <br />
                                        {{ $donation->mobile }}
                                    </td>
                                    <td data-label="@lang('Donation')">
                                        <span class="fw-bold">{{ $general->cur_sym }}{{ showAmount($donation->donation) }}</span>
                                    </td>
                                    <td data-label="@lang('Payment Method')">{{ @$donation->deposit->gateway->alias }}</td>
                                    <td data-label="@lang('Donation Date')"><span
                                            class="d-block">{{ showDateTime($donation->created_at) }}</span>
                                        {{ diffForHumans($donation->created_at) }}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.campaign.details', $donation->campaign_id) }}"
                                            class="btn btn--sm btn-outline-base">
                                            <i class="fas fa-desktop"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if ($donations->hasPages())
            <div class="card-footer py-4">
                    @php echo paginateLinks($donations) @endphp
                </div>
            @endif
        </div>
    </div>
@endsection