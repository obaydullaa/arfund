@php
    $content = getContent('newsletter_subscribe.content', true);
@endphp
<!-- ========== Cta Start Here ========== -->
<section class="cta-area position-relative py-120 bg-img bg-overlay"
style="background-image: url({{ getImage(getFilePath('newsletter') . '/' . $content->data_values->background_image) }})">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="news-letter-wrapper"
                style="background-image: url({{ asset($activeTemplateTrue . 'images/newsletter/newsletter-shape.png') }})">
                    <div class="row gy-4 align-items-center">
                        <div class="col-lg-5">
                            <h2 class="title-one text-dark">{{__($content->data_values->heading)}}</h2>
                        </div>
                        <div class="col-lg-7">
                            <form action="{{route('newsletter')}}" method="POST" autocomplete="off">
                                @csrf
                                <div class="search-box  w-100">
                                    <input name="email" type="email" class="form--control" placeholder="Email address">
                                    <button type="submit" class="btn btn--base">{{__($content->data_values->button_text)}} <i class="fas fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========== Cta End Here ========== -->