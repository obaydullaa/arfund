@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap gap-2 justify-content-start">
                <form>
                    @csrf
                    <div class="input-group w-auto search-form">
                        <input type="text" name="search_table" class="form--control br-right--0 w-100" placeholder="@lang('Search')...">
                        <button class="btn btn-outline-base input-group-text"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>



        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Logo')</th>
                                <th>@lang('Method')</th>
                                <th>@lang('Currency')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Withdraw Limit')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($methods as $method)
                            <tr>
                                <td data-label="@lang('Logo')">
                                    <div class="logo-img">
                                        <img class="thumb" src="{{getImage(getFilePath('gateway') . '/' . $method->image, getFileSize('gateway'))}}" alt="@lang('Gateway Image')">
                                    </div>
                                </td>
                                <td data-label="@lang('Method')">{{__($method->name)}}</td>

                                <td data-label="@lang('Currency')">{{ __($method->currency) }}</td>
                                <td data-label="@lang('Charge')">{{ showAmount($method->fixed_charge)}} {{__($general->cur_text) }} {{ (0 < $method->percent_charge) ? ' + '. showAmount($method->percent_charge) .' %' : '' }} </td>
                                <td data-label="@lang('Withdraw Limit')">
                                    {{ $method->min_limit + 0 }} - {{ $method->max_limit + 0 }} {{__($general->cur_text) }}</td>
                                <td data-label="@lang('Status')">
                                    @php
                                        echo $method->statusBadge
                                    @endphp
                                </td>
                                <td data-label="@lang('Action')">
                                    <div class="button--group">
                                        <a href="{{ route('admin.withdraw.method.edit', $method->id)}}" class="btn btn--sm btn-outline-base ms-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        @if($method->status == Status::ENABLE)
                                            <button class="btn btn--sm btn-outline-danger ms-1 confirmationBtn" data-question="@lang('Are you sure to disable this method?')" data-action="{{ route('admin.withdraw.method.status',$method->id) }}">
                                                <i class="fa-regular fa-eye-slash"></i>
                                            </button>
                                        @else
                                            <button class="btn btn--sm btn-outline-success ms-1 confirmationBtn" data-question="@lang('Are you sure to enable this method?')" data-action="{{ route('admin.withdraw.method.status',$method->id) }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td data-label="{{$pageTitle}}" class="text-muted text-center" colspan="7">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection



@push('breadcrumb-plugins')
    <div class="d-flex flex-nowrap">
        <a class="btn btn--sm btn--global btn--outline-global ms-2" href="{{ route('admin.withdraw.method.create') }}"><i class="fa-solid fa-plus"></i> @lang('Add New')</a>
    </div>
@endpush
