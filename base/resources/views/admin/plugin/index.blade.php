@extends('admin.layouts.app')

@section('panel')

<div class="row gy-4   mb-5 align-items-center">
    <div class="col-md-12">
        <div class="card-two mb-5">
            <div class="card-header">
                <div class="row">
                    @include('admin.partials.tab.general')
                </div>
            </div>
        </div>
        <h5 class="card-title mb-3">@lang('Plugins')</h5>
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Logo')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($plugins  as $item)
                            <tr>
                                <td data-label="@lang('Logo')">
                                    <div class="logo-img">
                                        <img class="thumb" src="{{ getImage(getFilePath('plugins') .'/'. $item->image,getFileSize('plugins')) }}" alt="{{ __($item->name) }}">
                                    </div>
                                </td>
                                <td data-label="@lang('Name')">
                                    {{ __($item->name) }}
                                </td>
                                <td data-label="@lang('Status')">
                                    @php
                                        echo $item->statusBadge;
                                    @endphp
                                </td>
                                <td data-label="@lang('Action')">
                                    <div class="button--group">
                                        <button type="button" title="@lang('Configuration')" class="btn btn--sm btn-outline-base ms-1 mb-2 editBtn"
                                                data-name="{{ __($item->name) }}"
                                                data-shortcode="{{ json_encode($item->shortcode) }}"
                                                data-action="{{ route('admin.plugins.update', $item->id) }}">
                                            <i class="fa-solid fa-gears"></i>
                                        </button>

                                        @if($item->status == Status::DISABLE)
                                            <button type="button" title="@lang('Enable')"
                                                    class="btn btn--sm btn-outline--success ms-1 mb-2 confirmationBtn"
                                                    data-action="{{ route('admin.plugins.status', $item->id) }}"
                                                    data-question="@lang('Are you sure to enable this extension?')">
                                                    <i class="fa-regular fa-eye"></i>
                                            </button>
                                        @else
                                            <button type="button" title="@lang('Disable')" class="btn btn--sm btn-outline--danger mb-2 confirmationBtn"
                                            data-action="{{ route('admin.plugins.status', $item->id) }}"
                                            data-question="@lang('Are you sure to disable this extension?')">
                                            <i class="fa-regular fa-eye-slash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- EDIT METHOD MODAL --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Plugin'): <span class="plugin-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Script')</label>
                                    <textarea name="script" class="form--control w-100" required rows="8" placeholder="@lang('Paste your script with proper key')">{{ old('script') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn--md btn-outline-base" id="editBtn">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";

            $(document).on('click', '.editBtn',function () {
                var modal = $('#editModal');
                var shortcode = $(this).data('shortcode');

                modal.find('.plugin-name').text($(this).data('name'));
                modal.find('form').attr('action', $(this).data('action'));

                var html = '';
                $.each(shortcode, function (key, item) {
                    html += `<div class="form-group">
                        <label class="col-md-12 mb-2">${item.title}</label>
                        <div class="col-md-12">
                            <input name="${key}" class="form--control w-100" placeholder="--" value="${item.value}" required>
                        </div>
                    </div>`;
                })
                modal.find('.modal-body').html(html);

                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
