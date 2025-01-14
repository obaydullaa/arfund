@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="d-flex justify-content-center">
                    <div class="verification-code-wrapper account-form-box">
                        <div class="verification-area">
                            <h5 class="title-three pb-3 text-center ">@lang('Verify Email Address')</h5>
                            <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form">
                                @csrf
                                <p class="verification-text mb-2">@lang('A 6 digit verification code sent to your email address') :  {{ showEmailAddress($email) }}</p>
                                <input class="mb-2 mt-2" type="hidden" name="email" value="{{ $email }}">
    
                                @include($activeTemplate.'partials.verification_code')
    
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit')
                                    </button>
                                </div>
    
                                <div class="form-group">
                                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                    <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                                </div>
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection