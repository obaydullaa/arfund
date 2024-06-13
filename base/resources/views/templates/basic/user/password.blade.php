@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-xxl-8">
                <div class="dashboard-card-wrap">
                    <h5 class="title-three">@lang('Change Password')</h5>
                    <div class="card-body">

                        <form action="" method="post">
                            @csrf
                            <div>
                                <label for="current_password" class="form--label">@lang('Current Password')</label>
                                <div class="form-group position-relative mb-3">
                                    <input id="current_password" type="password" class="form-control form--control" name="current_password" required autocomplete="current-password">
                                    <div class="password-show-hide fas fa-eye toggle-password-change" data-target="current_password"> </div>
                                </div>
                            </div>
                            <div>
                                <label for="password" class="form--label">@lang('Password')</label>
                                <div class="form-group position-relative mb-3">
                                    <input id="password" type="password" class="form-control form--control @if($general->secure_password) secure-password @endif" name="password" required autocomplete="current-password">
           
                                    <div class="password-show-hide fas fa-eye toggle-password-change" data-target="password"> </div>
                                </div>
                                @if ($general->secure_password)
                                <div class="secure-password-inject">
                                </div>
                                @endif
                            </div>
                            <div>
                                <label for="password_confirmation" class="form--label">@lang('Confirm Password')</label>
                                <div class="form-group position-relative mb-3">
                                    <input id="password_confirmation" type="password" class="form-control form--control" name="password_confirmation" required autocomplete="current-password">
                                    <div class="password-show-hide fas fa-eye toggle-password-change" data-target="password_confirmation"> </div>
                                </div>
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn--base">
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