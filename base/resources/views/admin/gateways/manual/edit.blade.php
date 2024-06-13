@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <form action="{{ route('admin.gateway.manual.update', $method->code) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Manual Gateway Information Start --}}
                <div class="card-two mb-4">
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-body">
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <x-image-uploader class="w-100" id="image" name="image" :imagePath="getImage(getFilePath('gateway') . '/' . @$method->image, getFileSize('gateway'))" :size="getFileSize('gateway')" :required="false" :isImage="true" />
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Gateway Name')</label>
                                            <input type="text" class="form--control w-100" name="name" value="{{ $method->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-2">@lang('Currency')</label>
                                            <input type="text" name="currency" class="form--control w-100" value="{{ @$method->singleCurrency->currency }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-2">@lang('Rate')</label>
                                            <div class="input-group">
                                                <div class="input-group-text br-right--0">1 {{ __($general->cur_text) }}=</div>
                                                <input type="number" step="any" class="form--control w-100 br-0" name="rate" value="{{ getAmount(@$method->singleCurrency->rate) }}" required>
                                                <span class="currency_symbol input-group-text br-left--0"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Manual Gateway Information End --}}

                {{-- Gateway Instruction Start --}}
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
                                        <label class="mb-2">@lang('Minimum Amount')</label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="min_limit" value="{{ getAmount(@$method->singleCurrency->min_amount) }}" required>
                                            <div class="input-group-text br-right">{{ __($general->cur_text) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="mb-2">@lang('Maximum Amount')</label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="max_limit" value="{{ getAmount(@$method->singleCurrency->max_amount) }}" required>
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
                                        <label class="mb-2">@lang('Fixed Charge')</label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="fixed_charge" value="{{ getAmount(@$method->singleCurrency->fixed_charge) }}" required>
                                            <div class="input-group-text br-right">
                                                {{ __($general->cur_text) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="mb-2">@lang('Percent Charge')</label>
                                        <div class="input-group">
                                            <input type="number" step="any" class="form--control w-100 br-right--0" name="percent_charge" value="{{ getAmount(@$method->singleCurrency->percent_charge) }}" required>
                                            <div class="input-group-text br-right">%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Gateway Instruction End --}}

                {{-- Gateway Deposit Instruction Start --}}
                <div class="card-two mb-4">
                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <h5 class="card-title">@lang('Deposit Instruction')</h5>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea rows="8" class="form--control summernote" id="instruction" name="instruction">{{ __(@$method->description)  }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Gateway Deposit Instruction End --}}

                {{-- Gateway User Instruction Form Field Start --}}
                <div class="card-two gy-4 mb-5">
                    <div class="row gy-4 align-items-center justify-content-between mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <h5 class="card-title">@lang('User Instruction Field')</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-4 d-flex justify-content-start justify-content-sm-end">
                            <button type="button" class="btn btn--sm btn--global btn--outline-global float-end form-generate-btn"> <i class="fa-solid fa-plus"></i> @lang('Add New')</button>
                        </div>
                    </div>
                    <div class="row gy-4 addedField">
                        @if($form)
                            @foreach($form->form_data as $formData)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="currency-card" id="{{ $loop->index }}">
                                        <button type="button" class="frombtn-remove removeFormData"><i class="fa-solid fa-xmark"></i></button>
                                        <div class="current-input-wrap">
                                            <input type="hidden" name="form_generator[is_required][]" value="{{ $formData->is_required }}">
                                            <input type="hidden" name="form_generator[extensions][]" value="{{ $formData->extensions }}">
                                            <input type="hidden" name="form_generator[options][]" value="{{ implode(',',$formData->options) }}">
                                            <input type="hidden" name="form_generator[placeholder][]" value="{{ @$formData->placeholder }}">
                                            <div class="form-group">
                                                <label class="mb-2">@lang('Label')</label>
                                                <input type="text" class="form--control w-100" name="form_generator[form_label][]" value="{{ $formData->name }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="mb-2">@lang('Type')</label>
                                                <input type="text" name="form_generator[form_type][]" class="form--control w-100" value="{{ $formData->type }}" readonly>
                                            </div>

                                            @php
                                                $jsonData = json_encode([
                                                    'type'=>$formData->type,
                                                    'is_required'=>$formData->is_required,
                                                    'label'=>$formData->name,
                                                    'extensions'=>explode(',',$formData->extensions) ?? 'null',
                                                    'options'=>$formData->options,
                                                    'old_id'=>'',
                                                    'placeholder'=>@$formData->placeholder
                                                ]);
                                            @endphp
                                        </div>
                                        <div class="btn-wrap">
                                            <button type="button" class="btn btn--global text-white w-100 editFormData" data-form_item="{{ $jsonData }}" data-update_id="{{ $loop->index }}"><i class="fa-solid fa-pen-to-square"></i> @lang('Edit')</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                {{-- Gateway User Instruction Form Field End --}}


                <div class="row">
                    <div class="col-lg-12 text-end">
                        <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
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
        formGenerator.totalField = {{ $form ? count((array) $form->form_data) : 0 }}
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
            $('.currency_symbol').text($('input[name=currency]').val());

            @if(old('currency'))
            $('input[name=currency]').trigger('input');
            @endif
        })(jQuery);

    </script>
@endpush
