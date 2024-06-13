@extends($activeTemplate.'layouts.frontend')
@section('content')
<div class="container py-120">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7 col-xl-5">
            <div class="account-form-box">
                <div class="card-header">
                    <h5 class="title-two">@lang('Reset Password')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p>@lang('Your account is verified successfully. Now you can change your password. Please enter a strong password and don\'t share it with anyone.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group mb-3">
                            <label class="form-label">@lang('Password')</label>
                            <input type="password" class="form-control form--control @if($general->secure_password) secure-password @endif" name="password" required>
                            @if ($general->secure_password)
                                <div class="secure-password-inject">
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">@lang('Confirm Password')</label>
                            <input type="password" class="form-control form--control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
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

@if($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/general/js/secure_password.js') }}"></script>
    @endpush
@endif