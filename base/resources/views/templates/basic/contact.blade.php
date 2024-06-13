@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
@$contact = getContent('contact_us.content', true);
@endphp
<!-- =========== Contact Start Here =========== -->
<section class="contact-form-area py-120">
    <div class="container">
        <div class="contact-form-bg-wrap">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="contact-item-right">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-item">
                                    <div class="contact-item__icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="contact-item__content">
                                        <h3 class="title-two mb-0">@lang('Phone Number')</h3>
                                        <div class="desc">
                                            <p>
                                                <a href="tel:{{ formatPhoneNumber(@$contact->data_values->contact_number) }}">
                                                    {{ __($contact->data_values->contact_number) }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-item">
                                    <div class="contact-item__icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-item__content">
                                        <h3 class="title-two mb-0">@lang('Email Address')</h3>
                                        <div class="desc">
                                            <p><a href="mailto:{{__($contact->data_values->email_address)}}">{{__($contact->data_values->email_address)}}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-item">
                                    <div class="contact-item__icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-item__content">
                                        <h3 class="title-two mb-0">@lang('Office Location')</h3>
                                        <div class="desc">
                                            <p>{{__($contact->data_values->contact_address)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-form-area pb-120">
    <div class="container">
        <div class="contact-form-bg-wrap">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="contact-item-wrapper">
                        <form method="post" action="{{route('help.desk')}}" class="verify-gcaptcha">
                            @csrf
                            <div class="row gy-4 justify-content-center">
                                <div class="col-xl-7 col-lg-9">
                                    <div class="section-heading text-center mb-3">
                                        <span class="subtitle">{{ __(@$contact->data_values->contact_subheading) }}</span>
                                        <h2 class="title-one">{{ __(@$contact->data_values->contact_heading) }}</h2>
                                        <p class="desc">{{ __(@$contact->data_values->contact_description) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Name')</label>
                                        <div class="input--group">
                                            <input name="name" type="text" class="form-control form--control" value="{{ old('name') }}" required>
                                            <div class="input--icon">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Email')</label>
                                        <div class="input--group">
                                            <input name="email" type="email" class="form-control form--control" value="{{  old('email') }}" required>
                                            <div class="input--icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Mobile')</label>
                                        <div class="input--group">
                                            <input name="mobile" type="number" class="form-control form--control" value="{{  old('mobile') }}" required>
                                            <div class="input--icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Subject')</label>
                                        <div class="input--group">
                                            <input name="subject" type="text" class="form-control form--control" value="{{old('subject')}}" required>
                                            <div class="input--icon">
                                                <i class="fa-solid fa-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Message')</label>
                                    <div class="input--group textarea">
                                        <textarea name="message" class="form-control form--control" required>{{old('message')}}</textarea>
                                        <div class="input--icon">
                                            <i class="fas fa-address-card"></i>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--base">
                                        @lang('Send Message')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="contact-form-area pb-120">
    <div class="container-fluid">
        <div class="contact-form-bg-wrap">
            <div class="row justify-content-center">
               <div class="col-lg-12">
                    <div class="map-wrapper">
                        <iframe class="w-100"
                            src="https://maps.google.com/maps?q={{ @$contact->data_values->latitude }},{{ @$contact->data_values->longitude }}&hl=es;z=14&amp;output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
<!-- =========== Contact End Here =========== -->

    @if(@$sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include($activeTemplate.'sections.'.$sec)
    @endforeach
    @endif
@endsection