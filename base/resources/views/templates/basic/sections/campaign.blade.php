@php
    $campaign = getContent('campaign.content', true);
    $campaigns = App\Models\Campaign::where('stop', Status::NO)->where('status', Status::ENABLE)->where('completed', Status::NO)->notExpired()->latest()->take(8)->get();
@endphp

<!--============ Campaign Start ============-->
<section class="campaign-area section-bg py-120">
    <img class="campaign-bg animate-x-axis" src="{{asset($activeTemplateTrue . 'images/campaign/campaign-bg.png')}}" alt="@lang('image')">
    <div class="container"> 
        <div class="row justify-content-center text-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{__($campaign->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($campaign->data_values->subheading)}}</span>
                    <h2 class="title-one">{{__($campaign->data_values->heading)}}</h2>
                    <p class="desc">{{__($campaign->data_values->description)}}</p>
                 </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row campaign-slider-active justify-content-center">
            @include($activeTemplate.'partials.campaign')
        </div>
    </div>
</section>
<!--============ Campaign End ===========-->