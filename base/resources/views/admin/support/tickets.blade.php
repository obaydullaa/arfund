@extends('admin.layouts.app')

@section('panel')


    <div class="row   mb-4">
        <div class="col-lg-12">
        <div class="card-two responsive-filter-card">
                <form method="get">
                    @csrf
                    <div class="row gy-4 align-items-center">
                        <div class="col-lg-2 col-md-4">
                            <input type="text" name="ticket" value="{{ old('ticket', request()->ticket) }}" class="form--control w-100" placeholder="@lang('Ticket No')">
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <input type="text" name="email" value="{{ old('email', request()->email) }}" class="form--control w-100" placeholder="@lang('Email')">
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <select name="status" class="form--control w-100 select form-select" id="ticketStatus">
                                <option value="">@lang('All Ticket')</option>
                                <option {{ request()->input('status') == 4 ? 'selected' : '' }} value="4">@lang('Open Ticket') </option>
                                <option {{ request()->input('status') == 1 ? 'selected' : '' }} value="1">@lang('Answered Ticket') </option>
                                <option {{ request()->input('status') == 2 ? 'selected' : '' }} value="2">@lang('Replied Ticket')</option>
                                <option {{ request()->input('status') == 3 ? 'selected' : '' }} value="3">@lang('Closed Ticket')</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <input type="text" class="form--control w-100"   name="date_time" data-multiple-dates-separator=" - " data-language="en" id="supportTicketDatepicker" placeholder="@lang('Select Date')" value="{{ old('date_time') }}">
                        </div>


                        <div class="col-lg-2 col-md-4">
                            <div class="text-end">
                                <button type="submit" class="btn btn--global btn-outline--global w-100">
                                    <i class="fas fa-search"></i>
                                    @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row gy-4 ">
        <div class="col-lg-12">
        <div class="card-two p-0">
            <div class="table-wrap table-responsive">
                <table class="table table--responsive--md table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('Ticket')</th>
                                    <th>@lang('Subject')</th>
                                    <th>@lang('Submitted By')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Priority')</th>
                                    <th>@lang('Last Reply')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td data-label="@lang('Ticket')">
                                            <a href="{{ route('admin.ticket.view', $item->id) }}">
                                                #{{ $item->ticket }}
                                            </a>
                                        </td>
                                        <td data-label="@lang('Subject')">
                                            <span class="fw-bold">
                                                {{ strLimit($item->subject, 30) }}
                                            </span>
                                        </td>

                                        <td data-label="@lang('Submitted By')">
                                            <div class="d-flex flex-column">
                                                @if ($item->user_id)
                                                    <a class="fw-bold" href="{{ route('admin.users.detail', $item->user_id) }}"> {{  ucwords(@$item->user->fullname) }}</a>
                                                @else
                                                    <p class="fw-bold"> {{ ucwords(@$item->name) }}</p>
                                                @endif
                                                <span>{{ $item->email }}</span>
                                            </div>
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @php echo $item->statusBadge; @endphp
                                        </td>
                                        <td data-label="@lang('Priority')">
                                            @if ($item->priority == Status::PRIORITY_LOW)
                                                <span class="badge badge--dark">@lang('Low')</span>
                                            @elseif($item->priority == Status::PRIORITY_MEDIUM)
                                                <span class="badge  badge--warning">@lang('Medium')</span>
                                            @elseif($item->priority == Status::PRIORITY_HIGH)
                                                <span class="badge badge--danger">@lang('High')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Last Reply')">
                                            {{ diffForHumans($item->last_reply) }}
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.ticket.view', $item->id) }}" class="btn btn--sm btn-outline-base ms-1">
                                                <i class="fa-solid fa-display"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>

                                        <td class="text-muted text-center" colspan="7" data-label="{{$pageTitle}}">
                                            {{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

            </div>
            <div class="row">
                @if ($items->hasPages())
                <div class="col-lg-12">
                    {{ paginateLinks($items) }}
                </div>
                @endif
            </div>
        </div>
    </div>

    @php
        $generals = App\Models\SiteSetting::first()->date_format;
    @endphp


@endsection

@push('breadcrumb-plugins')
    <button type="button" class="btn btn--global btn--outline-global showFilterBtn text-end"><i
    class="fa-solid fa-filter"></i> @lang('Filter')</button>

@endpush



@push('script')
    <script>
        (function($) {
            "use strict";
            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle(400);
            });

            const format = "{{$generals}}";

            $( "#supportTicketDatepicker" ).datepicker({
                dateFormat: format
            });

        })(jQuery)
    </script>
@endpush



