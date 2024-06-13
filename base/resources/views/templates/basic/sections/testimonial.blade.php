@php
    $content = getContent('testimonial.content', true);
    $linkType = $content->data_values->link;
    $url = $linkType == 'systemlink' ? url('/')  .  @$content->data_values->button_url : @$content->data_values->button_url;
    $elements = getContent('testimonial.element', false);
@endphp

<!--============== Testimonials Section Start ==============-->
<section class="testimonial-area section-bg py-120">
    <img  class="testimonial-shape-right animate-y-axis-slider" src="{{asset($activeTemplateTrue . 'images/testimonials/testimonials-shape-right.png')}}" alt="@lang('image')">
    <img  class="testimonial-shape-left animate-y-axis-slider" src="{{asset($activeTemplateTrue . 'images/testimonials/testimonials-shape-left.png')}}" alt="@lang('image')">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="section-heading">
                    <h3 class="subtitle-big">{{__($content->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($content->data_values->subheading)}}</span>
                     <h2 class="title-one">{{__($content->data_values->heading)}}</h2>
                     <p class="desc mb-4">{{__($content->data_values->description)}}</p>
                     <a href="{{@$url}}" class="btn btn--base">
                        {{__(@$content->data_values->button_text)}} <i class="fas fa-angle-double-right"></i>
                    </a>
                 </div>
            </div>
            <div class="col-lg-7">
                <div class="testimonial-active">
                    @forelse($elements as $item)
                    <div class="testimonails-card">
                        <div class="testimonial-item">
                            <div class="testimonial-item__quate"><i class="fa-solid fa-quote-right"></i>
                            </div>
                            
                            <div class="testimonial-item__thumb">
                                <img src="{{ getImage(getFilePath('testimonial') . '/' . @$item->data_values->image) }} " alt="@lang('image')">
                            </div>

                            <div class="testimonial-item__content">
                                <h4 class="title-two">{{__($item->data_values->title)}}</h4>
                                <p class="testimonial-item__desc">{{__($item->data_values->description)}}</p>
                                
                                <div class="testimonial-item__info">
                                    <div class="testimonial-item__details">
                                        <h5 class="testimonial-item__name">{{__($item->data_values->name)}}</h5>
                                        <span class="testimonial-item__designation">{{__($item->data_values->designation)}}</span>
                                    </div>
                                </div>
                            
                                <div class="testimonial-item__rating">
                                    <ul class="rating-list justify-content-center">                                        
                                        @php
                                            echo showRatings( min(@$item->data_values->star_count, 5));
                                        @endphp
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!--============== Testimonials Section End ==============-->