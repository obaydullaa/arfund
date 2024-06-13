@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <form class="manualGateway" action="{{ route('admin.gateway.manual.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Manual Gateway Information Start --}}
                <div class="card-two mb-4">
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-body">
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="image" class="mb-2" >@lang('Image')<span class="text-danger">*</span></label>
                                            <x-image-uploader class="w-100" id="image" name="image" :imagePath="getImage(getFilePath('gateway') . '/' , getFileSize('gateway'))" :size="getFileSize('gateway')" :required="true" :isImage="false" />
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Gateway Name') <span class="text-danger">*</span></label>
                                            <input type="text" class="form--control w-100" name="name" value="{{ old('name') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-2">@lang('Currency') <span class="text-danger">*</span></label>
                                            <input type="text" name="currency" class="form--control w-100" required value="{{ old('currency') }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-2">@lang('Rate') <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text br-right--0">1 {{ __($general->cur_text) }}=</div>
                                                <input type="number" step="any" class="form--control w-100 br-0" name="rate" required value="{{ old('rate') }}">
                                                <span class="currency_symbol input-group-text br-right"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Manual Gateway Information End --}}

                {{-- Gateway Change Start --}}
                <div class="card-two mb-4">
                    <div class="row gy-4">

                        <div class="col-lg-12">
                            <h5 class="card-title">@lang('Charge and Limit')</h5>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="currency-card">
                                <div class="card--header">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <p>@lang('Range')</p>
                                </div>
                                <div class="current-input-wrap">
                                    <div class="form-group">
                                        <label class="mb-2">@lang('Minimum Amount') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="min_limit" required value="{{ old('min_limit') }}">
                                            <div class="input-group-text br-right">{{ __($general->cur_text) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="mb-2">@lang('Maximum Amount') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="max_limit" required value="{{ old('max_limit') }}">
                                            <div class="input-group-text br-right">{{ __($general->cur_text) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="currency-card">
                                <div class="card--header">
                                    <i class="fa-regular fa-money-bill-1"></i>
                                    <p>@lang('Charge')</p>
                                </div>
                                <div class="current-input-wrap">
                                    <div class="form-group">
                                        <label class="mb-2">@lang('Fixed Charge') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="fixed_charge" required value="{{ old('fixed_charge') }}">
                                            <div class="input-group-text">
                                                {{ __($general->cur_text) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="mb-2">@lang('Percent Charge') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="percent_charge" required value="{{ old('percent_charge') }}">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Gateway Change End --}}

                {{-- Gateway Description Start --}}
                <div class="card-two mb-4">
                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <h5 class="card-title">@lang('Deposit Instruction')</h5>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="form-group">
                                <textarea rows="8" class="form--control summernote" id="instruction" name="instruction">{{ old('instruction') }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Gateway Description End --}}

                {{-- Gateway User Instruction Form Field Start --}}
                <div class="card-two gy-4 mb-5">
                    <div class="row gy-4 align-items-center justify-content-between mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <h5 class="card-title">@lang('User Instruction Field')</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-4 d-flex justify-content-start justify-content-sm-end">
                            <button type="button" class="btn btn--sm  btn--global btn--outline-global float-end form-generate-btn"> <i class="fa-solid fa-plus"></i> @lang('Add New')</button>
                        </div>
                    </div>

                    <div class="row gy-4 addedField">

                    </div>
                </div>
                {{-- Gateway Instruction End --}}

                <div class="row">
                    <div class="col-lg-12 text-end">
                        <button type="submit" class="btn btn-outline-base submitClass">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<x-form-generator />
@endsection

@push('script')
<script>
    "use strict"
    var formGenerator = new FormGenerator();
</script>
<script src="{{ asset('assets/general/js/form_actions.js') }}"></script>
@endpush

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.gateway.manual.index') }}" />
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });

            @if(old('currency'))
                $('input[name=currency]').trigger('input');
            @endif

            var isImage = false;

            $('#image').on('change', function() {
                var fileInput = document.getElementById("image");
                if (fileInput.files && fileInput.files.length > 0) {
                    isImage = true;
                } else {
                    isImage = false;
                }
            });

            $('.manualGateway .submitClass').on('click', function() {
                if (!isImage) {
                    notify('error', 'Please select an image file');
                    return false;
                }
            });


        })(jQuery);
    </script>
@endpush
