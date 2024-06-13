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
                        <a href="{{ route('home') }}" class="login-logo">
                            <img src="{{ getImage(getFilePath('logoIcon') . '/' . @$general->image->logo) }}">
                        </a>
                        <h3 class="account-form-box__title">@lang('Verify Email Address')</h3>
                        <p class="account-form-box__desc">@lang('A 6 digit verification code sent to your email address.')</p>
                    </div>
                    
                    <div class="verification-area">
                        <form  action="{{route('user.verify.email')}}" method="POST" class="submit-form">
                            @csrf
                            @include($activeTemplate.'partials.verification_code')
                            <x-captcha />
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn--base">
                                    @lang('Submit')
                                </button>
                            </div>

                            <div class="form-group mt-3">
                                @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                <a href="{{route('user.send.verify.code', 'email')}}" class="forget-pass text--base"> @lang('Try again')</a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login End Here  -->
@endsection