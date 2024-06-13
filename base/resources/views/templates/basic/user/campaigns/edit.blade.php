@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-9 col-lg-10">
            <div class="dashboard-card-wrap">
                <form action="{{ route('user.campaign.store', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-12">
                            <h4 class="dashboard-title">@lang('Edit Campaign')</h4>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="campaign_title" class="form--label required">@lang('Campaign Title')</label>
                                <div class="input--group">
                                    <input type="text" name="title" value="{{ old('title', $campaign->title) }}" class="form--control" id="campaign_title" placeholder="Campaign Title" required>
                                    <div class="input--icon">
                                        <i class="fa-solid fa-hand-holding-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="form--label required">@lang('Select Category')</label>
                                <div class="col-sm-12">
                                    <select name="category_id" class="form--control form-select" required>
                                        <option value=""{{ old('category_id') ? '' : 'selected' }} disabled>
                                            @lang('Select category')
                                        </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected($campaign->category_id == $category->id)>
                                                {{ __($category->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="end_date" class="form--label required">@lang('End Date')</label>
                                <div class="input--group">
                                    <input type="text" id="end_date" name="date" value="{{old('date', showDateTime($campaign->date,'Y/m/d')) }}" data-language="en"
                                    class="datepicker-here form--control" data-format="{{$general->date_format}}" data-position='bottom left'
                                    placeholder="@lang('End date')" autocomplete="off" value="{{ request()->date }}" required>
                                    <div class="input--icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="attachment_wrapper">
                                <div class="form-group profile">
                                    <label class="form--label" for="campaign-imgage">@lang('Campaign Image')</label> 
                                    <div class="single-input form-group mt-3 mb-1">
                                        <input type="file" class="form--control" name="image" id="campaign-imgage" accept=".jpg, .jpeg, .png, .pdf" />
                                    </div>
                                    <p class="mb-2">@lang('Allowed File Extensions: .jpg, .jpeg, .png')</p>
                                    <div class="campaign-box__thumb w-25">
                                        <img src="{{ getImage(getFilePath('campaignImg') . '/' . $campaign->image, getFileSize('campaignImg')) }}" alt="@lang('Image')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="attachment_wrapper mb-4">
                                <div class="form-group profile mb-15">
                                    <label class="form--label" for="attachments">@lang('Campaign Gallery')</label> 
                                    <div class="single-input form-group mt-2 mb-1">
                                        <input type="file" class="form--control" name="gallery[]" id="attachments"accept=".jpg, .jpeg, .png, .pdf" />
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3">
                                @forelse ($campaign->galleries as $item)
                                <div class="col-lg-6">
                                    <div class="relevant-img-item mb-2">
                                        <img src="{{ getImage(getFilePath('gallery') . '/' . $item->image) }}" alt="@lang('Image')">
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                            
                            <div id="fileUploadsContainer"></div>
                            <p>@lang('Allowed File Extensions: .jpg, .jpeg, .png, .pdf')</p>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn--base btn--sm ms-2 add-new">
                                    @lang('Add New')
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="attachment_wrapper">
                                <div class="form-group profile">
                                    <label class="form--label" for="document">@lang('Document(.pdf)')</label> 
                                    <div class="single-input form-group mt-3 mb-1">
                                        <input type="file" class="form--control" name="document" id="document" accept=".jpg, .jpeg, .png, .pdf"/>
                                    </div>
                                    <p>@lang('Allowed File Extensions only: .pdf')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label required" for="amount">@lang('Goal Amount')</label>
                            <div class="input-group input--group country-code">
                                <span class="input-group-text" id="basic-addon1">@lang('Usd')</span>
                                <input type="number" class="form--control" name="goal_amount" value="{{$campaign->goal}}" id="amount" placeholder="Enter Amount" aria-label="Username" aria-describedby="basic-addon1" required>
                                <div class="input--icon">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="desctiption" class="form--label required">@lang('Description')</label>
                                <div class="input--group textarea">
                                    <textarea type="text" id="desctiption" name="description" class="form--control summernote" >
                                        {{ $campaign->description }}
                                    </textarea>
                                    <div class="input--icon">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                </div> 
                            </div>
                        </div>                        
                        <div class="col-sm-12 text-end">
                            <button type="submit" class="btn btn--base ms-2">
                                @lang('Submit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @php
        $generals = App\Models\SiteSetting::first()->date_format;
    @endphp
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/datepicker.min.css') }}"> 
    <link href="{{asset('assets/general/css/summernote.css') }}" rel="stylesheet">
@endpush


@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>   
    <script src="{{ asset('assets/general/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/general/js/summernote-init.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            // Add new file
            $(".add-new").on('click', function() {
                $("#fileUploadsContainer").append(`  <div class="single-input input-group form-group mt-2 mb-1">
                    <input type="file" class="form--control" name="attachments[]" id="attachments"accept=".jpg, .jpeg, .png, .pdf" required />
                    <button type="button" class="input-group-text btn--danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `);
            });


            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.input-group').remove();
            });

            //datepicker
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }

            const format = "{{$generals}}";

            $.fn.datepicker.language['en'] = {
                days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                today: 'Today',
                clear: 'Clear',
                dateFormat: format,
                timeFormat: 'hh:ii aa',
                firstDay: 0
            };

            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });
        })(jQuery)
    </script>
@endpush