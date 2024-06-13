@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="pb-4">
                <h4 class="card-title">@lang('Frontend Pages')</h4>
            </div>
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Slug')</th>
                            <th>@lang('Header Menu')</th>
                            <th>@lang('Footer Menu')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pdata as $k => $data)
                            <tr>
                                <td data-label="@lang('Name')">{{ __($data->name) }}</td>
                                <td data-label="@lang('Slug')">{{ __($data->slug) }}</td>
                                <td data-label="@lang('Header Status')">@php echo @$data->headerBadge; @endphp</td>
                                <td data-label="@lang('Footer Status')"> @php echo @$data->footerBadge; @endphp</td>
                                <td class="text-end" data-label="@lang('Action')">
                                    <div class="button--group">
                                        <a href="{{ route('admin.frontend.manage.section', $data->id) }}" class="btn btn--sm btn-outline-base">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @if($data->is_default == Status::NO)
                                            <button class="btn btn--sm btn-outline-danger confirmationBtn"
                                            data-action="{{ route('admin.frontend.manage.pages.delete',$data->id) }}"
                                            data-question="@lang('Are you sure to remove this page?')">
                                            <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="5">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="row gy-4  mb-5">
        <div class="col-lg-12">
            <div class="pb-4">
                <h4 class="card-title">@lang('Policy Pages')</h4>
            </div>
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
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
                                <th class="text-end">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td data-label="@lang('Cookie')">@lang('Cookie Policy')</td>
                                <td data-label="@lang('Action')" class="text-end">
                                    <a title="@lang('Edit')" href="{{ route('admin.setting.cookie') }}"
                                        class="btn btn--sm btn-outline-base"><i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            @forelse($elements as $data)
                                <tr>
                                    @if (@$section->element->images)
                                        @php $firstKey = collect($section->element->images)->keys()[0]; @endphp
                                        <td data-label="@lang('Image')">
                                            <div class="customer-details d-block">
                                                <a href="javascript:void(0)" class="thumb">
                                                    <img src="{{ getImage('assets/images/frontend/' . $key . '/' . @$data->data_values->$firstKey, @$section->element->images->$firstKey->size) }}"
                                                        alt="@lang('image')">
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
                                                    <td data-label="@lang('Title')">{{ __(@$data->data_values->$k) }}</td>
                                                @endif
                                            @elseif($k == 'select')
                                                @php
                                                    $dataVal = @$section->element->$k->name;
                                                @endphp
                                                <td data-label="@lang('Title')">{{ @$data->data_values->$dataVal }}</td>
                                            @endif
                                        @endif
                                    @endforeach
                                    <td data-label="@lang('Action')" class="text-end">
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
                                                <a href="javascript:void(0)" title="@lang('Edit')"
                                                    class="btn btn--sm btn-outline-base updateBtn"
                                                    data-id="{{ $data->id }}"
                                                    data-all="{{ json_encode($data->data_values) }}"
                                                    @if (@$section->element->images) data-images="{{ json_encode($images) }}" @endif>
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            @else
                                                <a title="@lang('Edit')"
                                                    href="{{ route('admin.frontend.sections.element', [$key, $data->id]) }}"
                                                    class="btn btn--sm btn-outline-base"><i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            @endif

                                            @if($data->id !== 42 && $data->id != 43)
                                            <button title="@lang('Remove')"
                                                class="btn btn--sm btn-outline-danger confirmationBtn"
                                                data-action="{{ route('admin.frontend.remove', $data->id) }}"
                                                data-question="@lang('Are you sure to remove this item?')"><i class="fa-solid fa-trash"></i></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
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
                    <h5 class="modal-title"> @lang('Add New Page')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('admin.frontend.manage.pages.save')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-2"> @lang('Page Name')</label>
                            <input type="text" class="form--control w-100" name="name" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-2"> @lang('Slug')</label>
                            <input type="text" class="form--control w-100" name="slug" value="{{old('slug')}}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
<div class="text-lg-end text-md-end text-start">
    <button type="button" class="btn btn--sm btn--global btn-outline-global text-white addBtn"><i class="fa-solid fa-plus"></i> @lang('Frontend Page')</button>

    <a href="{{ route('admin.frontend.sections.element', $key) }}" class="btn btn--sm btn--global btn-outline-global text-white"><i class="fa-solid fa-plus"></i> @lang('Policy Page')</a>
</div>
@endpush

@push('script')
<script>
    (function ($) {
        "use strict";

        function generateSlug(title) {
            return title.trim()
                        .toLowerCase()
                        .replace(/\s+/g, '-')
                        .replace(/[^\w\-]+/g, '')
                        .replace(/\-\-+/g, '-')
                        .replace(/^-+/, '')
                        .replace(/-+$/, '');
        }


        $('input[name="name"]').on('input', function () {
            var title = $(this).val();
            var slug = generateSlug(title);
            $('input[name="slug"]').val(slug);
        });

        $('.addBtn').on('click', function () {
            var modal = $('#addModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

    })(jQuery);
</script>
@endpush

