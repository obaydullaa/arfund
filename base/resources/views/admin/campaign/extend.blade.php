@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4 mb-5">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap gap-2 justify-content-start">
                <x-search-form placeholder="Search..." />
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Campaign')</th>
                                <th>@lang('Category')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Deadline')</th>
                                <th>@lang('Goal')</th>
                                <th>@lang('Extend Goal ')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaigns as $campaign)
                                <tr>
                                    <td data-label="@lang('Campaign')">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img class="thumb rounded-circle"
                                                    src="{{ getImage(getFilePath('campaignImg') . '/' . @$campaign->image, getFileSize('campaignImg')) }}"
                                                    alt="@lang('Image')">
                                            </div>
                                            {{ strLimit($campaign->title, 25) }}
                                        </div>
                                    </td>
                                    <td data-label="@lang('Category')">
                                        <span>
                                            {{ $campaign->category->name }}
                                        </span>
                                    </td>

                                    <td data-label="@lang('User')">
                                        <p> {{ @$campaign->user->fullname }}</p>
                                        <a class="text--small" href="{{ appendQuery('search', @$campaign->user->username) }}"><span>@</span>{{ @$campaign->user->username }}</a>
                                    </td>
                                    <td data-label="@lang('Deadline')">
                                        {{ showDateTime($campaign->date) }}
                                        <br>
                                        {{ diffForHumans($campaign->date) }}
                                    </td>
                                    <td data-label="@lang('Goal')">
                                        {{ $general->cur_sym }}{{ showAmount($campaign->goal) }}
                                    </td>

                                    <td data-label="@lang('Extend Goal')"> 
                                        {{ $general->cur_sym }}{{ showAmount($campaign->extend_goal) }}
                                    </td>

                                    <td data-label="@lang('Action')">
                                        <div class="button--group">
                                            <a data-bs-toggle="tooltip" data-bs-title="@lang('Details')"
                                                href="{{ route('admin.campaign.details', $campaign->id) }}"
                                                class="btn btn--sm btn-outline-base">

                                                <i class="fa-solid fa-display"></i>
                                            </a>
                                            @if (request()->routeIs('admin.users.kyc.pending'))
                                                <a href="{{ route('admin.users.kyc.details', $campaign->id) }}" target="_blank"
                                                    class="btn btn--sm btn-outline-dark">
                                                    <i class="fa-solid fa-user-shield"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="{{ $pageTitle }}" class="text-muted text-center" colspan="7">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if ($campaigns->hasPages())
                        <div class="py-4">
                            {{ paginateLinks($campaigns) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection