@extends('admin.layouts.app')

@section('panel')

    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                        <tr>
                            <th>@lang('Email')</th>
                            <th>@lang('IP')</th>
                            <th>@lang('Subscribe At')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td data-label="@lang('Email')">{{ $subscriber->email }}</td>
                                <td data-label="@lang('IP')">{{ $subscriber->ip }}</td>
                                <td data-label="@lang('Subscribe At')">{{ showDateTime($subscriber->created_at) }}</td>
                                <td data-label="@lang('Action')">
                                    <button class="btn btn--sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to remove this subscriber?')" data-action="{{ route('admin.subscriber.remove',$subscriber->id) }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="4">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>

                @if ($subscribers->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($subscribers) }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start">
        <a href="{{ route('admin.subscriber.send.email') }}" class="btn btn--sm btn--global btn-outline-global text-white"><i class="fa-solid fa-paper-plane"></i> @lang('Send Email')</a>
    </div>
@endpush
