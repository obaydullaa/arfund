@php
    $howWork = getContent('how_it_work.content', true);
    $elements = getContent('how_it_work.element', false);
@endphp
<!--============ How it works Start =============-->
<section class="how-it-works-area section-bg py-120 fix">
    <img class="how-work-shape animate-y-axis" src="{{asset($activeTemplateTrue . 'images/how-work/how-work-shape.png')}}" alt="@lang('image')">
    <img class="how-work-shape-left animate-float-bob" src="{{asset($activeTemplateTrue . 'images/how-work/how-work-shape-left.png')}}" alt="@lang('image')">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{__($howWork->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($howWork->data_values->subheading)}}</span>
                     <h2 class="title-one">{{__($howWork->data_values->heading)}}</h2>
                     <p class="desc">{{__($howWork->data_values->description)}}</p>
                 </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @forelse($elements as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="single-step-item text-center">
                    <div class="arrow-wrap-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 143 27" fill="none">
                            <path d="M1 15.165C1 15.165 64.7559 -15.165 130.677 15.165" stroke-opacity="0.53" stroke-width="1.5" stroke-dasharray="4 7"></path>
                            <path d="M124.176 25.5129L141.414 20.1646L135.535 3.6748" stroke-opacity="0.53" stroke-width="1.5"></path>
                        </svg>
                    </div>
                    <span class="single-step-item__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="single-step-item__icon">
                        @php echo $item->data_values->how_work_icon @endphp
                    </div>
                    <h4 class="title-two">{{__($item->data_values->title)}}</h4>
                    <p class="single-step-item__content">{{__($item->data_values->description)}}</p>
                </div>    
            </div>
            @empty

            @endforelse
        </div>
    </div>
</section>
<!--============ How it works End ============-->