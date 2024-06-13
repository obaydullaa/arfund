@php
    $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
@endphp
@if(($cookie->data_values->status == Status::ENABLE) && !\Cookie::get('gdpr_cookie'))
    <div class="cookies-card text-center hide">
        <div class="cookies-card__icon ">
            <i class="fa fa-cookie-bite"></i>
        </div>
        <p class="content--wrap text-center">{{ $cookie->data_values->short_desc }}
            <a class="text--base" href="{{ route('cookie.policy') }}" >@lang('learn more')</a></p>
        <div class="btn--wrap mt-4">
            <a href="javascript:void(0)" class="btn btn--base w-100 policy">
                @lang('Allow')
            </a>
        </div>
    </div>
@endif