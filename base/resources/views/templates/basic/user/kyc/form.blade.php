@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8">
                <div class="dashboard-card-wrap">
                        <h5 class="title-three">@lang('KYC Form')</h5>
                    <div class="card-body">
                        <form action="{{route('user.kyc.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <x-ar-form identifier="act" identifierValue="kyc" />

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
