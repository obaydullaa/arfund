@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4 align-items-start">
        <div class="col-lg-6">
            <div class="row gy-4">
                <div class="col-lg-12">
                        <div class="card-two">
                            <ul class="list-group list-grou-flush mb-3">
                                <li class="list-group-item d-flex border-b justify-content-between">
                                    <span class="text--muted">@lang('Title')</span>
                                    <span>{{ __($campaign->title) }}</span>
                                </li>
                                <li class="list-group-item d-flex border-b justify-content-between">
                                    <span class="text--muted ">@lang('Category')</span>
                                    <span>{{ __($campaign->category->name) }}</span>
                                </li>
                                <li class="list-group-item d-flex border-b justify-content-between">
                                    <span class="text--muted ">@lang('Deadline')</span>
                                    <span>{{ showDateTime($campaign->deadline) }}</span>
                                </li>
                                <li class="list-group-item d-flex border-b justify-content-between">
                                    <span class="text--muted ">@lang('Full Name')</span>
                                    <span>{{ __($campaign->user->fullname) }}</span>
                                </li>
                                <li class="list-group-item d-flex border-b justify-content-between">
                                    <span class="text--muted ">@lang('User Name')</span>
                                    <a href="{{ route('admin.users.detail', $campaign->user->id) }}">
                                        <span>@</span>{{ __($campaign->user->username) }}
                                    </a>
                                </li>
                                <li class="list-group-item d-flex border-b justify-content-between">
                                    <span class="text--muted ">@lang('Status')</span>
                                    <div class="">@php echo $campaign->statusBadge; @endphp</div>
                                </li>
                            </ul>
                            <div class="campaing-thumb mb-3">
                                <img src="{{ getImage(getFilePath('campaignImg') . '/' . $campaign->image, getFileSize('campaignImg')) }}">
                            </div>
                    </div>
                </div>

                @if ($campaign->status==Status::PENDING)
                <div class="col-lg-12">
                    <div class="card-two">
                        <div class="card-title">
                            <h5> @lang('Campaign Approve Or Reject')</h5>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button  type="button" class="btn btn-sm btn-outline--success mb-3 me-2 confirmationBtn"
                            data-action="{{ route('admin.campaign.approve.reject', ['status' => Status::CAMPAIGN_APPROVED, 'id' => $campaign->id]) }}"
                            data-question="@lang('Are you sure to approve this campaign')?">
                            <i class="la la-check"></i>@lang('Approve')
                            </button>
                            <button  type="button" class="btn btn-sm btn-outline--danger  mb-3 confirmationBtn"
                            data-action="{{ route('admin.campaign.approve.reject', ['status' => Status::REJECTED, 'id' => $campaign->id]) }}"
                            data-question="@lang('Are you sure to reject this campaign')?">
                            <i class="la la-times"></i>@lang('Reject')
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-lg-12">
                    <div class="card-two h-100">
                        <div class="card-title">
                            <h5> @lang('Relevent Document')</h5>
                        </div>
                        <div class="card-body d-flex gap-2 flex-wrap">
                            <div class="gallery-card">
                                <div class="gallery-card__thumb">
                                    @if(isset($campaign->document) && $campaign->document)
                                    <a class="document-download" href="{{ getImage(getFilePath('document') . '/' . @($campaign->document)) }}" download>
                                        <div class="document-download__content">
                                            <h6 class="title-three">@lang('Download Document Click Here')</h6>
                                            <div class="icon"><i class="fa-solid fa-cloud-arrow-down"></i></div>
                                        </div>
                                    </a>
                                    @else
                                    <h6 class="text-center">{{ __($emptyMessage) }}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
        
        
        <div class="col-lg-6">
            <div class="row gy-4">      
                {{-- Donation Details    --}}
                <div class="col-lg-12">
                    <div class="card h-100">
                        <div class="card-two">
                            <h5 class="card-title mb-4"> @lang('Donation Details')</h5>
                            <ul class="list-group list-grou-flush">
                                <li class="list-group-item d-flex    border-b justify-content-between">
                                    <span class="text--muted">@lang('Goal Amount')</span>
                                    <span>{{ showAmount($campaign->goal) }} {{ __($general->cur_text) }}</span>
                                </li>
                                <li class="list-group-item d-flex    border-b justify-content-between">
                                    <span class="text--muted">@lang('Already Collected Amount')</span>
                                    <span>{{ showAmount($donate) }} {{ __($general->cur_text) }}</span>
                                </li>
                                <li class="list-group-item d-flex    border-b justify-content-between">
                                    <span class="text--muted">@lang('Total Donar')</span>
                                    <span>{{ $campaign->donation_count }}</span>
                                </li>
                                <li class="list-group-item d-flex    border-b justify-content-between">
                                    <span class="text--muted">@lang('Donation completed')</span>
                                    <span> {{ getAmount($percent) }}%</span>
                                </li>
                                <li class="list-group-item d-flex   border-b justify-content-between">
                                    <span class="text--muted ">@lang('Donation Progress')</span>
                                    <div class="w-50">
                                        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{ getAmount($percent) }}%">{{ getAmount($percent) }}%</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-group list-grou-flush">
                                <h6 class="mt-3">@lang('Latest Donar')</h6>
                                @forelse ($campaign->donation as $item)
                                <li class="list-group-item d-flex border-b justify-content-between mb-3">
                                    <span class="text--muted">{{ $item->fullname ? __($item->fullname)  :  __('Anonymous') }}</span>
                                    <span> {{ getAmount($item->donation) }} {{ __($general->cur_text) }}</span>
                                </li>
                                @empty
                                <h6 class="text-muted">@lang('No donar yet')</h6>
                                @endforelse
                                <div>
                                    <a href="{{ route('admin.donation.campaign.wise', $campaign->id) }}" class="btn btn--sm btn--global btn-outline-global text-white inline-block">
                                        @lang('View all')
                                    </a>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card-two h-100">
                        <div class="card-title">
                           <h5> @lang('Relevent Gallery')</h5>
                        </div>
                        <div class="card-body d-flex gap-2 flex-wrap">
                            
                            <div class="row gy-4 justify-content-center">
                                @forelse ($campaign->galleries as $item)
                                   <div class="col-lg-6">
                                       <div class="relevant-img-item">
                                           <img src="{{ getImage(getFilePath('gallery') . '/' . $item->image) }}" alt="@lang('Image')">
                                       </div>
                                   </div>
                                @empty

                                @endforelse
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-lg-12">
            <div class="card-two">
                <div class="card-title">
                   <h5> @lang('Description')</h5>
                </div>
                <div class="card-body">
                    @php echo $campaign->description @endphp
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card-two mb-4">
                <div class="card-title mb-4">
                   <h5> @lang('Comment')</h5>
                </div>
                <div class="card-body">
                    @if ($campaign->comments->count())
                        <div class="table-wrap table-responsive">
                            <table class="table table--responsive--md table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('Fullname') | @lang('Email')</th>
                                        <th>@lang('Comment')</th>
                                        <th>@lang('Created At')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campaign->comments as $comment)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ __($comment->fullname) }}</span>
                                                <span class="d-block">{{ $comment->email }}</span>
                                            </td>
                                            <td>{{ strLimit($comment->comment, 30) }}</td>
                                            <td>
                                                {{ showDateTime($comment->created_at) }}
                                                <span class="d-block">{{ diffForHumans($comment->created_at) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center border-1"> @lang('No comment yet')</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <x-confirmation-modal />
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/animate.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/plugins/lightcase.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict';

        $('a[data-rel^=lightcase]').lightcase();



        $('.approve').click(function() {
            $('#approveModal').attr('action', $(this).data('action'));
            $('#approveModal').modal('show');
        });

        $('.reject').click(function() {
            $('#rejectModal').attr('action', $(this).data('action'));
            $('#rejectModal').modal('show');
        });

    </script>
@endpush

@push('style')
<style>
    .list-group-item{
        border:0;
    }
    .border-b{
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .gallery-card {
        width: 100%;
    }
    iframe.iframe {
        width: 100%;
        min-height: 400px;
    }
</style>
@endpush