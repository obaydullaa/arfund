@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <div class="card-two p-0">
                <div class="table-wrap table-responsive">
                    <table class="table table--responsive--md table-hover">
                        <thead>
                        <tr>
                            <th>@lang('Logo')</th>
                            <th>@lang('Gateway')</th>
                            <th>@lang('Supported Currency')</th>
                            <th>@lang('Enabled Currency')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($gateways->sortBy('alias') as $k=>$gateway)
                            <tr>
                                <td data-label="@lang('Logo')">
                                    <div class="logo-img">
                                        <img class="thumb" src="{{getImage(getFilePath('gateway') . '/' . @$gateway->image)}}" alt="@lang('Gateway Image')">
                                    </div>
                                </td>
                                <td data-label="@lang('Gateway')">{{__($gateway->name)}}</td>

                                <td data-label="@lang('Supported Currency')">
                                    <span>@lang('Total') {{ collect($gateway->supported_currencies)->count() }}
                                            <i data-bs-toggle="modal" data-bs-target="#currencyModal" class="fa-solid fa-caret-down supported_currency c-pointer" data-supported_currency="{{ collect($gateway->supported_currencies)->keys()->toJson() }}"></i>
                                    </span>
                                </td>
                                <td data-label="@lang('Enabled Currency')">
                                    <span> @lang('Total') {{ $gateway->currencies->count() }}
                                        @if($gateway->currencies->count() > 0)
                                        <i data-bs-toggle="modal" data-bs-target="#currencyModal" class="fa-solid fa-caret-down enabled_currency c-pointer"  data-enabled_currency="{{@$gateway->currencies->pluck('currency')->toJson()}}" data-supported_currency="{{ collect($gateway->supported_currencies)->keys()->toJson() }}"></i>
                                        @endif
                                    </span>
                                </td>

                                <td data-label="@lang('Status')">
                                    @php
                                        echo $gateway->statusBadge
                                    @endphp
                                </td>
                                <td data-label="@lang('Action')">
                                    <div class="button--group">
                                        <a href="{{ route('admin.gateway.automatic.edit', $gateway->alias) }}" data-bs-toggle="tooltip" data-bs-title="@lang('Edit')" class="btn btn--sm btn-outline-base editGatewayBtn">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        @if($gateway->status == Status::DISABLE)
                                            <button class="btn btn--sm btn-outline-success ms-1 confirmationBtn" data-bs-toggle="tooltip" data-bs-title="@lang('Enable')" data-question="@lang('Are you sure to enable this gateway?')" data-action="{{ route('admin.gateway.automatic.status',$gateway->id) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        @else
                                            <button class="btn btn--sm btn-outline-danger ms-1 confirmationBtn" data-bs-toggle="tooltip" data-bs-title="@lang('Disable')" data-question="@lang('Are you sure to disable this gateway?')" data-action="{{ route('admin.gateway.automatic.status',$gateway->id) }}">
                                                <i class="fa-solid fa-eye-slash"></i>
                                            </button>
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
            </div>
        </div>
    </div>

    <x-confirmation-modal />



    <div id="currencyModal" class="modal fade" >
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Supported Currency')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pt-0 mb-2">
                    <div id="currencyList" class="currency-list">
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
@push('breadcrumb-plugins')
    <div class="d-inline">
        <form>
            @csrf
            <div class="input-group w-auto search-form">
                <input type="text" name="search_table" class="form--control br-right--0 w-100" placeholder="@lang('Search gateway')...">
                <button class="btn btn-outline-base input-group-text"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush

@push('script')
<script>
$(document).ready(function() {
    $('.supported_currency').on('click', function() {
        var currencies = $(this).data('supported_currency');
        $('#currencyList').empty();
        $.each(currencies, function(index, currency) {
            $('#currencyList').append('<span class="badge badge--success me-2">' + currency + '</span>');
        });
        $('#currencyModal').css('display', 'block');
    });
    $('.enabled_currency').on('click', function() {
        var currencies = $(this).data('enabled_currency');
        $('#currencyList').empty();
        $.each(currencies, function(index, currency) {
            $('#currencyList').append('<span class="badge badge--success me-2">' + currency + '</span>');
        });
        $('#currencyModal').css('display', 'block');
    });

    $('.close').on('click', function() {
        $('#currencyModal').css('display', 'none');
    });

});

    </script>
@endpush
