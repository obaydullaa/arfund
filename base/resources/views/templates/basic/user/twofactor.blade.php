@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="dashboard-card-wrap">
        <div class="row justify-content-center gy-4">

            @if(!auth()->user()->ts)
            <div class="col-md-6">
                <div class="card custom--card">
                    
                    <div class="card-body">
                        <h5 class="title-three">@lang('Add Your Account')</h5>
                        <h6 class="mb-3">
                            @lang('Use the QR code or setup key on your Google Authenticator app to add your account. ')
                        </h6>

                        <div class="form-group mx-auto text-center">
                            <img class="mx-auto" src="{{$qrCodeUrl}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('Setup Key')</label>
                            <div class="input-group">
                                <input type="text" name="key" value="{{$secret}}" class="form-control form--control referralURL" readonly>
                                <button type="button" class="input-group-text copytext" id="copyBoard"> <i class="fa fa-copy"></i> </button>
                            </div>
                        </div>

                        <label><i class="fa fa-info-circle"></i> @lang('Help')</label>
                        <p>@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.') <a class="text--base" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('Download')</a></p>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-6">

                @if(auth()->user()->ts)
                    <div class="card custom--card">
                        <form action="{{route('user.twofactor.disable')}}" method="POST">
                            <div class="card-body">
                                <h5 class="title-three">@lang('Disable 2FA Security')</h5>
                                @csrf
                                <input type="hidden" name="key" value="{{$secret}}">
                                <div class="form-group mb-3">
                                    <label class="form-label">@lang('Google Authenticatior OTP')</label>
                                    <input type="text" class="form-control form--control" name="code" required>
                                </div>
                               <div class="text-end">
                                    <button type="submit" class="btn btn--base">
                                        @lang('Submit')
                                    </button>
                               </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card custom--card">
                        <form action="{{ route('user.twofactor.enable') }}" method="POST">
                            <div class="card-body">
                                <h5 class="title-three">@lang('Enable 2FA Security')</h5>
                                @csrf
                                <input type="hidden" name="key" value="{{$secret}}">
                                <div class="form-group mb-3">
                                    <label class="form-label">@lang('Google Authenticatior OTP')</label>
                                    <input type="text" class="form-control form--control" name="code" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn--base">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('style')
<style>
    .copied::after {
        background-color: #{{ $general->base_color }};
    }
</style>
@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $('#copyBoard').on('click', function(){
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush