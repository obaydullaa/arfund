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
                <h5 class="card-title mb-3">@lang('SEO Configuration')</h5>
                <div class="card-body pt-1">
                    <form action="{{ route('admin.frontend.sections.content', 'seo') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="data">
                        <input type="hidden" name="seo_image" value="1">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label class="mb-2">@lang('SEO Image')</label>
                                    <x-image-uploader class="w-100" name="image_input" :imagePath="getImage(getFilePath('seo') . '/' . @$seo->data_values->image,getFileSize('seo'),)" :size="getFileSize('seo')"  :required="false" :isImage="true"/>
                                </div>
                            </div>

                            <div class="col-xl-8 mt-xl-0 mt-4">
                                <div class="form-group select2-parent position-relative">
                                    <label class="mb-2">@lang('Meta Keywords')</label>
                                    <small class="ms-2 mt-2  ">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma'))
                                        @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                                    <select name="keywords[]" class="form--control w-100 select select2-auto-tokenize"
                                        multiple="multiple" required>
                                        @if (@$seo->data_values->keywords)
                                            @foreach ($seo->data_values->keywords as $option)
                                                <option value="{{ $option }}" selected>{{ __($option) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="mb-2">@lang('Meta Description')</label>
                                    <textarea name="description" rows="3" class="form--control w-100" required>{{ @$seo->data_values->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">@lang('Social Title')</label>
                                    <input type="text" class="form--control w-100" name="social_title"
                                        value="{{ @$seo->data_values->social_title }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">@lang('Social Description')</label>
                                    <textarea name="social_description" rows="3" class="form--control w-100" required>{{ @$seo->data_values->social_description }}</textarea>
                                </div>
                                <div class="form-group text-end">
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


@push('script')
    <script>
        (function($) {
            "use strict";
            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.select2-parent'),
                tags: true,
                tokenSeparators: [',']
            });
        })(jQuery);

    </script>
@endpush
