@extends('admin.layouts.app')
@section('panel')
<div class="row gy-4   mb-5 align-items-center">
    <div class="col-xl-12">
        <div class="card-two mb-4">
            <div class="card-header">
                <div class="row">
                    @include('admin.partials.tab.general')
                </div>

            </div>
        </div>

        <div class="card-two">
            <h5 class="card-title mb-3">@lang('Maintainance View')</h5>
            <div class="card-body pt-1">
                <form method="post">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <label class="mb-1" for="status">@lang('Maintainance Status')</label><br>
                            <div class="form--switch">
                                <input type="checkbox" role="switch" class="me-2 form-check-input"
                                    data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" id="status" @if(@$general->maintenance_mode) checked @endif name="status">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">@lang('Description')</label>
                                <textarea class="form--control w-100 summernote" rows="10" name="description">@php echo @$maintenance->data_values->description @endphp</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 text-end">
                            <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
