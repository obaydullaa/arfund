@php
    $volunteerContent = getContent('volunteer.content', true);
    $elements = getContent('volunteer.element', false);
@endphp

<!-- =========== Team Start Here =========== -->
<section class="team-area py-120">
    <img class="team-bg" src="{{asset($activeTemplateTrue . 'images/team/team-bg.png')}}" alt="@lang('image')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{__($volunteerContent->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($volunteerContent->data_values->subheading)}}</span>
                     <h2 class="title-one">{{__($volunteerContent->data_values->heading)}}</h2>
                     <p class="desc">{{__($volunteerContent->data_values->description)}}</p>
                 </div>
            </div>
        </div>
        <div class="row gy-4 team-slider-active justify-content-center">
            @forelse($elements as $item)
            <div class="col-lg-3 col-md-6">
                <div class="team-item-card">
                    <div class="team-item-card__thumb">
                        <span class="shape-top"></span>
                        <img src="{{ getImage(getFilePath('volunteer') . '/' . @$item->data_values->image) }} " alt="@lang('image')">
                    </div>
                    <div class="team-item-card__content-wrapper">
                        <div class="team-name">
                            <h3 class="title-two">{{__($item->data_values->name)}}</h3>
                            <span>{{__($item->data_values->designation)}}</span>
                        </div>
                        <div class="social-wrap d-flex align-items-center justify-content-end">
                            <ul class="d-flex">
                                <li class="share__icon"><a href="javascript:void(0)"><i class="fa-solid fa-link"></i></a>
                                    <ul class="social-team">
                                        <li class="social-list__item"><a href="{{ $item->data_values->facebook_url }}" class="social-list__link"><i class="fab fa-facebook-f"></i></a> </li>
                                        <li class="social-list__item"><a href="{{ $item->data_values->twitter_url }}" class="social-list__link active"> <i class="fab fa-twitter"></i></a></li>
                                        <li class="social-list__item"><a href="{{ $item->data_values->linkedin_url }}" class="social-list__link"> <i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- =========== Team Start Here =========== -->