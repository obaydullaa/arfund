@extends($activeTemplate.'layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="dashboard-card-wrap mt-0">
            <div class="col-lg-12">
                <div class="order-wrap">
                    <div class="d-flex mb-3 flex-wrap gap-3 justify-content-between align-items-center">
                        <div>
                            <form autocomplete="off">
                                <div class="search-box">
                                    <input type="text" class="form--control" name="search" placeholder="Search...">
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
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($campaigns as $item)
                                @php
                                    $donation = $item->donation->where('status', Status::DONATION_PAID);
                                    $hasDonations = $donation->count();
                                @endphp
                                <tr>
                                    <td data-label="@lang('Title')">
                                        <a href="{{ route('user.campaign.view', [$item->slug, $item->id]) }}">
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
                                    <td data-label="@lang('Status')">
                                        @if($item->date < now() && $item->completed == Status::YES)
                                        
                                        <span class="badge badge--success">@lang("Completed")</span>
                                        @else 
                                        @php echo $item->statusBadge; @endphp
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <div class="div">

                                            @if($item->date < now() && $item->completed == Status::NO)
                                                <a href="javascript:void(0)" data-action="{{ route('user.campaign.extended', $item->id) }}"  data-title="{{ $item->title }}" data-goal="{{ $item->goal }}"
                                                    class="table-btn table-btn--info extendBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Extend request')?">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                            @endif
                                            <a class="table-btn table-btn--base" href="{{ route('user.campaign.view', [$item->slug, $item->id]) }}"
                                                title="Details">
                                                  <i class="fas fa-eye"></i>
                                            </a>

                                            @if (@$hasDonations)
                                            <a class="table-btn table-btn--success" href="{{ route('user.campaign.donation.received', $item->id) }}"  title="@lang('Donors List')">
                                                <i class="fas fa-users"></i>
                                            </a>
                                            @else
                                                <a class="table-btn table-btn--dark cursor-unset" href="javascrpt:void(0)">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-center"> {{ __($emptyMessage) }}</p>
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
                        <input name="date" type="text" data-language="en"  data-format="{{$general->date_format}}"
                            class="datepicker-here form--control bg--white" autocomplete="off" value="{{ date('Y-m-d') }}"
                              required id="extend_deadline">
                        <small class="text-muted text--small"> <i class="la la-info-circle"></i>
                            @lang('Year-Month-Date')</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form--label">@lang('Extend Goal')</label>
                        <div class="input-group">
                            <input type="number" step="any" name="goal"
                                value="{{ old('goal') }}" class="form-control form--control">
                            <span class="input-group-text">{{ __($general->cur_text) }}</span>
                        </div>
                        <code class="was-goal"></code>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form--label">@lang('Final Goal')</label>
                        <div class="input-group">
                            <input type="number" step="any" required name="final_goal"
                                value="{{ old('final_goal', 0) }}" class="form-control form--control" readonly>
                            <span class="input-group-text">{{ __($general->cur_text) }}</span>
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

@php
$generals = App\Models\SiteSetting::first()->date_format;
@endphp
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/datepicker.min.css') }}">
    <link href="{{asset('assets/general/css/summernote.css') }}" rel="stylesheet">
@endpush


@push('script-lib')

@endpush

@push('script')

    <script>
        'use strict';
        $(function() {
            $('.extendBtn').on('click', function(e) {
                e.preventDefault();
                let route = $(this).data('action');
                let title = $(this).data('title');
                let goal = parseFloat($(this).data('goal'));
                let curText = `{{ $general->cur_text }}`;
                var modal = $('#extendedModal');
                
                modal.find('.modal-body .campaign-title').text(`${title}`);
                modal.find('.modal-body .was-goal').text(`@lang('Previous Goal'):` + `${goal}` + ' ' + `${curText}`);
                modal.find('form').attr('action', route);
                
                let oldFinalGoal = parseFloat($('[name=final_goal]').val()) || 0;
                let oldGoal = parseFloat($('[name=goal]').val()) || 0;
                $('[name=final_goal]').val(goal + oldGoal);

                $(document).on('input', '[name=goal]', function() {
                    const currentGoal = parseFloat($(this).val()) || 0;
                    var finalGoal = goal + currentGoal;
                    $('[name=final_goal]').val(finalGoal);
                });

                modal.modal('show');
            });
        });


        $('#extend_deadline').on('click', function(){
            const format = "{{$generals}}";
            console.log(format);

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

            $(this).datepicker({
                language: 'en',
                dateFormat: format
            });

        });
    </script>

<script src="{{ asset('assets/admin/js/plugins/datepicker.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .datepickers-container {
            z-index: 9999999999;
        }
    </style>
@endpush
