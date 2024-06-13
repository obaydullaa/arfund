@php
    $faq = getContent('faq.content', true);
    $faqElement = getContent('faq.element', false);
@endphp

<!-- ==================== Accordion Start Here ==================== -->
<section class="accordion-area position-relative py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{ __($faq->data_values->big_heading) }}</h3>
                    <span class="subtitle">{{ __($faq->data_values->subheading) }}</span>
                    <h2 class="title-one">{{ __($faq->data_values->heading) }}</h2>
                    <p class="desc">{{ __($faq->data_values->description) }}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="accordion custom--accordion " id="accordionExample">
                    <div class="accordion-wrapper">
                        @foreach ($faqElement as $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button class="accordion-button"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $loop->index }}"
                                        aria-expanded="false">
                                        {{ __(@$item->data_values->question) }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @php
                                            echo $item->data_values->answer_editor;
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="faq-right-thumb">
                    <div class="faq-small-wrap">
                        <img class="animate-y-axis-slider"
                            src="{{ getImage(getFilePath('faq') . '/' . @$faq->data_values->small_image) }} "
                            alt="@lang('image')">
                    </div>
                    <img class="faq-right-img"
                        src="{{ getImage(getFilePath('faq') . '/' . @$faq->data_values->big_image) }} "
                        alt="@lang('image')">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Accordion End Here ==================== -->
