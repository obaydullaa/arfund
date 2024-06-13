@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5 align-items-center">
        <div class="col-md-12">
            <div class="card-two mb-4">
                <div class="card-header">
                    <div class="row">
                        @include('admin.partials.tab.general')
                    </div>

                </div>
            </div>

            <div class="card-two">
                <h5 class="card-title mb-3">@lang('Logo & Icon Setup')</h5>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-4 justify-content-center">
                            <div class="form-group col-md-4 col-sm-6 h-100">
                                <label class="mb-2"> @lang('Logo')</label>
                                <x-image-uploader name="logo" :imagePath="siteLogo() . '?' . time()" :size="getFileSize('logoIcon')" class="w-100 logo--box"
                                    id="uploadLogo" :required="false" :isImage="true"/>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 h-100">
                                <label class="mb-2"> @lang('White Logo')</label>
                                <x-image-uploader name="logo_white" :imagePath="siteLogo(true) . '?' . time()" :size="getFileSize('logoIcon')" class="w-100 logo--box"
                                    id="uploadWhiteLogo" :required="false" :isImage="true"/>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 h-100">
                                <label class="mb-2"> @lang('Favicon')</label>
                                <x-image-uploader name="favicon" :imagePath="siteFavicon() . '?' . time()" :size="getFileSize('favicon')" class="w-100 logo--box"
                                    id="uploadFavicon" :required="false" :isImage="true"/>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <p><span class="text-danger">@lang('Note')</span>: @lang('If the logo and favicon are not changed after you update from this page, please')
                                    <span class="text--danger">@lang('clear the cache')</span> @lang('from your browser. As we keep the filename the same after the update, it may show the old image for the cache. usually, it works after clear the cache but if you still see the old logo or favicon, it may be caused by server level or network level caching. Please clear them too.')
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection


