@extends($activeTemplate . 'layouts.auth')
@section('content')
@php $login = getContent('login.content', true); @endphp
<!-- Login Start Here  -->
<section class="account-area bg-img" style="background-image: url({{ getImage(getFilePath('login') . '/' . @$login->data_values->background_image) }}">
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
                        <h3 class="account-form-box__title">{{ __(@$login->data_values->heading) }}</h3>
                        <p class="account-form-box__desc">{{ __(@$login->data_values->subheading) }}</p>
                    </div>
                    <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Username or Email')</label>
                                    <div class="input--group">
                                        <input type="text" name="username" value="{{ old('username') }}" class="form--control" id="email" required placeholder="@lang('Username or Email')">
                                        <div class="input--icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label  for="your-password"  class="mb-2 form--label required">@lang('Password')</label>
                                <div class="input-group">
                                    <input id="your-password"  class="form--control login-form w-100" type="password" name="password" required placeholder="@lang('Password')">
                                    <div class="password-show-hide toggle-password-change fas fa-eye-slash" data-target="your-password"> </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="form--check d-flex">
                                        <input class="form-check-input" name="remember" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                                    </div>
                                    <a class="forgot-password text--base" href="{{ route('user.password.request')}}"> @lang('Forgot Your Password ?') </a>
                                </div>
                            </div>
                            <x-captcha></x-captcha>
                            <div class="col-sm-12">
                                <button type="submit" id="recaptcha" class="btn btn--base w-100">
                                    @lang('Sign In')
                                </button>
                            </div>
                            <div class="col-sm-12">
                                <div class="have-account text-center">
                                    <p class="have-account__text">@lang('Don\'t have any account')?
                                        <a href="{{ route('user.register') }}" class="have-account__link text--base">@lang('Create Account')</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login End Here  -->
@endsection