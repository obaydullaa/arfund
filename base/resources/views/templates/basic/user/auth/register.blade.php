@extends($activeTemplate.'layouts.auth')
@section('content')
@php
    $policyPages = getContent('policy_pages.element',false,null,true);
    $registerContent = getContent('register.content', true);
    $register = getContent('register.content', true);
@endphp

<!-- Registration Start Here  -->
<section class="account-area bg-img" style="background-image: url({{ getImage(getFilePath('register') . '/' . @$registerContent->data_values->background_image) }}">
    <div class="account-inner">
        <div class="container-fluid">
            <div class="account-form-box-wrapper">
                <div class="account-form-box">
                    
                    <div class="account-form-box__content">
                        <div class="back-homepage">
                            <a class="back-homepage-btn" href="{{route('home')}}">
                                <i class="fa-solid fa-house"></i>
                            </a>
                        </div>
                        <a href="{{ route('home') }}" class="login-logo">
                            <img src="{{ getImage(getFilePath('logoIcon') . '/' . @$general->image->logo) }}">
                        </a>
                        <h3 class="account-form-box__title">{{ __(@$register->data_values->heading) }}</h3>
                        <p class="account-form-box__desc">{{ __(@$register->data_values->subheading) }}</p>
                    </div>
                    <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha">
                        @csrf
                        <div class="row gy-4">
                            @if(session()->get('reference') != null)
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="referenceBy" class="form--label">@lang('Reference by')</label>
                                    <input type="text" name="referBy" id="referenceBy" class="form--control" value="{{session()->get('reference')}}" readonly>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pb-1 form--label">@lang('Username')</label>
                                    <div class="input--group">
                                        <input type="text" class="form--control checkUser" name="username" value="{{ old('username') }}" required placeholder="@lang('username')">
                                        <small class="text-danger usernameExist"></small>
                                        <div class="input--icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="pb-1 form--label">@lang('E-mail Address')</label>
                                    <div class="input--group">
                                        <input id="email" type="email" class="form--control form--control checkUser" name="email" value="{{ old('email') }}" required placeholder="@lang('email')">
                                        <div class="input--icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="pb-1 form--label required">@lang('Country')</label>
                                    <div class="col-sm-12">
                                        <select class="form--control form-select" name="country">
                                            
                                            @foreach($countries as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form--label">@lang('Mobile')</label>
                                    <div class="input-group country-code">
                                        <span class="input-group-text mobile-code">

                                        </span>
                                        <input type="hidden" name="mobile_code">
                                        <input type="hidden" name="country_code">
                                        <input type="number" name="mobile" value="{{ old('mobile') }}" class="form--control checkUser" required placeholder="@lang('mobile')">
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form--label">@lang('Password')</label>
                                    <div class="input-group">
                                        <input type="password" class="form--control @if($general->secure_password) secure-password @endif"  id="password" name="password" required placeholder="@lang('password')">
                                        <div class="password-show-hide fas fa-eye-slash toggle-password-change" data-target="password"></div>
                                        
                                    </div>
                                </div>
                               
                                @if ($general->secure_password)
                                    <div class="secure-password-inject">
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form--label">@lang('Re-Enter Password')</label>
                                    <div class="input-group">
                                        <input type="password" class="form--control" id="password_confirmation" name="password_confirmation" required placeholder="@lang('password')">
                                        <div class="password-show-hide fas fa-eye-slash toggle-password-change" data-target="password_confirmation"></div>
                                    </div>
                                </div>

                            </div>

                            @if($general->agree)
                            <div class="col-sm-12">
                                <div class="mb-3 form--check">
                                    <input class="form-check-input" type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                    <label class="form-check-label" for="agree">
                                    @lang('I agree with') @foreach($policyPages as $policy) <a href="{{ route('policy.pages',[slug($policy->data_values->title),$policy->id]) }}" class="text--base">{{ __($policy->data_values->title) }}</a>@if(!$loop->last), @endif @endforeach
                                    </label>
                                </div>
                            </div>
                            @endif

                            <x-captcha></x-captcha>
                            
                            <div class="col-sm-12">
                                <button type="submit" id="recaptcha" class="btn btn--base w-100">
                                    @lang('Sign Up') <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                            <div class="col-sm-12">
                                <div class="have-account text-center">
                                    <p class="have-account__text">@lang('Already have an account')? <a href="{{ route('user.login') }}" class="have-account__link text--base">@lang('Sign In')</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Registration End Here  -->

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <h6 class="text-center">@lang('You already have an account please Login ')</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                <a href="{{ route('user.login') }}" class="btn btn--base btn-sm">@lang('Login')</a>
            </div>
            </div>
        </div>
    </div>
    @endsection
    @push('style')
    <style>
        .country-code .input-group-text{
            background: #fff !important;
        }
        .country-code select{
            border: none;
        }
        .country-code select:focus{
            border: none;
            outline: none;
        }
    </style>
    @endpush
    @if($general->secure_password)
        @push('script-lib')
            <script src="{{ asset('assets/general/js/secure_password.js') }}"></script>
        @endpush
    @endif
    @push('script')
        <script>
          "use strict";
            (function ($) {
                @if($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected','');
                @endif
    
                $('select[name=country]').change(function(){
                    $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                    $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                    $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
                    console.log('Hello');
                });
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
    
                $('.checkUser').on('focusout',function(e){
                    var url = '{{ route('user.checkUser') }}';
                    var value = $(this).val();
                    var token = '{{ csrf_token() }}';
                    if ($(this).attr('name') == 'mobile') {
                        var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                        var data = {mobile:mobile,_token:token}
                    }
                    if ($(this).attr('name') == 'email') {
                        var data = {email:value,_token:token}
                    }
                    if ($(this).attr('name') == 'username') {
                        var data = {username:value,_token:token}
                    }
                    $.post(url,data,function(response) {
                      if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                      }else if(response.data != false){
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                      }else{
                        $(`.${response.type}Exist`).text('');
                      }
                    });
                });
            })(jQuery);
    
        </script>
    @endpush