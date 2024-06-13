
@extends($activeTemplate . 'layouts.frontend')
@section('content')
<!-- ============= Campaign Details Start Here ============= -->
<section class="campaign-details py-120 section-grey-bg">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-8">
                <div class="campaign-box">
                    <div class="campaign-box__thumb">
                        <img src="{{ getImage(getFilePath('campaignImg') . '/' . $campaign->image) }}" alt="@lang('Image')">
                    </div>
                    <div class="campaign-box__bottom">
                        <div class="campaign-box__skill-bar">
                            @php
                                $donation = fetchDonationCount($campaign->id);
                                $collectPercent = showAmount(($donation * 100 / $campaign->goal), 2);
                            @endphp
                            <div class="progressbar" data-perc="{{ $collectPercent > 100 ? 100 : $collectPercent }}%">
                                <div class="bar" style="width: {{ $collectPercent > 100 ? 100 : $collectPercent}}%;"></div>
                                <span class="label" style="left: {{ $collectPercent > 100 ? 100 : $collectPercent }}%;">{{ $collectPercent }}</span>
                            </div>
                            <ul class="progress-tag">
                                <li class="raised">@lang('Raised:') <span>{{ $general->cur_sym }} {{ showAmount(fetchDonationCount($campaign->id)) }}</span></li>
                                <li class="raised">@lang('Goal:') <span>{{ $general->cur_sym }} {{ showAmount(@$campaign->goal,2) }}</span></li>
                            </ul>
                        </div>
                        <div class="campaign-box__tag-wrap">
                            <div class="tag"><i class="fa-solid fa-tags"></i> {{ __(@$campaign->category->name) }}</div>
                            <div class="date"><i class="fa-solid fa-calendar-days"></i>
                                {{ ceil(now()->diffInDays(Carbon\Carbon::parse($campaign->date))) }} @lang('Days left')
                                <br><small class="date-small">{{ \Carbon\Carbon::parse($campaign->date)->format('d M Y') }}</small>
                            </div>
                        </div>

                        <div class="campaign-box__content mb-4">
                            <h4 class="title-two">{{ __($campaign->title) }}</h4>
                        </div>
                    </div>

                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs custom--tab" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        @lang('Description')
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">
                                        @lang('Relevant Image')
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#document" type="button" role="tab" aria-controls="document" aria-selected="false" tabindex="-1">
                                        @lang('Relevant Document')
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">
                                        @lang('Comments')
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row gy-4 justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="about-right-content">
                                                <div class="section-heading mb-0">
                                                    <p class="text-justify">
                                                        @php echo $campaign->description @endphp
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row gy-4 justify-content-center">
                                         @forelse ($campaign->galleries as $item)
                                            <div class="col-lg-6">
                                                <div class="relevant-img-item">
                                                    <img src="{{ getImage(getFilePath('gallery') . '/' . $item->image) }}" alt="@lang('Image')">
                                                </div>
                                            </div>
                                         @empty
                                         @endforelse
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                                    <div class="row gy-4 justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="relevant-img-item">
                                                @if(isset($campaign->document) && $campaign->document)
                                                <a class="document-download" href="{{ getImage(getFilePath('document') . '/' . @($campaign->document)) }}" download>
                                                    <div class="document-download__content">
                                                        <h4 class="title-three">@lang('Download Document Click Here')</h4>
                                                        <div class="icon"><i class="fa-solid fa-cloud-arrow-down"></i></div>
                                                    </div>
                                                </a>
                                                @else
                                                <h6 class="text-center">{{ __($emptyMessage) }}</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row gy-4 justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="tab-review-wrap">
                                                <div class="account-form__content mb-4">
                                                    <h3 class="title-two mb-2">@lang('Comments')(0)</h3>
                                                    <p class="account-form__desc mb-2">@lang('Email not published. Required fields marked. *')</p>
                                                </div>
                                                <ul class="comment-list">

                                                    @forelse($campaign->comments->where('status',Status::PUBLISHED) as $comment)
                                                    <li class="comment-list__item d-flex flex-wrap">
                                                        <div class="comment-list__thumb">
                                                            <img src="{{asset($activeTemplateTrue . 'images/comment/user.png')}}" alt="@lang('image')">
                                                        </div>
                                                        <div class="comment-list__content">
                                                            <h4 class="comment-list__name">{{ __($comment->fullname) }}</h4>
                                                            <div class="time-rating-warper d-flex justify-content-between">
                                                                <span class="comment-list__time"> <span class="comment-list__time-icon"><i class="far fa-clock"></i></span>{{ diffforhumans($comment->updated_at) }} </span>
                                                            </div>
                                                            <p class="comment-list__desc">{{ __($comment->comment) }}</p>
                                                            <div class="comment-list__reply">
                                                                <span> {{$item->created_at->format('d')}} {{$item->created_at->format('M')}} {{$item->created_at->format('Y')}}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @empty
                                                        <p class="text-center border py-3">@lang('No Comment Yet')</p>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <!-- ============ Campaigns Details Sidebar Start ======= -->
                <div class="blog-sidebar-wrapper">
                    <div class="blog-sidebar">
                        <h5 class="blog-sidebar__title">@lang('Promote This Campaign')</h5>
                        <div class="post-sidebar__card__body">
                            <div class="input-group copy country-code mb-4">
                                <input type="text" id="urlCopyId" value="{{ route('campaign.details', ['slug' => slug($campaign->title), 'id' => $campaign->id]) }}" class="form--control">
                                <button class="btn btn--base copyTextUrl">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                            <ul class="social-list">
                                <li class="social-list__item">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{ urlencode(url()->current()) }}" class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-x-twitter"></i>
                                    </a>
                                </li>
                                <li class="social-list__item">
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}" class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://www.pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}" class="social-list__link flex-center" target="_blank">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============ Campaigns Details Sidebar End ======= -->

            </div>
        </div>
    </div>
</section>
<!-- ============= Campaign Details End Here ============= -->
@endsection

@push('script')
    <script>
        (function($) {
            "use strict"

        $('.copyTextUrl').on('click', function() {
            var copyTextUrl = document.getElementById("urlCopyId");
            copyTextUrl.select();
            copyTextUrl.setSelectionRange(0, 99999)
            document.execCommand("copy");
            notify('success', 'URL copied successfully');
        })

        })(jQuery);
    </script>
@endpush