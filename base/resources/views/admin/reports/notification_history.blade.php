@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                        <tr>
                            <th>@lang('User')</th>
                            <th>@lang('Sent')</th>
                            <th>@lang('Sender')</th>
                            <th>@lang('Subject')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td data-label="@lang('User')">

                                            @if($log->user)
                                            <div class="user-info">
                                                <div class="user-img">
                                                    <img class="thumb rounded-circle"
                                                        src="{{ getImage(getFilePath('userProfile').'/'. @$log->user->image,getFileSize('userProfile')) }}"
                                                        alt="@lang('Profile Image')">
                                                </div>

                                                <div class="small">
                                                    <h6 class="mb-0">{{ @$log->user->fullname }}</h6>
                                                    <a class="text-base link-underline-primary" href="{{ route('admin.users.detail', @$log->user->id) }}"><span>@</span>{{ @$log->user->username }}</a>
                                                </div>
                                            </div>
                                            @else
                                                <span class="fw-bold">@lang('System')</span>
                                            @endif

                                    </td>
                                    <td data-label="@lang('Sent')">
                                        <div class="d-flex flex-column">
                                            <span>{{ showDateTime($log->created_at) }}</span>
                                            <span>{{ $log->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Sender')">
                                        <span class="fw-bold">{{ __($log->sender) }}</span>
                                    </td>
                                    <td data-label="@lang('Subject')">{{ __($log->subject) }}</td>
                                    <td data-label="@lang('Action')">
                                        <button title="@lang('Details')" class="btn btn--sm btn-outline-base notifyDetail" data-type="{{ $log->notification_type }}" @if($log->notification_type == 'email') data-message="{{ route('admin.report.email.details',$log->id)}}" @else data-message="{{ $log->message }}" @endif data-sent_to="{{ $log->sent_to }}">
                                            <i class="fa-solid fa-display"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="5">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end align-items-end mt-3">
                @if($logs->hasPages())
                <div class="col-lg-12 text-end">
                    {{ paginateLinks($logs) }}
                </div>
                @endif
            </div>
        </div>
    </div>


<div class="modal fade" id="notifyDetailModal" tabindex="-1" aria-labelledby="notifyDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notifyDetailModalLabel">@lang('Notification Details')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h3 class="text-center mb-3">@lang('To'): <span class="sent_to"></span></h3>
        <div class="detail"></div>
      </div>
    </div>
  </div>
</div>
@endsection


@push('breadcrumb-plugins')
    @if(@$user)
        <a href="{{ route('admin.users.notification.single',$user->id) }}" class="btn btn--base btn-outline-base"><i class="fa-regular fa-paper-plane"></i> @lang('Send Notification')</a>
    @else
        <x-search-form placeholder="Search Username" />
    @endif
@endpush

@push('script')
<script>
    $('.notifyDetail').on('click', function(){
        var message = $(this).data('message');
        var sent_to = $(this).data('sent_to');
        var modal = $('#notifyDetailModal');
        if($(this).data('type') == 'email'){
            var message = `<iframe src="${message}" height="500" width="100%" title="Iframe Example"></iframe>`
        }
        $('.detail').html(message)
        $('.sent_to').text(sent_to)
        modal.modal('show');
    });
</script>
@endpush
