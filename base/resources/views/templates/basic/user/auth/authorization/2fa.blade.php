@extends($activeTemplate .'layouts.frontend')
@section('content')
<div class="container py-120">
    <div class="justify-content-center row">
        <div class="col-lg-5 col-md-10">
            <div class="verification-code-wrapper account-form-box">
                <div class="verification-area">
                    <h5 class="pb-3 text-center border-bottom">@lang('2FA Verification')</h5>
                    <form action="{{route('user.go2fa.verify')}}" method="POST" class="submit-form">
                        @csrf
    
                        @include($activeTemplate.'partials.verification_code')
    
                        <div class="form--group">
                            <button type="submit" class="btn btn--base w-100">
                                @lang('Submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection