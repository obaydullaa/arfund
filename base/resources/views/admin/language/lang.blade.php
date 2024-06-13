@extends('admin.layouts.app')
@section('panel')

    <div class="row gy-4   mb-5 row align-items-center">
        <div class="col-xl-12">
            <div class="card-two mb-5">
                <div class="card-header">
                    <div class="row">
                        @include('admin.partials.tab.general')
                    </div>
                </div>
            </div>

            <h5 class="card-title mb-4">@lang('Language Management')</h5>
                <div class="card-body pt-1">
                    <div class="card-two p-0">
                        <div class="table-wrap table-responsive">
                            <table class="table table--responsive--md table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Code')</th>
                                        <th>@lang('Default')</th>
                                        <th class="text-end">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($languages as $item)
                                        <tr>
                                            <td data-label="@lang('Name')">{{ __($item->name) }}</td>
                                            <td data-label="@lang('Code')"><strong>{{ __($item->code) }}</strong></td>
                                            <td data-label="@lang('Default')">
                                                @if ($item->is_default == Status::YES)
                                                    <span class="badge badge--success">@lang('Default')</span>
                                                @else
                                                    <span class="badge badge--warning">@lang('Selectable')</span>
                                                @endif
                                            </td>
                                            <td class="text-end" data-label="@lang('Actions')">
                                                <div class="button--group">
                                                    <a href="{{ route('admin.language.key', $item->id) }}"
                                                        class="btn btn--sm btn-outline--success">
                                                        <i class="fa-solid fa-language"></i> @lang('Translate')
                                                    </a>
                                                    <a href="javascript:void(0)" class="btn btn--sm btn-outline-base ms-1 editBtn" data-url="{{ route('admin.language.manage.update', $item->id) }}" data-lang="{{ json_encode($item->only('name', 'text_align', 'is_default')) }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    @if ($item->id != 1)
                                                        <button class="btn btn--sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to remove this language from this system?')" data-action="{{ route('admin.language.manage.delete', $item->id) }}" {{ $item->is_default == Status::YES && $item->id != 1 ? 'disabled' : ''}}>
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td data-label="{{ $pageTitle }}" class="text-muted text-center" colspan="4">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="createModalLabel"> @lang('Add New Language')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('admin.language.manage.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <label class="mb-2">@lang('Language Name')</label>
                            <div class="col-sm-12">
                                <input type="text" class="form--control w-100" value="{{ old('name') }}" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="mb-2">@lang('Language Code')</label>
                            <div class="col-sm-12">
                                <input type="text" class="form--control w-100" value="{{ old('code') }}" name="code"
                                    required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="mb-1" for="is_default_add">@lang('Defaulat Language Status')</label><br>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" id="is_default_add" name="is_default">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">@lang('Edit Language')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-2">@lang('Language Name')</label>
                            <div class="col-sm-12">
                                <input type="text" class="form--control w-100" value="{{ old('name') }}" name="name" required>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label class="mb-1" for="is_default">@lang('Defaulat Language Status')</label><br>
                            <div class="form--switch">
                                <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" id="is_default" name="is_default">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="getLangModal" tabindex="-1" role="dialog" aria-labelledby="getLangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="getLangModalLabel">@lang('Language Keywords')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">@lang('All of the possible language keywords are available here. However, some keywords may be missing due to variations in the database. If you encounter any missing keywords, you can add them manually.')</p>
                    <p class="text--primary mb-3">@lang('You can import these keywords from the translate page of any language as well.')</p>
                    <div class="form-group copy-texts-wrapper position-relative">
                        <div class="copy-texts">
                            <span class="copy">@lang('Copy')</span>
                        </div>
                        <textarea name="" class="form-control langKeys key-added" id="langKeys" rows="25" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection


@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start">
        <button type="button" class="btn btn--sm btn-outline-base me-2" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> @lang('Add New')</button>
        <button type="button" class="btn btn--sm btn-outline-base keyBtn" data-bs-toggle="modal" data-bs-target="#getLangModal"><i class="fa-solid fa-code"></i> @lang('Keywords')</button>
    </div>
@endpush

@push('style')
    <style>
        .copy-texts-wrapper:hover .copy-texts {
            visibility: visible;
            opacity: 1;
        }

        .copy-texts {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 99;
            background: hsl(var(--black));
            width: 99%;
            height: 100%;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: .3s;
            cursor: pointer;
        }

        .copy-texts .copy {
            color: hsl(var(--white));
            font-size: 40px;
            border-radius: 5px;
            background-color: transparent;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.editBtn').on('click', function() {
                var modal = $('#editModal');
                var url = $(this).data('url');
                var lang = $(this).data('lang');
                modal.find('form').attr('action', url);
                modal.find('input[name=name]').val(lang.name);
                modal.find('select[name=text_align]').val(lang.text_align);
                if (lang.is_default == 1) {
                    modal.find('input[name=is_default]').prop('checked', true);
                } else {
                    modal.find('input[name=is_default]').prop('checked', false);
                }
                modal.modal('show');
            });

            $('.keyBtn').on('click', function(e) {
                e.preventDefault();
                $.get("{{ route('admin.language.get.key') }}", {}, function(data) {
                    $('.langKeys').text(data);
                });
            });

            $('.copy-texts').on('click', function() {
                var copyText = document.getElementById("langKeys");
                copyText.select();
                document.execCommand("copy");
                $('.copy').text('Copied');
                setTimeout(() => {
                    $('.copy').text('Copy');
                }, 2000);

            });

        })(jQuery);
    </script>
@endpush
