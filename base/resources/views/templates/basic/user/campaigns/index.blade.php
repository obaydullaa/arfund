@extends($activeTemplate.'layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="dashboard-card-wrap mt-0">
            <div class="col-lg-12">
                <div class="order-wrap">
                    <div class="d-flex mb-3 flex-wrap gap-3 justify-content-end align-items-center">
                        <div>
                            <form>
                                <div class="search-box">
                                    <input type="text" class="form--control" name="search" value="{{old('search')}}" placeholder="@lang('Search Title')...">
                                    <button type="submit" class="search-box__button"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table--responsive--md">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Goal Amount')</th>
                                    <th>@lang('Fund Raised')</th>
                                    <th>@lang('Deadline')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($campaigns as $item)
                                <tr>
                                    <td data-label="@lang('Title')">
                                        <a href="{{  route('user.campaign.view', [$item->slug, $item->id])  }}">
                                            {{ strLimit($item->title, 30) }}
                                        </a>
                                    </td>
                                    <td data-label="@lang('Category')">{{ __($item->category->name) }}</td>
                                    <td data-label="@lang('Goal Amount')">{{ $general->cur_sym }}{{ showAmount($item->goal) }}</td>
                                    <td data-label="@lang('Fund Raised')">
                                         {{ $general->cur_sym }}{{ showAmount($item->donation->where('status', Status::DONATION_PAID)->sum('donation')) }}
                                    </td>
                                    <td data-label="@lang('Deadline')">
                                        {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <div class="div">
                                            @php
                                                $hasDonations = $item->donation->where('status', Status::DONATION_PAID)->count();
                                            @endphp

                                            @if (request()->routeIs('user.campaign.pending'))
                                                @if ($item->expired())
                                                    <a href="{{ route('user.campaign.edit', $item->id) }}" class="table-btn table-btn--info" title="Edit">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                @endif
                                            @endif


                                            @if(request()->routeIs('user.campaign.rejected') || request()->routeIs('user.campaign.all'))
                                                <a href="javascript:void(0)" class="table-btn table-btn--danger confirmationBtn"
                                                data-question="@lang('Are you sure to delete the expired campaign')?"
                                                data-action="{{ route('user.campaign.delete', $item->id) }}" title="@lang('Trash request')?" >
                                                <i class="fa-solid fa-trash"></i>
                                                </a>
                                            @endif

                                            @if (request()->routeIs('user.campaign.pending') ||
                                                    request()->routeIs('user.campaign.rejected') ||
                                                    request()->routeIs('user.campaign.success'))
                                                <a class="table-btn table-btn--base" href="{{ route('user.campaign.view', [$item->slug, $item->id]) }}"
                                                title="Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @else
                                                <a class="table-btn table-btn--base" href="{{ route('user.campaign.view', [$item->slug, $item->id]) }}"
                                                    title="Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            
                                                <a class="table-btn table-btn--violet" href="{{ route('user.campaign.donation.received', $item->id) }}"  title="@lang('Donor List')">
                                                    @if (@$hasDonations)
                                                            <i class="fas fa-users"></i>
                                                    @else
                                                        <i class="fas fa-users"></i>
                                                    @endif
                                                </a>

                                                @if ($item->completed == Status::NO)
                                                    <a data-question="@lang('Are you sure to campaign complete action? Because this action can\'t back again!')"
                                                        data-action="{{ route('user.campaign.make.complete', $item->id) }}"
                                                        class="table-btn table-btn--success text-white confirmationBtn" title="@lang('Complete')?">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                @endif
                                                @if (!request()->routeIs('user.campaign.expired'))
                                                    @if ($item->stop)
                                                        <a data-question="@lang('Are you sure to run this campaign?')"
                                                            data-action="{{ route('user.campaign.stop', $item->id) }}"
                                                            class="table-btn table-btn--danger confirmationBtn" title="@lang('Campaign Run')">
                                                            
                                                            <i class="fa-regular fa-circle-stop"></i>
                                                        </a>
                                                    @else
                                                        <a data-question="@lang('Are you sure to stop this campaign?')"
                                                            data-action="{{ route('user.campaign.stop', $item->id) }}"
                                                            class="table-btn table-btn--info confirmationBtn mt-1" title="@lang('Campaign Stop')">
                                                            <i class="fa-regular fa-circle-play"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-center">{{ __($emptyMessage) }}</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($campaigns->hasPages())
                        <div class="pt-3">
                            {{ paginateLinks($campaigns) }}
                        </div>
                    @endif
                </div>
            </div>
            <x-confirmation-modal />
        </div>
    </div>
</div>

<!--  Extend The Expired Campaign modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="extendedModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content custom--modal">
            <div class="modal-header border-0">
                <h5 class="title-three">@lang('Are you sure to extend the campaign')?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <h4 class="campaign-title"></h4>
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form--label required">@lang('Extend Deadline')</label>
                        <input name="date" type="text" data-language="en"
                            class="datepicker-here form--control bg--white" autocomplete="off"
                            value="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd" required>
                        <small class="text-muted text--small"> <i class="la la-info-circle"></i>
                            @lang('Year-Month-Date')</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form--label required">@lang('Extend Goal') </label>
                        <div class="input-group">
                            <input type="number" step="any" required name="goal"
                                value="{{ old('goal') }}" class="form-control form--control">
                            <span class="input-group-text">{{ __($general->cur_text) }} </span>
                        </div>
                        <code class="was-goal"></code>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form--label required">@lang('Final Goal')</label>
                        <div class="input-group">
                            <input type="number" step="any" required name="final_goal"
                                value="{{ old('final_goal') }}" class="form-control form--control" readonly>
                            <span class="input-group-text">{{ __($general->cur_text) }} </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--base">
                        @lang('Submit')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection


@php
    $generals = App\Models\SiteSetting::first()->date_format;
@endphp

@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/datepicker.min.css') }}">
    <link href="{{asset('assets/general/css/summernote.css') }}" rel="stylesheet">
@endpush


@push('script')
    <script>
        'use strict';

        $(function() {
            $('.extendBtn').on('click', function(e) {
                e.preventDefault();
                let route = $(this).data('action');
                console.log(route);
                let title = $(this).data('title');
                let goal = parseFloat($(this).data('goal'));
                let curText = `{{ $general->cur_text}}`;
                var modal = $('#extendedModal');
                modal.find('.modal-body .campaign-title').text(`${title}`);
                modal.find('.modal-body .was-goal').text(`@lang('Previous Goal'):` +`${goal}` + ' '+ `${curText}`);
                modal.find('form').attr('action', route);

                $(document).on('input', '[name=goal]' , function(){
                    const currentGoal = parseFloat($(this).val());
                    var finalGoal   = goal + currentGoal;
                    $('[name=final_goal]').val(finalGoal);
                })

                modal.modal('show');
            });


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

            //date-validation
            $(document).on('click', 'form button[type=submit]', function(e) {
                if (new Date($('.datepicker-here').val()) == "Invalid Date") {
                    notify('error', 'Invalid extend deadline');
                    return false;
                }
            });
        })
    </script>
@endpush

@push('style')
    <style>
        .datepickers-container {
            z-index: 9999999999;
        }
    </style>
@endpush
