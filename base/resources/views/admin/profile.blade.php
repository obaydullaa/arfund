@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-xl-4 col-lg-5">
            <div class="profile-card">
                <div class="content-wrap">
                    <h5 class="profile-title">{{ __(@$admin->name) }}</h5>
                </div>
                <div class="thumb-wrap">
                    <img class="img-fluid"
                        src="{{ getImage(getFilePath('adminProfile') . '/' . $admin->image, getFileSize('adminProfile')) }}"
                        alt="@lang('Image')">
                </div>
                <ul class="info-list-wrap">
                    <li class="list">
                        @lang('Name')
                        <span class="">{{ __(@$admin->name) }}</span>
                    </li>
                    <li class="list">
                        @lang('Username')
                        <span class="">{{ @$admin->username }}</span>
                    </li>
                    <li class="list">
                        @lang('Email')
                        <span class="">{{ @$admin->email }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="row gap-4">
                <div class="card-two p-0">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-12 col-lg-12">
                                <div class="profile-image-uploadcontaioner">
                                    <div class="card-headerbg"></div>

                                    <div class="thumb-wrap">
                                        <div class="thumb">
                                            <img id="admin-preview-image" src="{{ getImage(getFilePath('adminProfile') . '/' . @$admin->image, getFileSize('adminProfile')) }}" alt="@lang('Image')">

                                            <div class="select-profile-img">
                                                <label for="file_upload"><i class="fa-solid fa-camera text-white"></i></label>
                                                <input type="file" name="image" id="file_upload" hidden
                                                    accept=".png, .jpeg, .jpg">
                                            </div>
                                        </div>

                                        <div class="content-wrap">
                                            <h6>@lang('Supported Files'): <span class="text-danger">@lang('.png, .jpg, .jpeg')</span></h6>
                                            <h6>@lang('Image will be resized into'): <b>{{ getFileSize('adminProfile') }}@lang('px')</b>.
                                            </h6>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-xxl-12 col-lg-12 p-5">
                                <h5 class="card-title mb-3"> @lang('Profile Information')</h5>
                                <div class="form-group ">
                                    <label class="mb-2">@lang('Name')</label>
                                    <input class="form--control w-100" type="text" name="name"
                                        value="{{ $admin->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">@lang('Username')</label>
                                    <input class="form--control w-100" type="text" name="username"
                                        value="{{ $admin->username }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">@lang('Email')</label>
                                    <input class="form--control w-100" type="email" name="email"
                                        value="{{ $admin->email }}" required>
                                </div>
                                <div class="col-lg-12 text-end">
                                    <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="card-two">
                    <div class="card-body">
                        <h5 class="card-title mb-4">@lang('Change Password')</h5>
                        <form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group password-input">
                                <label for="old_password" class="mb-2">@lang('Current Password')</label>
                                <input class="form--control w-100" type="password" id="old_password" name="old_password"
                                    required>
                                <div class="password-show-hide fas fa-eye-slash toggle-password-change"
                                    data-target="old_password"> </div>
                            </div>

                            <div class="form-group password-input">
                                <label for="password" class="mb-2">@lang('New Password')</label>
                                <input class="form--control w-100" type="password" id="password" name="password" required>
                                <div class="password-show-hide fas fa-eye-slash toggle-password-change"
                                    data-target="password"> </div>
                            </div>

                            <div class="form-group password-input">
                                <label for="password_confirmation" class="mb-2">@lang('Confirm Password')</label>
                                <input class="form--control w-100" type="password" name="password_confirmation"
                                    id="password_confirmation" required>
                                <div class="password-show-hide fas fa-eye-slash toggle-password-change"
                                    data-target="password_confirmation"> </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12 text-end">
                                    <button type="submit" class="btn btn-outline-base">@lang('Update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict";

            $('input[name=password]').on('input', function() {
                secure_password($(this));
            });

            $('[name=password]').focus(function() {
                $(this).closest('.form-group').addClass('hover-input-popup');
            });

            $('[name=password]').focusout(function() {
                $(this).closest('.form-group').removeClass('hover-input-popup');
            });

            $(".toggle-password-change").on('click', function() {
                var targetId = $(this).data("target");
                var target = $("#" + targetId);
                var icon = $(this);
                if (target.attr("type") === "password") {
                    target.attr("type", "text");
                    icon.removeClass("fa-eye-slash");
                    icon.addClass("fa-eye");
                } else {
                    target.attr("type", "password");
                    icon.removeClass("fa-eye");
                    icon.addClass("fa-eye-slash");
                }
            });

            $('#file_upload').change(function(){
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#admin-preview-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });


        })(jQuery);
    </script>
@endpush
