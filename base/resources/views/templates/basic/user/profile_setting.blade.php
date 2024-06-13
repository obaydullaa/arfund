@extends($activeTemplate.'layouts.master')
@section('content')

<div class="row justify-content-center">
    <div class="col-xxl-8">
        <div class="dashboard-card-wrap">
            <div class="drop-file-wrap--">
                <div class="dashboard_profile_wrap p-0">
                    <div class="profile_photo mb-2">
                        <img src="{{ getImage(getFilePath('userProfile').'/'.auth()->user()->image,getFileSize('userProfile')) }}" alt="@lang('User\'s prifile picture')">
                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="photo_upload">
                                <label for="file_upload"><i class="fas fa-image"></i></label>
                                <input id="file_upload" name="image" type="file" class="upload_file" onchange="this.form.submit()" accept=".png, .jpeg, .jpg">
                            </div>
                        </form>
                    </div>
                    <div class="user-info">
                        <p>{{$user->fullname}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="register" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-3">
                        <div class="form-group col-sm-6">
                            <label class="form-label">@lang('First Name')</label>
                            <input type="text" class="form-control form--control" name="firstname" value="{{$user->firstname}}" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form--label">@lang('Last Name')</label>
                            <input type="text" class="form-control form--control" name="lastname" value="{{$user->lastname}}" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form--label">@lang('E-mail Address')</label>
                            <input class="form-control form--control" value="{{$user->email}}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form--label">@lang('Mobile Number')</label>
                            <input class="form-control form--control" value="{{$user->mobile}}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form--label">@lang('Address')</label>
                            <input type="text" class="form-control form--control" name="address" value="{{@$user->address->address}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form--label">@lang('State')</label>
                            <input type="text" class="form-control form--control" name="state" value="{{@$user->address->state}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="form--label">@lang('Zip Code')</label>
                            <input type="text" class="form-control form--control" name="zip" value="{{@$user->address->zip}}">
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form--label">@lang('City')</label>
                            <input type="text" class="form-control form--control" name="city" value="{{@$user->address->city}}">
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form--label">@lang('Country')</label>
                            <input class="form-control form--control" value="{{@$user->address->country}}" disabled>
                        </div>
                    </div>

                    <div class="form-group text-end mt-3">
                        <button type="submit" class="btn btn--base">
                            @lang('Submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection