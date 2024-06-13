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
                        <h3 class="account-form-box__title">@lang('User Data')</h3>
                    </div>
                    
                    <div class="verification-area">
                        <form method="POST" action="{{ route('user.data.submit') }}">
                            @csrf
                            <div class="row gy-4">
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('First Name')</label>
                                    <input type="text" class="form-control form--control" name="firstname"
                                        value="{{ old('firstname') }}" required>
                                </div>
    
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('Last Name')</label>
                                    <input type="text" class="form-control form--control" name="lastname"
                                        value="{{ old('lastname') }}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control" name="address"
                                        value="{{ old('address') }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('State')</label>
                                    <input type="text" class="form-control form--control" name="state"
                                        value="{{ old('state') }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control" name="zip"
                                        value="{{ old('zip') }}">
                                </div>
    
                                <div class="form-group col-sm-6">
                                    <label class="form-label">@lang('City')</label>
                                    <input type="text" class="form-control form--control" name="city"
                                        value="{{ old('city') }}">
                                </div>
                            </div>
                            <div class="form-group mt-3 text-end">
                                <button type="submit" class="btn btn--base">
                                    @lang('Save')
                                </button>
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