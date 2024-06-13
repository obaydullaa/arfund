@extends($activeTemplate . 'layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="dashboard-card-wrap custom--shadow">
            <h4 class="title-two text-center mb-3">
                @lang('Details of Donor'): {{ $donor->fullname }}
            </h4>
            <div class="donner-card">
                <div class="donner-card__item">
                    <h3 class="title-three" >@lang('Campaign Title') : </h3>
                    <p>
                        <a href="{{ route('user.campaign.view', ['slug' => $donor->campaign->slug, 'id' => $donor->campaign->id]) }}"
                            title="@lang('Details')">{{ __($donor->campaign->title) }}
                        </a>
                    </p>
                </div>
                <div class="donner-card__item">
                    <h3 class="title-three">@lang('Full Name') : </h3>
                    <p>{{ __($donor->fullname) }}</p>
                </div>
                <div class="donner-card__item">
                    <h3 class="title-three">@lang('Email') : </h3>
                    <p>{{ $donor->email }}</p>
                </div>
                <div class="donner-card__item">
                    <h3 class="title-three">@lang('Country') : </h3>
                    <p>{{ $donor->country }}</p>
                </div>
                <div class="donner-card__item">
                    <h3 class="title-three">@lang('Mobile') : </h3>
                    <p>{{ $donor->mobile }}</p>
                </div>
                <div class="donner-card__item">
                    <h3 class="title-three">@lang('Amount') : </h3>
                    <p>{{ $general->cur_sym }}{{ showAmount($donor->donation, 2) }}</p>
                </div>
                    <div class="donner-card__item">
                    <h3 class="title-three">@lang('Payment Method') : </h3>
                    <p>{{ @$donor->deposit->gateway->alias }}</p>
                </div>
                <div class="donner-card__item">
                    <h3 class="title-three">@lang('Payment Date') : </h3>
                    <p>{{ showDateTime(@$donor->deposit->created_at )}} ( {{ diffForHumans(@$donor->deposit->created_at )}})</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection