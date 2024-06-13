@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two">
                <div class="align-items-center border-0 d-flex flex-wrap justify-content-between mb-4">
                    <h5 class="card--title">@lang('KYC Form for User')</h5>
                    <button type="button" class="btn btn--sm btn-outline-base float-end form-generate-btn"><i class="fa-solid fa-plus"></i> @lang('Add New')</button>
                </div>
                <div class="card-body">
                    <form  method="post">
                        @csrf
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
                                                <input type="hidden" name="form_generator[placeholder][]" value="{{ $formData->placeholder }}">

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
                                                        'placeholder'=>$formData->placeholder
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
                        <div class="row mt-4">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
