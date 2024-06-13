@extends('admin.layouts.app')
@section('panel')

    <div class="app row gy-4   mb-5 row align-items-center">
        <div class="col-xl-12">
            <div class="card-two mb-5">
                <div class="card-header">
                    <div class="row">
                        @include('admin.partials.tab.general')
                    </div>
                </div>
            </div>


            <h5 class="card-title mb-4">@lang('Language Keywords of') {{ __($lang->name) }}</h5>

            <div class="row justify-content-between mb-4">
                <div class="col-md-12">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#searchAndReplaceModal"
                        class="btn btn-sm btn-outline-base me-2"><i class="fas fa-exchange-alt"></i>
                        @lang('Search And Replace') </button>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#addModal"
                        class="btn btn-sm btn-outline-base"><i class="fa fa-plus"></i> @lang('Add New Key')
                    </button>
                </div>
            </div>




                <div class="card-two p-0">
                    <div class="table-wrap table-responsive">
                        <table class="table table--responsive--md table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        @lang('Key')
                                    </th>
                                    <th>
                                        {{ __($lang->name) }}
                                    </th>

                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($json as $k => $language)
                                    <tr>
                                        <td data-label="@lang('Key')" class="white-space-wrap">
                                            {{ strLimit($k, 40) }}
                                        </td>
                                        <td data-label="{{ __($lang->name) }}" class="text-left white-space-wrap">
                                             {{ strLimit($language, 40) }}
                                        </td>

                                        <td data-label="@lang('Action')">

                                            <a href="javascript:void(0)" data-bs-target="#editModal" data-bs-toggle="modal" data-title="{{ $k }}" data-key="{{ $k }}" data-value="{{ $language }}" class="editModal btn btn--sm btn-outline-base" data-bs-toggle="tooltip" data-bs-title="@lang('Edit')">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-key="{{ $k }}"
                                                data-value="{{ $language }}" data-bs-toggle="modal"
                                                data-bs-target="#DelModal"
                                                class="btn btn--sm btn-outline--danger deleteKey"
                                                 data-bs-title="@lang('Delete')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td data-label="{{ $pageTitle }}" colspan="3" class="text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                @if ($json->hasPages())
                    <div class="card-footer py-4">
                        @php
                            echo paginateLinks($json);
                        @endphp
                    </div>
                @endif
            </div>
        </div>



        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel"> @lang('Add New')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.language.store.key', $lang->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="key" class="mb-2">@lang('Key')</label>
                            <input type="text" class="form--control w-100" id="key" name="key"
                                value="{{ old('key') }}" required>

                        </div>
                        <div class="form-group">
                            <label for="value" class="mb-2">@lang('Value')</label>
                            <input type="text" class="form--control w-100" id="value" name="value"
                                value="{{ old('value') }}" required>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base"> @lang('Save')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">@lang('Edit')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.language.update.key', $lang->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="inputName" class="form-title"></label>
                            <textarea class="form--control w-100" name="value" required></textarea>
                        </div>
                        <input type="hidden" name="key">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Update')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="DelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DelModalLabel"> @lang('Confirmation Alert!')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure to delete this key from this language?')</p>
                </div>
                <form action="{{ route('admin.language.delete.key', $lang->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="key">
                    <input type="hidden" name="value">
                    <div class="modal-footer">
                        <button type="button" class="btn btn--md btn-outline-dark" data-bs-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    {{-- Import Modal --}}
    <div class="modal fade" id="importModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Import Keywords')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-2">@lang('Import From')</label>
                        <select class="form--control select form--select w-100 select_lang" required>
                            <option value="">@lang('Select One')</option>
                            <option value="999">@lang('System')</option>
                            @foreach ($list_lang as $data)
                                <option value="{{ $data->id }}"
                                    @if ($data->id == $lang->id) class="d-none" @endif>{{ __($data->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark"
                        data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="button" class="btn btn--md btn-outline-base import_lang"> @lang('Import Now')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="searchAndReplaceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel"> @lang('Search and Replace ')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.language.manage.search.replace') }}" method="get">
                    @csrf
                    <input type="hidden" name="id" value="{{ $lang->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="key" class="mb-2">@lang('Search Keyword')</label>
                            <input type="text" class="form--control w-100" id="key" name="key"
                                value="{{ old('key') }}" required>

                        </div>
                        <div class="form-group">
                            <label for="value" class="mb-2">@lang('Replace Value')</label>
                            <input type="text" class="form--control w-100" id="value" name="value"
                                value="{{ old('value') }}" required>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base"> @lang('Replace')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
<div class="d-flex gap-2">
    <x-search-form placeholder="Search keywords" />
    <button type="button" class="btn btn--sm btn-outline-base importBtn"><i class="fa-solid fa-download"></i> @lang('Import Keywords')</button>
</div>
@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $(document).on('click','.deleteKey',function () {
                var modal = $('#DelModal');
                modal.find('input[name=key]').val($(this).data('key'));
                modal.find('input[name=value]').val($(this).data('value'));
            });
            $(document).on('click','.editModal',function () {
                var modal = $('#editModal');
                modal.find('.form-title').text($(this).data('title'));
                modal.find('input[name=key]').val($(this).data('key'));
                modal.find('textarea[name=value]').val($(this).data('value'));
            });


            $(document).on('click','.importBtn',function () {
                $('#importModal').modal('show');
            });
            $(document).on('click','.import_lang',function(e){
                var id = $('.select_lang').val();

                if(id ==''){
                    notify('error','Invalide selection');

                    return 0;
                }else{
                    $.ajax({
                        type:"post",
                        url:"{{route('admin.language.import.lang')}}",
                        data:{
                            id : id,
                            toLangid : "{{$lang->id}}",
                            _token: "{{csrf_token()}}"
                        },
                        success:function(data){
                            if (data == 'success'){
                                notify('success','Import Data Successfully');
                                window.location.href = "{{url()->current()}}"
                            }
                        }
                    });
                }

            });
        })(jQuery);
    </script>
@endpush
