@php
    $about = getContent('about.content', true);
    $linkType = $about->data_values->link;
    $url = $linkType == 'systemlink' ? url('/')  .  @$about->data_values->button_url : @$about->data_values->button_url;
    $elements = getContent('about.element', false);
    $page = App\Models\Page::where('slug', 'about')->first();
@endphp

<!--============ about Start ============-->
<div class="about-section py-120">
    <img class="about-shape-right animate-x-axis" src="{{asset($activeTemplateTrue . 'images/about/about-shape-right.png')}}" alt="@lang('image')">
    <div  class="container">
        <div class="row gy-4 flex-wrap-reverse align-items-md-center">
            <div class="col-xl-6 col-lg-6">
                <div class="about-item-thumb">
                    <div class="about-border"></div>
                    <div class="about-border-right"></div>
                    <div class="about-item-thumb__inner">                       
                        <img class="about-right-img animate-y-axis" src="{{ getImage(getFilePath('about') . '/' . @$about->data_values->image) }} " alt="@lang('image')">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about-item-right-content">
                    <div class="section-heading mb-0">
                        <div class="top-wrap mb-3">
                            <h3 class="subtitle-big">{{__($about->data_values->big_heading)}}</h3>
                            <span class="subtitle">{{__($about->data_values->subheading)}}</span>
                             <h2 class="title-one">{{__($about->data_values->heading)}}</h2>
                        </div>
                        <p class="mb-4">{{__($about->data_values->description)}}</p>
                        <div class="about-item-middle ">

                            @forelse($elements as $item)
                      
                            <div class="about-item-middle__item">
                                <div class="icon">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title-three">{{ __($item->data_values->title) }}</h4>
                                </div>
                            </div>
                            @empty 

                            @endforelse

                        </div>
                        <div class="about-bottom">
                            <a href="{{$url}}" class="btn btn--base">
                                {{__(@$about->data_values->button_text)}} <i class="fas fa-angle-double-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============ about End ============-->