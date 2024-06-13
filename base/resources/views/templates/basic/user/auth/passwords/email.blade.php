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
                        <h3 class="account-form-box__title">@lang('Recover your account')</h3>
                        <p class="account-form-box__desc">@lang('To recover your account please provide your email or username to find your account.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.email') }}" class="verify-gcaptcha">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Email or Username')</label>
                                    <div class="input--group">
                                        <input type="text" class="form-control form--control" name="value" value="{{ old('value') }}" required placeholder="@lang('Email or Username')" autofocus="off">
                                        <div class="input--icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" id="recaptcha" class="btn btn--base ">
                                        @lang('Submit')
                                    </button>
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