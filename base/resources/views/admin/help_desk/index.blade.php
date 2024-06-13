@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Mobile')</th>
                                <th>@lang('Subject & Message')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supports as $support)
                                <tr>
                                    <td data-label="@lang('Name')">
                                        {{ $support->name }}
                                    </td>

                                    <td data-label="@lang('Email')">
                                        {{ $support->email }}
                                    </td>

                                    <td data-label="@lang('Mobile')">
                                        {{ $support->mobile }}
                                    </td>

                                    <td data-label="@lang('Subject')">
                                        <button  title="@lang('Details')" type="button" data-subject="{{$support->subject}}" data-message="{{ $support->message }}" data-bs-toggle="modal" data-bs-target="#helpDetailsModal" class="btn btn--sm btn-outline-base view_details c-pointer">
                                            @lang('View')
                                        </button>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @php echo $support->statusBadge; @endphp
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <div class="button--group">
                                            <a href="{{ route('admin.guest.support.delete', $support->id) }}" class="btn btn--sm btn-outline-danger me-2">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>

                                            @if($support->reply_status != Status::ENABLE)
                                            <a href="{{ route('admin.guest.support.status', $support->id) }}" class="btn btn--sm btn-outline-dark">
                                                <i class="fa-solid fa-reply"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="6">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @if ($supports->hasPages())
                            <div class="py-4">
                                {{ paginateLinks($supports) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div id="helpDetailsModal" class="modal fade" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Message Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body mb-3">
                    <div class="mb-4">
                        <h6>@lang('Subject')</h6>
                        <p class="subject"></p>
                    </div>
                    <div>
                        <h6>@lang('Message')</h6>
                        <p class="message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start">
        <button type="button" class="btn btn--sm btn-outline-base me-2" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> @lang('Add New')</button>
    </div>
@endpush



@push('script')
    <script>
        $(document).ready(function() {
            $('.view_details').on('click', function() {
                var subject = $(this).data('subject');
                var message = $(this).data('message');
                $('.subject').text(subject);
                $('.message').text(message);
                $('#helpDetailsModal').css('display', 'block');
            });


            $('.close').on('click', function() {
                $('#helpDetailsModal').css('display', 'none');
            });
        });
    </script>
@endpush
