@php
    $whyChooseUs = getContent('why_choose_us.content', true);
    $elements = getContent('why_choose_us.element', false);
    $counterElements = getContent('counter.element',false);
@endphp
<!-- ==================== Why Choose us Start Here ==================== -->
<section class="why-choose-area py-120">
    <div class="why-choose-bg animate-zoom-fade"></div>
    <div class="why-choose-border"></div>
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-7">
                <div class="section-heading mb-4">
                    <h3 class="subtitle-big">{{__($whyChooseUs->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($whyChooseUs->data_values->subheading)}}</span>
                     <h2 class="title-one">{{__($whyChooseUs->data_values->heading)}}</h2>
                     <p class="desc">{{__($whyChooseUs->data_values->description)}}</p>
                </div>
                <div class="why-choose-us__content">
                    <div class="why-choose-us__topic">
                        @forelse($elements as $item)
                        <div class="item">
                            <i class="fa-solid fa-circle-check"></i>
                            <div class="content">
                                <h4 class="title-three">{{__($item->data_values->title)}}</h4>
                                <p>{{__($item->data_values->short_description)}}</p>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="why-choose-us__thumb">
                    <img class="img-1 animate-y-axis" src="{{ getImage(getFilePath('why_choose_us') . '/' . @$whyChooseUs->data_values->image) }}" alt="@lang('image')">
                    
                    <div class="popup-vide-wrap">
                        <div class="video-main">
                            <div class="promo-video">
                                <div class="waves-block">
                                    <div class="waves wave-1"></div>
                                    <div class="waves wave-2"></div>
                                    <div class="waves wave-3"></div>
                                </div> 
                            </div>
                            <a class="play-video popup_video" data-fancybox="" href="https://vimeo.com/767046013">
                                <span class="play-btn"> <i class="fa fa-play"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=== Counter End Here=== -->
    <div class="container">
        <div class="counter-wrapper bg-img" style="background-image: url({{asset($activeTemplateTrue . 'images/counter/counter-bg.png') }})">
            <div class="row gy-4 justify-content-center">
                @forelse($counterElements as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="counter">
                        <div class="counter__icon">
                            <h3><span class="odometer" data-count="{{__($item->data_values->counter_digit)}}">@lang('00')</span><span class="letter">+</span></h3>
                        </div>
                        <div class="counter__content">
                            <h3 class="title">{{__($item->data_values->title)}}</h3>
                        </div>
                    </div>
                </div>
                @empty 
                @endforelse
            </div>
        </div>
    </div> 
    <!-- == Counter End Here == -->

</section>
<!-- ==================== Why Choose us End Here ==================== -->