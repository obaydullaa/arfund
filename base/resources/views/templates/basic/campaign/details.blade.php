@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $topperDoner = App\Models\Donation::paid()
            ->where('status', Status::ENABLE)
            ->where('donation', '>', 0)
            ->orderBy('donation', 'desc')
            ->limit(3)
            ->get();
    @endphp
    <!-- ============= Campaign Details Start Here ============= -->
    <section class="campaign-details py-120 section-grey-bg">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="campaign-box">
                        <div class="campaign-box__thumb">
                            <img src="{{ getImage(getFilePath('campaignImg') . '/' . $campaign->image) }}"
                                alt="@lang('Image')">
                        </div>
                        <div class="campaign-box__bottom">
                            <div class="campaign-box__skill-bar">
                                @php
                                    $donation = fetchDonationCount($campaign->id);
                                    $collectPercent = showAmount(($donation * 100) / $campaign->goal, 2);
                                    $displayPercent = $collectPercent > 100 ? 100 : $collectPercent;
                                @endphp
                                <div class="progressbar" data-perc="{{ $collectPercent > 100 ? 100 : $collectPercent }}%">
                                    <div class="bar"
                                        style="width: {{ $collectPercent > 100 ? 100 : $collectPercent }}%;"></div>
                                    <span class="label"
                                        style="left: {{ $collectPercent > 100 ? 100 : $collectPercent }}%;">{{ $collectPercent > 100 ? 100 : $collectPercent }}%</span>
                                </div>
                                <ul class="progress-tag">
                                    <li class="raised">@lang('Raised:') <span>{{ $general->cur_sym }}
                                            {{ showAmount(fetchDonationCount($campaign->id)) }}</span></li>
                                    <li class="raised">@lang('Goal:') <span>{{ $general->cur_sym }}
                                            {{ showAmount(@$campaign->goal, 2) }}</span></li>
                                </ul>
                            </div>
                            <div class="campaign-box__tag-wrap">
                                <div class="tag"><i class="fa-solid fa-tags"></i> {{ __(@$campaign->category->name) }}
                                </div>
                                <div class="date"><i class="fa-solid fa-calendar-days"></i>
                                    {{ ceil(now()->diffInDays(Carbon\Carbon::parse($campaign->date))) }} @lang('Days left')
                                    <br><small
                                        class="date-small">{{ \Carbon\Carbon::parse($campaign->date)->format('d M Y') }}</small>
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
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">
                                            @lang('Description')
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                            aria-selected="false" tabindex="-1">
                                            @lang('Relevant Image')
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="document-tab" data-bs-toggle="tab"
                                            data-bs-target="#document" type="button" role="tab"
                                            aria-controls="document" aria-selected="false" tabindex="-1">
                                            @lang('Relevant Document')
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                            aria-selected="false" tabindex="-1">
                                            @lang('Comments') ({{ $campaign['commentCount'] }})
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
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
                                                        <img src="{{ getImage(getFilePath('gallery') . '/' . $item->image) }}"
                                                            alt="@lang('Image')">
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="document" role="tabpanel"
                                        aria-labelledby="document-tab">
                                        <div class="row gy-4 justify-content-center">
                                            <div class="col-lg-12">
                                                <div class="relevant-img-item">
                                                    @if (isset($campaign->document) && $campaign->document)
                                                        <a class="document-download"
                                                            href="{{ getImage(getFilePath('document') . '/' . @$campaign->document) }}"
                                                            download>
                                                            <div class="document-download__content">
                                                                <h4 class="title-three">@lang('Download Document Click Here')</h4>
                                                                <div class="icon"><i
                                                                        class="fa-solid fa-cloud-arrow-down"></i></div>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <h6 class="text-center">{{ __($emptyMessage) }}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        <div class="row gy-4 justify-content-center">
                                            <div class="col-lg-12">
                                                <div class="tab-review-wrap">
                                                    <div class="account-form__content mb-4">
                                                        <h3 class="title-two mb-2">@lang('Comments') {{ $campaign['commentCount'] }}</h3>
                                                        <p class="account-form__desc mb-2">@lang('Email not published. Required fields marked. *')</p>
                                                    </div>
                                                    <ul class="comment-list">
                                                        @forelse($campaign->comments->where('status',Status::PUBLISHED) as $comment)
                                                            <li class="comment-list__item d-flex flex-wrap">
                                                                <div class="comment-list__thumb">
                                                                    <img src="https://placehold.co/80x80?text={{ strtoupper(substr($comment->fullname, 0, 1)) }}"
                                                                        alt="">
                                                                </div>
                                                                <div class="comment-list__content">
                                                                    <h4 class="comment-list__name">
                                                                        {{ __($comment->fullname) }}</h4>
                                                                    <div
                                                                        class="time-rating-warper d-flex justify-content-between">
                                                                        <span class="comment-list__time"> <span
                                                                                class="comment-list__time-icon"><i
                                                                                    class="far fa-clock"></i></span>{{ diffforhumans($comment->updated_at) }}
                                                                        </span>
                                                                    </div>
                                                                    <p class="comment-list__desc">
                                                                        {{ __($comment->comment) }}</p>
                                                                    <div class="comment-list__reply">
                                                                        <span> {{ $item->created_at->format('d') }}
                                                                            {{ $item->created_at->format('M') }}
                                                                            {{ $item->created_at->format('Y') }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @empty
                                                            <p class="text-center border py-3">@lang('No Comment Yet')</p>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class=".contactus-form">
                                                    <form action="{{ route('campaign.comment') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="campaign" value="{{ $campaign->id }}">
                                                        <div class="row gy-3">
                                                            @guest
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="name" class="form--label">
                                                                            @lang('Name') </label>
                                                                        <input id="name" type="text" name="fullname"
                                                                            placeholder="@lang('Enter Name')"
                                                                            class="form--control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="email"
                                                                            class="form--label">@lang('Email Address')</label>
                                                                        <input id="email" type="email" name="email"
                                                                            placeholder="@lang('Enter Email Address')"
                                                                            class="form--control" required>
                                                                    </div>
                                                                </div>
                                                            @endguest
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="message"
                                                                        class="form--label">@lang('Message')</label>
                                                                    <textarea id="message" placeholder="@lang('Enter Your Comment')" class="form--control" name="comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="text-end">
                                                                    <button type="submit" class="btn btn--base">
                                                                        @lang('Submit') <i
                                                                            class="fa-sharp fa-solid fa-arrow-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
                            <form class="vent-details-form" method="get"
                                action="{{ route('deposit.campaign.payment', $campaign->id) }}">
                                <h5 class="blog-sidebar__title"> @lang('Donate Amount') </h5>
                                <div class="row gy-3 align-items-center">
                                    <div class="col-lg-12">
                                        <div class="input-group country-code mr-sm-2">
                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                            <input type="number" id="amount" class="form--control" value="0"
                                                name="amount" required="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input hidden name="campaign_id" value="{{ $campaign->id }}">
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check" type="radio"
                                                name="doantion_amount" value="100" id="radiCheck1">
                                            <label class="form-check-label"
                                                for="radiCheck1">{{ $general->cur_sym }}@lang('100')</label>
                                        </div>
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check" type="radio"
                                                name="doantion_amount" value="200" id="radiCheck2">
                                            <label class="form-check-label"
                                                for="radiCheck2">{{ $general->cur_sym }}@lang('200')</label>
                                        </div>
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check" type="radio"
                                                name="doantion_amount" value="300" id="radiCheck3">
                                            <label class="form-check-label"
                                                for="radiCheck3">{{ $general->cur_sym }}@lang('300')</label>
                                        </div>
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check custom-donation"
                                                type="radio" name="doantion_amount" id="custom-donation-id">
                                            <label class="form-check-label"
                                                for="custom-donation-id">@lang('Custom')</label>
                                        </div>
                                    </div>

                                </div>
                                <h3 class="title-two mb-4 mt-4">@lang('Personal Information')</h3>
                                <div class="form--check mb-4">
                                    <input class="form-check-input" type="checkbox" name="anonymous" id="checkdonation"
                                        value="1">
                                    <label class="form-check-label" for="checkdonation">
                                        @lang('Make Anonymous Donation')
                                    </label>
                                </div>
                                <div class="row gy-3">
                                    @php
                                        $user = auth()->user();
                                    @endphp
                                    <div class="form-row">
                                        <div class="form-group mb-3 col-lg-12">
                                            <label class="form--label">@lang('Full Name')</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', @$user->fullname) }}"
                                                class="form--control checktoggle" required>
                                        </div>

                                        <div class="form-group mb-3 col-lg-12">
                                            <label class="form--label">@lang('Email')</label>
                                            <input type="text" name="email"
                                                value="{{ old('email', @$user->email) }}"
                                                class="form--control checktoggle" required>
                                        </div>

                                        <div class="form-group mb-3 col-lg-12">
                                            <label class="form--label">@lang('Mobile'): </label>
                                            <input type="number" name="mobile"
                                                value="{{ old('mobile', @$user->mobile) }}"
                                                class="form--control checktoggle" required>
                                        </div>

                                        <div class="form-group mb-3 col-lg-12">
                                            <label class="form--label">@lang('Country')</label>
                                            <select class="form--control form-select checktoggle" name="country">

                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}"
                                                        value="{{ $country->country }}" data-code="{{ $key }}">
                                                        {{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn--base w-100">@lang('Donate Now')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title">@lang('Promote This Campaign')</h5>
                            <div class="post-sidebar__card__body">
                                <div class="input-group copy country-code mb-4">
                                    <input type="text" id="urlCopyId"
                                        value="{{ route('campaign.details', ['slug' => slug($campaign->title), 'id' => $campaign->id]) }}"
                                        class="form--control">
                                    <button class="btn btn--base copyTextUrl">
                                        <i class="fa-solid fa-copy"></i>
                                    </button>
                                </div>
                                <ul class="social-list">
                                    <li class="social-list__item">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            class="social-list__link flex-center" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{ urlencode(url()->current()) }}"
                                            class="social-list__link flex-center" target="_blank">
                                            <i class="fab fa-x-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}"
                                            class="social-list__link flex-center" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="https://www.pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}"
                                            class="social-list__link flex-center" target="_blank">
                                            <i class="fab fa-pinterest-p"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title">@lang('Latest Donation')</h5>
                            @forelse ($topperDoner as $item)
                                <div class="top-donor">
                                    <img class="donor-bg"
                                        src="{{ asset($activeTemplateTrue . 'images/donor/donor-bg-shape.png') }}"
                                        alt="@lang('image')">
                                    <span class="top-donor__icon"><i class="fa-solid fa-user-secret"></i></span>
                                    <span class="top-donor__count">{{ ordinal($loop->iteration) }}</span>
                                    <div class="top-donor__content">
                                        <h4 class="title-two">{{ $item->fullname }}</h4>
                                        <p class="amount">{{ $general->cur_sym }}{{ showAmount($item->donation, 2) }}</p>
                                    </div>
                                </div>
                            @empty
                            @endforelse
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

            $('#checkdonation').on('change', function() {
                const isChecked = $(this).is(':checked');
                $('#non-anonymous-fields input').each(function() {
                    if (isChecked) {
                        $(this).removeAttr('required');
                    } else {
                        $(this).attr('required', 'required');
                    }
                    $(this).closest('.mb-3').toggle(!isChecked);
                });
            });

            // Initial state check
            $('#checkdonation').trigger('change');

            $('.copyTextUrl').on('click', function() {
                var copyTextUrl = document.getElementById("urlCopyId");
                copyTextUrl.select();
                copyTextUrl.setSelectionRange(0, 99999)
                document.execCommand("copy");
                notify('success', 'URL copied successfully');
            })

            $('#checkdonation').on('change', function() {
                var status = this.checked;
                if (status) {
                    $('.checktoggle').prop("disabled", true)
                    $('input[name=name]').val('');
                    $('input[name=email]').val('');
                    $('input[name=mobile]').val('');
                    $('input[name=country]').val('');
                    $('input[name=name]').attr('required', false);
                    $('input[name=email]').attr('required', false);
                    $('input[name=mobile]').attr('required', false);
                    $('input[name=country]').attr('required', false);
                } else {
                    @if (auth()->user())
                        let user = @json(auth()->user());
                        $('input[name=name]').val(user.firstname + ' ' + user.lastname);
                        $('input[name=email]').val(user.email);
                        $('input[name=mobile]').val(user.mobile);
                        $('input[name=country]').val(user.address.country);
                    @endif
                    $('input[name=name]').attr('required', true);
                    $('input[name=email]').attr('required', true);
                    $('input[name=mobile]').attr('required', true);
                    $('input[name=country]').attr('required', true);
                    $('.checktoggle').prop("disabled", false)
                }
            })


            $(".donation-radio-check").on('click', function(e) {
                $(".donation-radio-check").attr('checked', false);
                $(this).prop('checked', true);
                $("[name=amount]").val($(this).val())
            });

            $("#donateAmount").on('click', function(e) {
                $(".donation-radio-check").prop('checked', false);
                $(".custom-donation").prop('checked', true);
                $(this).val("");
            });

            $(".custom-donation").on('click', function(e) {
                $("input[name=amount]").focus();
                $('input[name=amount]').val(0);
            });

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .blog-sidebar .form--control:disabled,
        .form--control[readonly] {
            background-color: hsl(var(--black)/0.07);
            opacity: 1;
            border: 0;
        }

        iframe.iframe {
            width: 100%;
            min-height: 400px;
        }
    </style>
@endpush