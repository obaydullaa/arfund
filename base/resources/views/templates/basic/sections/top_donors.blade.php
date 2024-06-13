@php
    $topDonorContent = getContent('top_donors.content', true);
    $topperDoner = App\Models\Donation::paid()->where('status', Status::ENABLE)->where('donation', '>', 0)->orderBy('donation', 'desc')->limit(12)->get();
@endphp

<!--============ Top Donner Start =============-->
<section class="category-area py-120 fix">
    <img class="donor-bg-img animate-x-axis" src="{{asset($activeTemplateTrue . 'images/donor/donor-bg-img.png')}}" alt="@lang('image')">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{__($topDonorContent->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($topDonorContent->data_values->subheading)}}</span>
                    <h2 class="title-one">{{__($topDonorContent->data_values->heading)}}</h2>
                    <p class="desc">{{__($topDonorContent->data_values->description)}}</p>
                 </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @forelse ($topperDoner as $item)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="top-donor">
                    <img class="donor-bg" src="{{asset($activeTemplateTrue . 'images/donor/donor-bg-shape.png')}}" alt="@lang('image')">
                    <span class="top-donor__icon"><i class="fa-solid fa-user-secret"></i></span>
                    <span class="top-donor__count">{{ ordinal($loop->iteration) }}</span>
                    <div class="top-donor__content">
                        <h4 class="title-two">{{$item->fullname}}</h4>
                        <p class="amount">{{ $general->cur_sym }}{{ showAmount($item->donation, 2) }}</p>
                    </div>
                </div>    
            </div>
            @empty
            <h4 class="text-center">{{__($emptyMessage)}}</h4>
            @endforelse
        </div>
    </div>
</section>
<!--============ Top Donner End ============-->