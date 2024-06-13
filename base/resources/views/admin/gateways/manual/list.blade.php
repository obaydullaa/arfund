@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap gap-2 justify-content-start">
                <form>
                    @csrf
                    <div class="input-group w-auto search-form">
                        <input type="text" name="search_table" class="form--control w-100 br-right--0 bg--white" placeholder="@lang('Search gatway')...">
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
                            <th>@lang('Gateway')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($gateways as $gateway)
                            <tr>
                                <td class="text-center" data-label="@lang('Logo')">
                                    <div class="logo-img ">
                                        <img class="thumb" src="{{getImage(getFilePath('gateway') . '/' . $gateway->image, getFileSize('gateway'))}}" alt="@lang('Gateway Image')">
                                    </div>
                                </td>
                                <td data-label="@lang('Gateway')">{{__($gateway->name)}}</td>

                                <td data-label="@lang('Status')">
                                    @php
                                        echo $gateway->statusBadge
                                    @endphp
                                </td>
                                <td data-label="@lang('Action')">
                                    <div class="button--group">
                                        <a href="{{ route('admin.gateway.manual.edit', $gateway->alias) }}" class="btn btn--sm btn-outline-base me-2 editGatewayBtn">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        @if($gateway->status == Status::DISABLE)
                                            <button class="btn btn--sm btn-outline-success confirmationBtn" data-question="@lang('Are you sure to enable this gateway?')" data-action="{{ route('admin.gateway.manual.status',$gateway->id) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        @else
                                            <button class="btn btn--sm btn-outline-danger confirmationBtn" data-question="@lang('Are you sure to disable this gateway?')" data-action="{{ route('admin.gateway.manual.status',$gateway->id) }}">
                                                <i class="fa-solid fa-eye-slash"></i>
                                            </button>
                                        @endif
                                    </div>
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
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start">
        <a class="btn btn--sm btn--global btn--outline-global ms-2" href="{{ route('admin.gateway.manual.create') }}"><i class="fa-solid fa-plus"></i> @lang('Add New')</a>
    </div>
@endpush
