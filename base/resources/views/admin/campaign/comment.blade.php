@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap gap-2 justify-content-start">
                <x-search-form placeholder="Search..." />
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-wrap table-responsive">
                        <table class="table table--responsive--md table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('Campaign')</th>
                                    <th>@lang('Name') | @lang('Email')</th>
                                    <th>@lang('Review')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $comment)
                                    <tr>
                                        <td data-label="@lang('Campaign')">
                                            <a href="{{ route('admin.campaign.details', @$comment->campaign_id) }}">
                                                {{ __(strLimit(@$comment->campaign->title, 20)) }}
                                            </a>
                                        </td>
                                        <td data-label="@lang('Name')">
                                            <span class="fw-bold">{{ __($comment->fullname) }}</span>
                                            <span class="d-block">{{ $comment->email }}</span>
                                        </td>
                                        <td data-label="@lang('Review')">{{ strLimit($comment->comment, 30) }}</td>
                                        <td data-label="@lang('Status')">
                                            @php
                                                echo $comment->statusBadge;
                                            @endphp
                                        </td>
                                        <td data-label="@lang('Created At')">
                                            {{ showDateTime($comment->created_at) }}
                                            <span class="d-block">{{ diffForHumans($comment->created_at) }}</span>
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <div class="action-wrapper d-flex align-items-center justify-content-end">
                                                <button class="btn btn--sm btn-outline-base ms-1 me-1 ModaldetailBtn"
                                                    data-resourse="{{ $comment }}">
                                                    <i class="las la-desktop"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn--sm btn-outline-success dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button type="button" class="btn-outline--success dropdown-item confirmationBtn"
                                                                data-action="{{ route('admin.campaign.comment.approve', $comment->id) }}"
                                                                title="@lang('Publish')"
                                                                data-question="@lang('Are you sure to publish this comment?')">
                                                                <i class="fa-regular fa-circle-check"></i>
                                                                @lang('Approve')
                                                            </button>

                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item btn-outline--danger confirmationBtn"
                                                                data-action="{{ route('admin.campaign.comment.reject', $comment->id) }}"
                                                                title="@lang('Pending')"
                                                                data-question="@lang('Are you sure to reject this comment?')">
                                                                <i class="fa-regular fa-circle-xmark"></i>
                                                                @lang('Reject')
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

                @if ($comments->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($comments) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    {{-- DETAILS MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Camapign Comment')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group-flush list-group">
                        <li class="list-group-item align-items-center fw-bold">
                            <p class="comment text-end"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.ModaldetailBtn').on('click', function() {
                var modal = $('#detailModal');
                var resourse = $(this).data('resourse');
                $('.comment').text(resourse.comment);
                modal.modal('show');
            });

            // Reject modal
            $('.rejectBtn').on('click', function () {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush