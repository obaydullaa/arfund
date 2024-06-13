@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- ============= Campaign Details Start Here ============= -->
    <section class="campaign-page-area py-120 section-grey-bg">
        <div class="container">
            <div class="row gy-4 mb-4">
                <div class="col-lg-6">
                    <!-- ============ Campaigns Details Sidebar Start ======= -->
                    <div class="blog-sidebar overflow-hidden">
                        <h5 class="blog-sidebar__title">@lang('Filter By Category')</h5>
                        <div class="categories-search select2-parent w-100">
                            <select name="categories" class="form--control w-100 category-filter select2-auto-tokenize" multiple="multiple" required>
                                @foreach ($categories as $item)
                                    <option class="filter-by-category" value="{{ $item->id }}">{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- ============ Campaigns Details Sidebar End ======= -->
                </div>
                <div class="col-lg-6">
                    <div class="blog-sidebar">
                        <h5 class="blog-sidebar__title">@lang('Filter By Campaign Name')</h5>
                        <div class="post-sidebar__card__body">
                            <div class="input-group country-code">
                                <input type="text" id="searchValue" name="search" class="form--control"
                                    placeholder="@lang('Filter by name')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="row gy-4 justify-content-center main-content">
                        @include($activeTemplate . 'partials.campaign')
                    </div>
                    <div class="row {{ $campaigns->hasPages() ? 'my-5' : '' }}">
                        <div class="col-lg-12">
                            @if ($campaigns->hasPages())
                                <div class="text-end">
                                    <div class="d-flex justify-content-end">
                                        {{ $campaigns->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============= Campaign Details End Here ============= -->
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/general/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/general/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";           
            
            // Filter Campaign name start
            $("#searchValue").on('keyup', function() {
                var categories = [];
                var searchValue = $(this).val();
                getFilteredData(categories, searchValue)
            });

            // Filter Campaign name end
            $('.select2-auto-tokenize').on('change', function() {
                var categories   = [];
                var searchValue = $('#searchValue').val();

              categories = $(this).val();
      
                getFilteredData(categories,searchValue)
            });


            function getFilteredData(categories, searchValue) {
                $.ajax({
                    type: "get",
                    url: "{{ route('campaign.filtered') }}",
                    data: {
                        "categories": categories,
                        "search": searchValue
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log("Response:", response);
                        if (response.html) {
                            $('.main-content').html(response.html);
                        }
                        if (response.error) {
                            notify('error', response.error);
                        }
                    }
                });
            }
            // end filter Campaign

            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.select2-parent'),
                tags: true,
                tokenSeparators: [',']
            });

            $('.select2-auto-tokenize').select2({
                placeholder: "Select categories",
                allowClear: false
            });

        })(jQuery);
    </script>
@endpush