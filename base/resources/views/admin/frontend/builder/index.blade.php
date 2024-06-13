@extends('admin.layouts.app')
@section('panel')
    <div class="row  mb-3">
        <div class="col-md-12">
            <div class="card-two">
                <div class="card-body">
                    <form action="{{ route('admin.frontend.manage.pages.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $pdata->id }}">
                        <div class="row align-items-center justify-content-between">
                            @if ($pdata->is_default == Status::NO)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mb-2">@lang('Page Name')</label>
                                        <input type="text" class="form--control w-100" name="name" value="{{ $pdata->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mb-2">@lang('Page Slug')</label>
                                        <input type="text" class="form--control w-100" name="slug" value="{{ $pdata->slug }}" required>
                                    </div>
                                </div>
                            @else
                                <input type="text" class="form-control" name="name" value="{{ $pdata->name }}" required hidden>
                                <input type="text" class="form-control" name="slug" value="{{ $pdata->name == 'Home' ? '/' : $pdata->slug }}" required hidden>
                            @endif
                            <div class="col-md-2 {{ $pdata->name === 'Home' ? 'd-none' : ''}}">
                                <label class="mb-2" for="header_status">@lang('Header Menu')</label><br>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" id="header_status" @if(@$pdata->header_status) checked @endif name="header_status">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="mb-2" for="footer_status">@lang('Footer Menu')</label><br>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" id="footer_status" @if(@$pdata->footer_status) checked @endif name="footer_status">
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row   mb-5">
        <div class="col-md-5 mt-md-0 mt-3">
            <div class="card-two">
                <div class="card-body">
                    <div class="card-content mb-4">
                        <h5 class="card-title">@lang('Available Sections')</h5>
                        <small class="text--primary">@lang('Drag sections to the left and update the page')</small>
                    </div>
                    <ul class="simple_with_no_drop vertical">
                        @foreach ($sections as $k => $secs)
                            @if (!@$secs['no_selection'])
                                <li class="section-item drag-item clearfix c-pointer">
                                    <div class="item-icon-wrap">
                                        <i class=" fa fa-arrows-alt"></i>
                                    </div>
                                    <div class="d-inline-block  fw-bold me-auto ms-2"> {{ __($secs['name']) }}</div>
                                    <div class="remove-btn">
                                        <i class="drop-item fa fa-times"></i>
                                    </div>
                                    <input type="hidden" name="secs[]" value="{{ $k }}">
                                    @if ($secs['builder'])
                                        <div class="float-end d-inline-block manage-content">
                                            <a href="{{ route('admin.frontend.sections', $k) }}" target="_blank"
                                                class="btn btn--global btn--sm btn--outline-global text-center cog-btn ms-3"
                                                title="@lang('Manage Content')">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </div>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-two">
                <div class="card-body">
                    <div class="card-content mb-4">
                        <h5 class="card-title">{{ __($pdata->name) }} @lang('Page')</h5>
                    </div>
                    <div class="drop-box">
                        <div class="drop-placeholder">
                            <i class="fa-solid fa-arrows-to-circle"></i>
                            <p>@lang('Drag Your Component Hare')</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.frontend.manage.section.update', $pdata->id) }}" method="post">
                        @csrf
                        <ul class="simple_with_drop vertical sec-item mb-3">
                            @if ($pdata->secs != null)
                                @foreach (json_decode($pdata->secs) as $sec)
                                    <li class="section-item drag-item item">
                                        <div class="item-icon-wrap">
                                            <i class=" fa fa-arrows-alt"></i>
                                        </div>
                                        <div class="d-inline-block me-auto ms-4 fw-bold"> {{ __(@$allsections[$sec]['name']) }}
                                        </div>
                                        <div class="remove-btn">
                                            <i class="drop-item fa fa-times cursor-pointer"></i>
                                        </div>
                                        <input type="hidden" name="secs[]" value="{{ $sec }}">
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Update')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.frontend.manage.pages') }}" />
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/jquery-sortable.js') }}"></script>
@endpush

@push('style')
    <style>
        ::selection {
            color: hsl(var(--black));
            background: transparent;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";

        $(document).ready(function() {
            var $availableSectionsList = $("ul.simple_with_no_drop");
            var $pageSectionsList = $("ul.simple_with_drop");

            $availableSectionsList.sortable({
                group: 'no-drop',
                handle: '.drag-item',
                onStart: function (e) {
                    var $item = $(e.item);
                    $item.css({ 'z-index': 9999, 'opacity': 0.7 });
                    console.log('start');
                },
                onEnd: function (e) {
                    var $item = $(e.item);
                    $item.removeAttr("style");
                    console.log('end');
                }
            });

            $pageSectionsList.sortable({
                group: 'no-drop',
                handle: '.drag-item',
                onDrop: function($item, container, _super) {
                    $item.removeClass("dragged").removeAttr("style");
                    _super($item, container);

                    var sectionId = $item.find('input[name="secs[]"]').val();
                    $availableSectionsList.find('li.section-item[data-section="' + sectionId + '"]').hide();
                }
            });

            $(document).on('click', "ul.simple_with_drop .remove-btn", function() {
                var $sectionItem = $(this).closest('.section-item.drag-item');
                var sectionId = $sectionItem.find('input[name="secs[]"]').val();

                var $removedSection = $sectionItem.clone();
                $availableSectionsList.append($removedSection);

                $sectionItem.remove();

                var $availableSections = $availableSectionsList.find('li.section-item');
                $availableSections.sort(function(a, b) {
                    return $(a).text().localeCompare($(b).text());
                });
                $availableSectionsList.html($availableSections);
            });

            $(document).on('click', 'ul.simple_with_drop li.section-item.drag-item', function() {
                var sectionId = $(this).find('input[name="secs[]"]').val();
                if ($pageSectionsList.find('li.section-item[data-section="' + sectionId + '"]').length > 1) {
                    alert('This section is already added to the page.');
                }
            });
        });






    </script>
@endpush


