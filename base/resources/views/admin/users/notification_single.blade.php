@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-xl-12">
            <div class="card-two">
                <form action="{{ route('admin.users.notification.single', $user->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h5 class="card-title mb-3">@lang('Sending Notification of ')
                            <strong>{{ ucwords(@$user->fullname) }}</strong></h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Subject') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('Email subject')" name="subject"  required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Message') </label>
                                    <textarea name="message" rows="10" class="form--control w-100 summernote"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

@endsection
@push('breadcrumb-plugins')
<div class="text-lg-end text-md-end text-start mt-md-0 mt-4">

        @lang('Notification will send via ')
        @if($general->en)
            <span class="badge badge--warning">@lang('Email')</span>
        @endif
        @if($general->sn)
            <span class="badge badge--info">@lang('SMS')</span>
        @endif

</div>
@endpush
