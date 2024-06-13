@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4  mb-5">
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('image')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td data-label="@lang('image')">
                                    <div class="logo-img">
                                        <img class="thumb" src="{{getImage(getFilePath('category').'/'. $category->image,getFileSize('category'))}}" alt="@lang('image')">
                                    </div>
                                </td>
                                <td data-label="@lang('Name')">
                                    <span> {{$category->name }}</span>
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($category->status == 1)
                                        <span class="badge badge--success">@lang('Active')</span>
                                    @else 
                                        <span class="badge badge--danger">@lang('Inactive')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">
                                    <div class="button--group"> 
                                        <button class="btn btn--sm btn-outline-base ms-1 CategoryModalBtn" title="@lang('Edit')" data-path="{{getFilePath('category') . '/' . @$category->image}}" data-resource="{{ $category }}" data-modal_title="@lang('Update Category')">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>

                                    @if(!$category->status)
                                        <button type="button" class="btn btn--sm btn-outline--success ms-1 confirmationBtn"
                                                data-action="{{ route('admin.category.status', $category->id) }}"
                                                data-question="@lang('Are you sure to active this category')?"
                                                title="@lang('Active')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn--sm btn-outline--danger confirmationBtn"
                                        data-action="{{ route('admin.category.status', $category->id) }}"
                                        data-question="@lang('Are you sure to inactive this category')?"
                                        title="@lang('Inactive')">
                                                <i class="fas fa-eye-slash"></i>
                                        </button>
                                    @endif
                                    </div>
                                </td>
                                <x-confirmation-modal />
                            </tr>
                            @empty
                            <tr>
                                <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="6">{{ __($emptyMessage) }}</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @if ($categories->hasPages())
                            <div class="py-4">
                                {{ paginateLinks($categories) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <!-- Category Modal -->
        <div id="CategoryModal" class="modal fade " tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="mb-2 required">@lang('Name')</label>
                                <div class="input-group">
                                    <input type="text" name="name" class="form--control w-100" placeholder="@lang('Name')" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="mb-2 required"> @lang('image ')</label>
                                <x-image-uploader class="w-100" id="image" name="image" :imagePath="getImage(getFilePath('category') . '/',getFileSize('category'),)" :size="getFileSize('category')"  :required="true" :isImage="false"/>
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


@endsection

@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start">
        <button class="btn btn-outline--primary h-45 CategoryModalBtn" data-modal_title="@lang('Add New Category')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    </div>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.CategoryModalBtn').on('click', function() {
                
                var data = $(this).data();
                var dataObject = data.resource;
                var modal = $('#CategoryModal');
                let form = modal.find("form");
                var url = "{{ url('/') }}";
                var imageSource = url + '/' + $(this).data('path');
                console.log(imageSource);
                modal.find(".modal-title").text(`${data.modal_title}`);

                if (!dataObject){
                    $(form).trigger("reset");
                    $('.thumb_area img').attr('src', '');
                    modal.find('input[name=id]').val(null);
                    $('#image').attr('required', true);
                    $('#image').attr('isImage', false);
                    modal.find('.thumb_area .image').addClass('d-none');
                    modal.find('.browse-mage-container .content-wrap').removeClass('d-none');

                }else{
                    modal.find('.thumb_area .image').removeClass('d-none');
                    modal.find('.browse-mage-container .content-wrap').addClass('d-none');
                    $('.thumb_area img').attr('src', imageSource);
                    $('#image').attr('imagePath', $(this).data('path'));
                    $('#image').attr('isImage', true);
                    $('#image').attr('required', false);
                    modal.find('input[name=id]').val(dataObject.id);
                    modal.find('input[name=name]').val(dataObject.name);
                }

                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush