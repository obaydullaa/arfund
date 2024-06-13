@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-xl-12">
            <div class="card-two">
                <form action="{{ route('admin.subscriber.send.email') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="subject" class="mb-2">@lang('Subject')</label>
                                <input type="text" class="form--control w-100" name="subject" id="subject" required value="{{ old('subject') }}" >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="msgbody" class="mb-2">@lang('Body')</label>
                                <textarea name="body" rows="10" id="msgbody" class="form--control w-100 summernote">{{ old('body') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.subscriber.index') }}" />
@endpush
