@extends($activeTemplate .'layouts.frontend')
@section('content')
<div class="container py-120">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card custom--card account-form-box">
                <div class="card-body">
                    <h3 class="text-center text-danger">@lang('You are blocked')</h3>
                    <p class="fw-bold mb-1">@lang('Reason'):</p>
                    <p>{{ $user->ban_reason }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
