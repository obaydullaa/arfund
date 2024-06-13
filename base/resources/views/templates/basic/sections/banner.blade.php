@php
    $banner = getContent('banner.content', true);
    $linkType = $banner->data_values->link;
    $url = $linkType == 'systemlink' ? url('/')  .  @$banner->data_values->button_url : @$banner->data_values->button_url;
@endphp
<!--============ Banner Section Start ============-->

<section class="banner-section section-bg bg-img"
    style="background-image: url({{ getImage(getFilePath('banner') . '/' . $banner->data_values->background_image) }})">
        <div class="banner-shape-trangle top-up-down"></div>
        <div class="banner-shape-hours-wrap">
            <div class="banner-shape-hours"></div>
        </div>

        <img class="banner-shape-star" src="{{ asset($activeTemplateTrue . 'images/banner/banner-shape-star.png') }}"
            alt="@lang('image')">
        <img class="banner-shape-star" src="{{ asset($activeTemplateTrue . 'images/banner/banner-shape-star.png') }}"
            alt="@lang('image')">
        <img class="ban-shape-bg animate-y -axis"
            src="{{ asset($activeTemplateTrue . 'images/banner/ban-shape-bg-1.png') }}" alt="@lang('image')">
        <div class="banner-right-bottom animate-rotate">
            <div class="dot-wrap">
                <div class="slider-dot one"></div>
                <div class="slider-dot two"></div>
                <div class="slider-dot three"></div>
                <div class="slider-dot four"></div>
            </div>
        </div>

        <div class="banner-right-round-shape-wrap animate-rotate">
            <div class="round-thumb">
                <span class="round-shape one"></span>
                <span class="round-shape two"></span>
                <span class="round-shape three"></span>
                <span class="round-shape four"></span>
                <img class="banner-right-round-shape" src="{{ asset($activeTemplateTrue . 'images/banner/banner-right-round-shape.png') }}" alt="@lang('image')">
            </div>
        </div>

        <div class="container">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <div class="banner-left__content">
                        <span class="subtitle">{{ __($banner->data_values->subheading) }}</span>
                        <h2>{{ __($banner->data_values->heading) }}</h2>
                        <p>{{ __($banner->data_values->description) }}</p>
                        <div class="video-button-wrap d-flex align-items-center">
                            <a href="{{$url}}" class="btn btn--base">
                              {{ __(@$banner->data_values->button_text) }} <i class="fas fa-angle-double-right"></i>
                            </a>
                            <div class="popup-vide-wrap ms-3">
                                <div class="video-main">
                                    <div class="promo-video">
                                        <div class="waves-block">
                                            <div class="waves wave-1"></div>
                                            <div class="waves wave-2"></div>
                                            <div class="waves wave-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{@$banner->data_values->youtube_video_url }}"
                                    class="video-button popup_video">
                                    <i class="fas fa-play text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <div class="banner-right__thumb">
                        <div class="main-img">
                            <img class="animate-y-axis-slider"
                                src="{{ getImage(getFilePath('banner') . '/' . @$banner->data_values->banner_image) }}"
                                alt="@lang('image')">
                                {{-- <img class="banner-count-img animate-x-axis" src="{{ getImage(getFilePath('banner') . '/' . @$banner->data_values->banner_bottom_image)}}" alt=""> --}}
                                <div class="banner-count__wrapper animate-x-axis">
                                    
                                    <div class="banner-count">
                                        <div class="banner-count__text">
                                            <h3><span class="odometerRR" data-count="55">@lang('00')</span></h3>
                                        </div>
                                        <div class="banner-count__content">
                                            <h3 class="title">Members</h3>
                                        </div>
                                    </div>
                                    <div class="banner-count">
                                        <div class="banner-count__text">
                                            <h3><span class="odometerRR" data-count="55">@lang('00')</span></h3>
                                        </div>
                                        <div class="banner-count__content">
                                            <h3 class="title">Campaigns</h3>
                                        </div>
                                    </div>
                                    <div class="banner-count">
                                        <div class="banner-count__text">
                                            <h3><span class="odometerRR" data-count="55">@lang('00')</span></h3>
                                        </div>
                                        <div class="banner-count__content">
                                            <h3 class="title">Raised</h3>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="counter">
                                    <div class="counter__icon">
                                        <h3><span class="odometer" data-count="{{__($item->data_values->counter_digit)}}">@lang('00')</span><span class="letter">+</span></h3>
                                    </div>
                                    <div class="counter__content">
                                        <h3 class="title">{{__($item->data_values->title)}}</h3>
                                    </div>
                                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============ Banner Section End ============-->