@extends('admin.layouts.master')

@section('content')
    <section class="login-section">
        <div class="container-fluid px-0">
            <div class="row mx-0">
                <div class="col-xl-7 col-lg-6 px-0 d-none d-lg-block">
                    <div class="login-left-section" style="background-image: url('{{ asset('assets/admin/images/loginbg.png') }}')">
                        <div class="logo-wrap">
                            <a href="{{ route('home') }}"><img src="{{ thumbLogo(true) }}" alt="{{ __(@$general->site_name) }}"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6 px-0">
                    <div class="login-box">
                        <div class="close--btn mb-5">
                            <div class="wrap">
                                <a href="{{ route('home') }}"><i class="fa-solid fa-chevron-left"></i> @lang('Frontend')</a>
                            </div>
                        </div>
                        <div class="content-wrap">
                            <h4 class="title">@lang('Welcome to') {{ gs()->site_name }}</h4>
                        </div>
                        <form class="mt-4 mb-5 login-input verify-gcaptcha" action="{{ route('admin.login') }}"
                            method="POST">
                            @csrf
                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label">@lang('User name')</label>
                                <input class="form--control login-form w-100" value="{{ old('username') }}" name="username" required placeholder="@lang('Username')">
                            </div>
                            <div class="mb-4 form-group">
                                <label class="mb-2 form--label">@lang('Password')</label>
                                <input class="form--control login-form w-100" type="password" name="password" required placeholder="@lang('Password')">
                            </div>


                            <div class="login-meta mb-4" data-wow-delay="0.5s">
                                <div class="form--check">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                    <label class="ms-2" for="remember">@lang('Remember Me')</label>
                                </div>
                                <div class="condition-text">
                                    <a class="text-base" id="recaptcha" href="{{ route('admin.password.reset') }}">@lang('Forgot Password?')</a>
                                </div>
                            </div>
                            <x-captcha></x-captcha>
                            <button type="submit" id="recaptcha" class="btn loginbtn w-100">@lang('Sign In')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


