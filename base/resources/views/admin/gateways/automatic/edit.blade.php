@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-lg-12">
            <form action="{{ route('admin.gateway.automatic.update', $gateway->code) }}" method="POST" enctype="multipart/form-data">
                <div class="card-two mb-4">
                    @csrf

                    <input type="hidden" name="alias" value="{{ $gateway->alias }}">
                    <input type="hidden" name="description" value="{{ $gateway->description }}">

                    <div class="card-body">
                        <div class="payment-method-item block-item">
                            <div class="payment-method-header">
                                @if (count($supportedCurrencies) > 0)
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-lg-6">
                                            <h3 class="card-title title-border mb-5">{{ __($gateway->name) }}
                                                @lang('Gateway')</h3>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group--btn">
                                                <div class="form-group w-50">
                                                    <select class="form--control select form-select form--select newCurrencyVal">
                                                        <option value="">@lang('Select currency')</option>
                                                        @forelse($supportedCurrencies as $currency => $symbol)
                                                            <option value="{{ $currency }}"
                                                                data-symbol="{{ $symbol }}">
                                                                {{ __($currency) }} </option>
                                                        @empty
                                                            <option value="">@lang('No available currency support')</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="form-group text-end">
                                                    <button type="button" class="btn btn--global btn-outline-global  newCurrencyBtn" data-crypto="{{ $gateway->crypto }}" data-name="{{ $gateway->name }}">
                                                        @lang('Add new')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <p>{{ __($gateway->description) }}</p>
                            </div>


                            <div class="payment-method-body my-2">
                                <h4 class="mb-4">@lang('Global Setting for') {{ __($gateway->name) }}</h4>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <x-image-uploader class="w-100" id="gateway" name="image" :imagePath="getImage(getFilePath('gateway') . '/' . @$gateway->image,getFileSize('gateway'))" :size="getFileSize('gateway')" :required="false" :isImage="true" />
                                        </div>
                                    </div>

                                    <div class="col-lg-9">

                                        @if ($gateway->code < 1000 && $gateway->extra)
                                            <div class="payment-method-body p-0 m-0">
                                                <h4 class="mb-3">@lang('Configurations')</h4>
                                                <div class="row p-0 mt-0 mb-4">
                                                    @foreach ($gateway->extra as $key => $param)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="mb-2">{{ __(@$param->title) }}</label>
                                                                <div class="">
                                                                    <div class="copy-text-input">
                                                                        <input type="text" class="form--control w-100"
                                                                            value="{{ route($param->value) }}" readonly >
                                                                        <button type="button" class="copyInput copy-btn"
                                                                            title="@lang('Copy')"><i
                                                                                class="fa fa-copy"></i></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif


                                        @foreach ($parameters->where('global', true) as $key => $param)
                                            <div class="form-group">
                                                <label class="mb-2">{{ __(@$param->title) }}</label>
                                                <input type="text" class="form--control w-100"
                                                    name="global[{{ $key }}]" value="{{ @$param->value }}"
                                                    required >
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @isset($gateway->currencies)
                @foreach ($gateway->currencies as $gatewayCurrency)
                    <div class="card-two mb-4">
                        <input type="hidden" name="currency[{{ $currencyIndex }}][symbol]"  value="{{ $gatewayCurrency->symbol }}">
                        <div class="payment-method-item block-item child--item">
                            <div class="payment-method-header">
                                <div class="content w-100 ps-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <h4 class="mb-3">{{ __($gateway->name) }} - {{ __($gatewayCurrency->currency) }}</h4>
                                            <input type="text" class="form--control w-100" name="currency[{{ $currencyIndex }}][name]" value="{{ $gatewayCurrency->name }}" required >
                                        </div>
                                        <div class="remove-btn">
                                            <button type="button" class="btn btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to delete this gateway currency?')" data-action="{{ route('admin.gateway.automatic.remove', $gatewayCurrency->id) }}">
                                                <i class="la la-trash-o me-2"></i>@lang('Remove')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="payment-method-body">
                                <div class="row gy-4">

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="currency-card">
                                            <div class="card--header">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                                <p>@lang('Range')</p>
                                            </div>
                                            <div class="current-input-wrap">
                                                <div class="form-group">
                                                    <label class="mb-2">@lang('Minimum Amount')</label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form--control w-100 br-right--0" name="currency[{{ $currencyIndex }}][min_amount]" value="{{ getAmount($gatewayCurrency->min_amount) }}" required >
                                                        <div class="input-group-text br-right">{{ __($general->cur_text) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="mb-2">@lang('Maximum Amount')</label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form--control w-100 br-right--0" name="currency[{{ $currencyIndex }}][max_amount]" value="{{ getAmount($gatewayCurrency->max_amount) }}" required >
                                                        <div class="input-group-text br-right">{{ __($general->cur_text) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="currency-card">
                                            <div class="card--header">
                                                <i class="fa-regular fa-money-bill-1"></i>
                                                <p>@lang('Charge')</p>
                                            </div>
                                            <div class="current-input-wrap">
                                                <div class="form-group">
                                                    <label class="mb-2">@lang('Fixed Charge')</label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form--control w-100 br-right--0"
                                                            name="currency[{{ $currencyIndex }}][fixed_charge]"
                                                            value="{{ getAmount($gatewayCurrency->fixed_charge) }}"
                                                            required >
                                                        <div class="input-group-text br-right">{{ __($general->cur_text) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="mb-2">@lang('Percent Charge')</label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form--control w-100 br-right--0"
                                                            name="currency[{{ $currencyIndex }}][percent_charge]"
                                                            value="{{ getAmount($gatewayCurrency->percent_charge) }}"
                                                            required >
                                                        <div class="input-group-text br-right">%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="currency-card">
                                            <div class="card--header">
                                                <i class="fa-solid fa-coins"></i>
                                                <p>@lang('Currency')</p>
                                            </div>
                                            <div class="current-input-wrap">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="mb-2">@lang('Currency')</label>
                                                            <input type="text"
                                                                name="currency[{{ $currencyIndex }}][currency]"
                                                                class="form--control w-100 border-radius-5 "
                                                                value="{{ $gatewayCurrency->currency }}" readonly >
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="mb-2">@lang('Symbol')</label>
                                                            <input type="text"
                                                                name="currency[{{ $currencyIndex }}][symbol]"
                                                                class="form--control w-100 border-radius-5 symbl"
                                                                value="{{ $gatewayCurrency->symbol }}"
                                                                data-crypto="{{ $gateway->crypto }}" required >
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="mb-2">@lang('Rate')</label>
                                                    <div class="input-group">
                                                        <div class="input-group-text br-right--0">1 {{ __($general->cur_text) }} =
                                                        </div>
                                                        <input type="number" step="any" class="form--control w-100 br-0"
                                                            name="currency[{{ $currencyIndex }}][rate]"
                                                            value="{{ getAmount($gatewayCurrency->rate) }}" required >
                                                        <div class="input-group-text br-left--0"><span
                                                                class="currency_symbol br-right">{{ __($gatewayCurrency->baseSymbol()) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($parameters->where('global', false)->count() != 0)
                                        @php
                                            $globalParameters = json_decode($gatewayCurrency->gateway_parameter);
                                        @endphp
                                        <div class="col-lg-12">
                                            <div class="card mt-4">
                                                <h5 class="card-header">@lang('Configuration')</h5>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($parameters->where('global', false) as $key => $param)
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __($param->title) }}</label>
                                                                    <input type="text" class="form--control w-100"
                                                                        name="currency[{{ $currencyIndex }}][param][{{ $key }}]"
                                                                        value="{{ $globalParameters->$key }}" required >
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $currencyIndex++ @endphp
                    </div>

                    @endforeach
                @endisset

                <div class="payment-method-item card-two child--item gy-4 newMethodCurrency d-none mt-5">
                    <input disabled type="hidden" name="currency[{{ $currencyIndex }}][symbol]" class="currencySymbol">
                    <div class="payment-method-header">

                        <div class="content w-100 ps-0">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <h4 class="mb-3" id="payment_currency_name">@lang('Name')</h4>
                                    <input disabled type="text" class="form--control w-100"
                                        name="currency[{{ $currencyIndex }}][name]" required placeholder="@lang('Gateway Name')">
                                </div>
                                <div class="remove-btn">
                                    <button type="button" class="btn btn-outline-danger newCurrencyRemove">
                                        <i class="la la-trash-o me-2"></i>@lang('Remove')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="payment-method-body">
                        <div class="row gy-3">

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="currency-card">
                                    <div class="card--header">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                        <p>@lang('Range')</p>
                                    </div>
                                    <div class="current-input-wrap">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Minimum Amount')</label>
                                            <div class="input-group">
                                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                                <input disabled type="number" step="any" class="form--control w-100 br-left--0"
                                                    name="currency[{{ $currencyIndex }}][min_amount]" required >
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label class="mb-2">@lang('Maximum Amount')</label>
                                            <div class="input-group">
                                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                                <input disabled type="number" step="any" class="form--control w-100 br-left--0"
                                                    name="currency[{{ $currencyIndex }}][max_amount]" required
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="currency-card">
                                    <div class="card--header">
                                        <i class="fa-regular fa-money-bill-1"></i>
                                        <p>@lang('Charge')</p>
                                    </div>
                                    <div class="current-input-wrap">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Fixed Charge')</label>
                                            <div class="input-group">
                                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                                <input disabled type="number" step="any" class="form--control w-100 br-left--0"
                                                    name="currency[{{ $currencyIndex }}][fixed_charge]" required >
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="mb-2">@lang('Percent Charge')</label>
                                            <div class="input-group">
                                                <div class="input-group-text">%</div>
                                                <input disabled type="number" step="any" class="form--control w-100 br-left--0"
                                                    name="currency[{{ $currencyIndex }}][percent_charge]" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="currency-card">
                                    <div class="card--header">
                                        <i class="fa-solid fa-coins"></i>
                                        <p>@lang('Currency')</p>
                                    </div>
                                    <div class="current-input-wrap">



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-2">@lang('Currency')</label>
                                                    <input disabled type="text"
                                                        class="form--control w-100 currencyText"
                                                        name="currency[{{ $currencyIndex }}][currency]" readonly >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    <label class="mb-2">@lang('Symbol')</label>
                                                    <input  type="text"
                                                        name="currency[{{ $currencyIndex }}][symbol]"
                                                        class="form--control w-100 symbl"
                                                        data-crypto="{{ $gateway->crypto }}" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label class="mb-2">@lang('Rate')</label>
                                            <div class="input-group">
                                                <span class="input-group-text br-right--0">
                                                    <b>1 </b>&nbsp; {{ __($general->cur_text) }}&nbsp; =
                                                </span>
                                                <input disabled type="number" step="any" class="form--control w-100 br-0"
                                                    name="currency[{{ $currencyIndex }}][rate]" required >
                                                <div class="input-group-text"><span class="currency_symbol br-right--0"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($parameters->where('global', false)->count() != 0)
                                <div class="col-lg-12">
                                    <div class="card mt-4">
                                        <h5 class="card-header bg-warning">@lang('Configuration')</h5>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($parameters->where('global', false) as $key => $param)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __($param->title) }}</label>
                                                            <input disabled type="text" class="form--control w-100"
                                                                name="currency[{{ $currencyIndex }}][param][{{ $key }}]"
                                                                required >
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row py-4">
                    <div class="col-lg-12 text-end">
                        <button type="submit" class="btn btn-outline-base">
                            @lang('Submit')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-confirmation-modal />

@endsection


@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.gateway.automatic.index') }}" />
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.newCurrencyBtn').on('click', function() {
                var form = $('.newMethodCurrency');
                var getCurrencySelected = $('.newCurrencyVal').find(':selected').val();
                if(!getCurrencySelected)
                {
                    notify('error', 'Please select available currency');
                    return false;
                }
                var currency = $(this).data('crypto') == 1 ? 'USD' : `${getCurrencySelected}`;
                if (!getCurrencySelected) return;
                form.find('input').removeAttr('disabled');
                var symbol = $('.newCurrencyVal').find(':selected').data('symbol');
                form.find('.currencyText').val(getCurrencySelected);
                form.find('.currency_symbol').text(currency);
                $('#payment_currency_name').text(`${$(this).data('name')} - ${getCurrencySelected}`);
                form.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $('html, body').height()
                }, 'slow');

                $('.newCurrencyRemove').on('click', function() {
                    form.find('input').val('');
                    form.remove();
                });
            });

            $('.symbl').on('input', function() {
                var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
                $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
            });

            $('.copyInput').on('click', function(e) {
                var copybtn = $(this);

                var input = copybtn.closest('.copy-text-input').find('input');
                if (input && input.select) {
                    input.select();
                    try {
                        document.execCommand('SelectAll')
                        document.execCommand('Copy', false, null);
                        input.blur();
                        notify('success', `Copied: ${copybtn.closest('.copy-text-input').find('input').val()}`);
                    } catch (err) {
                        alert('Please press Ctrl/Cmd + C to copy');
                    }
                }
            });

        })(jQuery);
    </script>
@endpush
