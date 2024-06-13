@extends('admin.layouts.app')

@section('panel')
    @if (@$section->content)
        <div class="row gy-4   mb-5">
            <div class="col-lg-12 col-md-12 mt-md-3 mt-0">
                <div class="card-two">
                    <div class="card-body">
                        <form action="{{ route('admin.frontend.sections.content', $key) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="content">
                            <div class="row">
                                @php
                                    $imgCount = 0;
                                @endphp
                                @foreach ($section->content as $k => $item)
                                    @if ($k == 'images')
                                        @php
                                            $imgCount = collect($item)->count();
                                        @endphp
                                        @foreach ($item as $imgKey => $image)
                                            <div class="col-md-4">
                                                <input type="hidden" name="has_image" value="1">
                                                <div class="form-group">
                                                    <label class="required mb-2">{{ __(keyToTitle(@$imgKey)) }}</label>
                                                    <x-image-uploader class="w-100" name="image_input[{{ @$imgKey }}]" :imagePath="getImage('assets/images/frontend/' . $key . '/' . @$content->data_values->$imgKey, @$section->content->images->$imgKey->size)" id="image-upload-input{{ $loop->index }}" :size="$section->content->images->$imgKey->size" :required="false" :isImage="true"/>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="@if ($imgCount > 1) col-md-12 @else col-md-8 @endif">
                                            @push('divend')
                                            </div>
                                        @endpush
                                    @else
                                        @if ($k != 'images')
                                            @if ($item == 'icon')
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form--control w-100 iconPicker icon br-right--0" autocomplete="off" name="{{ $k }}" value="{{ $content->data_values->$k }}" required>
                                                            <span class="input-group-text  input-group-addon" data-icon="las la-home"> @php echo $content->data_values->$k; @endphp</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($item == 'textarea')
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                                        <textarea rows="10" class="form--control w-100" name="{{ $k }}" required>{{ @$content->data_values->$k }}</textarea>
                                                    </div>
                                                </div>
                                            @elseif($item == 'textarea-editor')
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">  {{ __(keyToTitle(str_replace('_editor', '', $k))) }}</label>
                                                        <textarea rows="10" class="form--control w-100 summernote" name="{{ $k }}">{{ @$content->data_values->$k }}</textarea>
                                                    </div>
                                                </div>
                                            @elseif($k == 'select')
                                                @php
                                                    $selectName = $item->name;
                                                @endphp
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">{{ __(keyToTitle(@$selectName)) }}</label>
                                                        <select class="form--control w-100 form-select select" name="{{ @$selectName }}">
                                                            @foreach ($item->options as $selectItemKey => $selectOption)
                                                                <option value="{{ $selectItemKey }}" @if (@$content->data_values->$selectName == $selectItemKey) selected @endif>{{ $selectOption }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                                        <input type="text" class="form--control w-100" name="{{ $k }}" value="{{ @$content->data_values->$k }}" required>
                                                    </div>
                                                </div>
                                            @endif
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
    @endif

    @if (@$section->element)
        <div class="row mb-3 ">

            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <form method="get" class="mb-2">
                    <div class="input-group ">
                        <input type="text" name="search_table" class="form--control br-right--0" placeholder="@lang('Search')...">
                        <button class="btn btn-outline-base input-group-text"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                @if (@$section->element)
                    @if ($section->element->modal)
                        <a href="javascript:void(0)" class="btn btn--sm mb-2 btn--global btn--outline-global addBtn"><i class="fa-solid fa-plus"></i> @lang('Add New')</a>
                    @else
                        <a href="{{ route('admin.frontend.sections.element', $key) }}" class="btn btn--sm mb-2 btn--global btn--outline-global"><i class="fa-solid fa-plus"></i> @lang('Add New')</a>
                    @endif
                @endif
              </div>

        </div>

        <div class="row gy-4  mb-5">
            <div class="col-lg-12">
                <div class="card-two p-0">
                    <div class="table-wrap table-responsive search-table-content">
                        <table class="table table--responsive--md table-hover">
                            <thead>
                                <tr>
                                    @if (@$section->element->images)
                                        <th>@lang('Image')</th>
                                    @endif
                                    @foreach ($section->element as $k => $type)
                                        @if ($k != 'modal')
                                            @if ($type == 'text' || $type == 'icon')
                                                <th>{{ __(keyToTitle($k)) }}</th>
                                            @elseif($k == 'select')
                                                <th>{{ keyToTitle(@$section->element->$k->name) }}</th>
                                            @endif
                                        @endif
                                    @endforeach
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($elements as $data)
                                    <tr>
                                        @if (@$section->element->images)
                                            @php $firstKey = collect($section->element->images)->keys()[0]; @endphp
                                            <td data-label="@lang('Image')">
                                                <div class="customer-details d-block">
                                                    <a href="javascript:void(0)" class="thumb">
                                                        <img src="{{ getImage('assets/images/frontend/' . $key . '/' . @$data->data_values->$firstKey, @$section->element->images->$firstKey->size) }}" alt="@lang('image')">
                                                    </a>
                                                </div>
                                            </td>
                                        @endif
                                        @foreach ($section->element as $k => $type)

                                            @if ($k != 'modal')
                                                @if ($type == 'text' || $type == 'icon')
                                                    @if ($type == 'icon')
                                                        <td data-label="@lang('Icon')">@php echo @$data->data_values->$k; @endphp</td>
                                                    @else
                                                        <td data-label="{{ __(keyToTitle($k)) }}">{{ __(@$data->data_values->$k) }}</td>
                                                    @endif
                                                @elseif($k == 'select')
                                                    @php
                                                        $dataVal = @$section->element->$k->name;
                                                    @endphp
                                                    <td>{{ @$data->data_values->$dataVal }}</td>
                                                @endif
                                            @endif
                                        @endforeach
                                        <td data-label="@lang('Action')">
                                            <div class="button--group">
                                                @if ($section->element->modal)
                                                    @php
                                                        $images = [];
                                                        if (@$section->element->images) {
                                                            foreach ($section->element->images as $imgKey => $imgs) {
                                                                $images[] = getImage('assets/images/frontend/' . $key . '/' . @$data->data_values->$imgKey, @$section->element->images->$imgKey->size);
                                                            }
                                                        }
                                                    @endphp
                                                    <button class="btn btn--sm btn-outline-base updateBtn" data-id="{{ $data->id }}" data-all="{{ json_encode($data->data_values) }}" @if (@$section->element->images) data-images="{{ json_encode($images) }}" @endif>
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                @else
                                                    <a href="{{ route('admin.frontend.sections.element', [$key, $data->id]) }}" class="btn btn--sm btn-outline-base"><i class="fa-solid fa-pen-to-square"></i></a>
                                                @endif
                                                <button class="btn btn--sm btn-outline-danger confirmationBtn" data-action="{{ route('admin.frontend.remove', $data->id) }}" data-question="@lang('Are you sure to remove this item?')"><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td data-label="@lang('Content')" class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add METHOD MODAL --}}
        <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add New') {{ __(keyToTitle($key)) }} @lang('Item')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="{{ route('admin.frontend.sections.content', $key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="element">
                        <div class="modal-body">
                            @foreach ($section->element as $k => $type)
                                @if ($k != 'modal')
                                    @if ($type == 'icon')
                                        <div class="form-group">
                                            <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form--control w-100 iconPicker br-right--0 icon" autocomplete="off" name="{{ $k }}" required>
                                                <span class="input-group-text  input-group-addon" data-icon="las la-home"></span>
                                            </div>
                                        </div>
                                    @elseif($k == 'select')
                                        <div class="form-group">
                                            <label class="mb-2">{{ keyToTitle(@$section->element->$k->name) }}</label>
                                            <select class="form--control w-100 form-select select" name="{{ @$section->element->$k->name }}">
                                                @foreach ($section->element->$k->options as $selectKey => $options)
                                                    <option value="{{ $selectKey }}">{{ $options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($k == 'images')
                                        @foreach ($type as $imgKey => $image)
                                            <input type="hidden" name="has_image" value="1">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(keyToTitle($imgKey)) }}</label>
                                                <x-image-uploader class="w-100" name="image_input[{{ @$imgKey }}]" :imagePath="getImage('assets/images/frontend/' . $key . '/' . @$content->data_values->$imgKey, @$section->element->images->$imgKey->size)" id="addImage{{ $loop->index }}" :size="$section->element->images->$imgKey->size" />
                                            </div>
                                        @endforeach
                                    @elseif($type == 'textarea')
                                        <div class="form-group">
                                            <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                            <textarea rows="4" class="form--control w-100" name="{{ $k }}" required></textarea>
                                        </div>
                                    @elseif($type == 'textarea-editor')
                                        <div class="form-group">
                                            <label class="mb-2">  {{ __(keyToTitle(str_replace('_editor', '', $k))) }}</label>
                                            <textarea rows="4" class="form--control w-100 summernote" name="{{ $k }}"></textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="mb-2">{{ __(keyToTitle($k)) }}</label>
                                            <input type="text" class="form--control w-100" name="{{ $k }}" required>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-lg-12 text-end">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Update METHOD MODAL --}}
        <div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Update') {{ __(keyToTitle($key)) }} @lang('Item')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="{{ route('admin.frontend.sections.content', $key) }}" class="edit-route" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="element">
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            @foreach ($section->element as $k => $type)
                                @if ($k != 'modal')
                                    @if ($type == 'icon')
                                        <div class="form-group">
                                            <label class="mb-2">{{ keyToTitle($k) }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form--control w-100 iconPicker icon br-right--0" autocomplete="off" name="{{ $k }}" required>
                                                <span class="input-group-text  input-group-addon" data-icon="fa fa-home"></span>
                                            </div>
                                        </div>
                                    @elseif($k == 'select')
                                        <div class="form-group">
                                            <label class="mb-2">{{ keyToTitle(@$section->element->$k->name) }}</label>
                                            <select class="form--control w-100 form-select select" name="{{ @$section->element->$k->name }}">
                                                @foreach ($section->element->$k->options as $selectKey => $options)
                                                    <option value="{{ $selectKey }}">{{ $options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($k == 'images')
                                        @foreach ($type as $imgKey => $image)
                                            <input type="hidden" name="has_image" value="1">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(keyToTitle($imgKey)) }}</label>
                                                <x-image-uploader class="w-100" :imagePath="getImage('', $section->element->images->$imgKey->size)" name="image_input[{{ @$imgKey }}]" id="updateImage{{ $loop->index }}" :size="$section->element->images->$imgKey->size" :required="false" />
                                            </div>
                                        @endforeach
                                    @elseif($type == 'textarea')
                                        <div class="form-group">
                                            <label class="mb-2">{{ keyToTitle($k) }}</label>
                                            <textarea rows="4" class="form--control w-100" name="{{ $k }}" required></textarea>
                                        </div>
                                    @elseif($type == 'textarea-editor')
                                        <div class="form-group col-lg-12">
                                            <label class="mb-2">  {{ __(keyToTitle(str_replace('_editor', '', $k))) }}</label>
                                            <textarea rows="4" class="form--control w-100 summernote" name="{{ $k }}"></textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="mb-2">{{ keyToTitle($k) }}</label>
                                            <input type="text" class="form--control w-100" name="{{ $k }}" required>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-lg-12 text-end">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endif
    {{-- if section element end --}}

    <x-confirmation-modal />

@endsection

@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start  mb-3">

    @if (!empty($templates))
        <div class="form-inline float-sm-end">
            <form action="{{ route('admin.frontend.import', $key) }}" method="post">
                <div class="input-group">
                    @csrf
                    <select name="template_name" class="form--control form-control-sm form--select select h-auto">
                        <option value="">@lang('Select One')</option>
                        @foreach ($templates as $template)
                            <option value="{{ $template['name'] }}">{{ __(keyToTitle($template['name'])) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="input-group-text btn btn-sm btn-outline-base">@lang('Import')</button>
                </div>
            </form>
        </div>
    @endif
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
            $('.addBtn').on('click', function() {
                var modal = $('#addModal');
                modal.modal('show');
            });

            $('.updateBtn').on('click', function() {
                var modal = $('#updateBtn');
                modal.find('input[name=id]').val($(this).data('id'));

                var obj = $(this).data('all');
                var images = $(this).data('images');

                if (images) {
                    modal.find('.thumb_area .image').removeClass('d-none');
                    modal.find('.browse-mage-container .content-wrap').addClass('d-none');
                    for (var i = 0; i < images.length; i++) {
                        var imgloc = images[i];
                        var dynamicIdName = '#containerArea_updateImage' + i + ' img';
                        $(dynamicIdName).attr('src', imgloc);
                    }
                }
                $.each(obj, function(index, value) {
                    console.log(index, value);
                    if (index.includes('_icon')) {
                        modal.find('[name=' + index + ']').val(value);
                        modal.find('.input-group-text.input-group-addon').text('');
                        modal.find('.input-group-text.input-group-addon').html(value);
                    }else if(index.includes('_editor'))
                    {
                        modal.find('[name=' + index + ']').val(value);
                        modal.find('[name='+index + ']').summernote('code', value);
                    }
                     else {
                        modal.find('[name=' + index + ']').val(value);
                    }
                });
                modal.modal('show');
            });

            $('#updateBtn').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('#addModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
            });




        })(jQuery);
    </script>
@endpush
