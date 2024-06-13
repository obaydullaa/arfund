@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-md-12">
            <div class="card-two">
                <div class="card-body">
                    <form action="{{ route('admin.frontend.sections.content', $key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="element">
                        @if (@$data)
                            <input type="hidden" name="id" value="{{ $data->id }}">
                        @endif

                        <div class="row">
                            @php
                                $imgCount = 0;
                            @endphp
                            @foreach ($section->element as $k => $content)
                                @if ($k == 'images')
                                    @php
                                        $imgCount = collect($content)->count();
                                    @endphp
                                    @foreach ($content as $imgKey => $image)
                                        <div class="col-md-4">
                                            <input type="hidden" name="has_image[]" value="1">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(keyToTitle($imgKey)) }}</label>
                                                <x-image-uploader class="w-100 d-inline-block" :imagePath="getImage('assets/images/frontend/' . $key . '/' . @$data->data_values->$imgKey, @$section->element->images->$imgKey->size)" name="image_input[{{ @$imgKey }}]" id="image-upload-input{{ $loop->index }}" :size="$section->element->images->$imgKey->size" :required="false" :isImage="@$data ? 'true' : 'false'"/>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="@if ($imgCount > 1) col-md-12 @else col-md-8 @endif">
                                        @push('divend')
                                        </div>
                                    @endpush
                                @elseif($content == 'icon')
                                    <div class="form-group">
                                        <label class="mb-2">{{ keyToTitle($k) }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form--control w-100 iconPicker icon br-right--0" autocomplete="off" name="{{ $k }}" value="{{ @$data->data_values->$k }}" required>
                                            <span class="input-group-text  input-group-addon" data-icon="las la-home"></span>
                                        </div>
                                    </div>
                                @else
                                    @if ($content == 'textarea')
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                                <textarea rows="10" class="form--control w-100" name="{{ $k }}" required>{{ @$data->data_values->$k }}</textarea>
                                            </div>
                                        </div>
                                    @elseif($content == 'textarea-editor')
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="mb-2">  {{ __(keyToTitle(str_replace('_editor', '', $k))) }}</label>
                                                <textarea rows="10" class="form--control w-100 summernote" name="{{ $k }}">{{ @$data->data_values->$k }}</textarea>
                                            </div>
                                        </div>
                                    @elseif($k == 'select')
                                        @php
                                            $selectName = $content->name;
                                        @endphp
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(keyToTitle(@$selectName)) }}</label>
                                                <select class="form--control w-100 form--select select" name="{{ @$selectName }}" required>
                                                    @foreach ($content->options as $selectItemKey => $selectOption)
                                                        <option value="{{ $selectItemKey }}" @if (@$data->data_values->$selectName == $selectItemKey) selected @endif>{{ __($selectOption) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                                <input type="text" class="form--control w-100" name="{{ $k }}" value="{{ @$data->data_values->$k }}" required>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            @stack('divend')
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-start gap-2 align-items-center">
        <x-back route="{{ route('admin.frontend.sections', $key) }}"></x-back>
    </div>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/general/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/general/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
