@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-12">
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <a href="{{ route('admin.report.transaction') }}?search={{ $user->username }}">
                        <div class="card--main-success card-shape">
                            <div class="content-wrap">
                                <div class="content">
                                    <h3 class="card-title">@lang('Balance')</h3>
                                    <span class="icon-wrap">
                                        <i class="fa-solid fa-wallet"></i>
                                    </span>
                                </div>
                                <h2 class="card-subtitle mb-2">{{ $general->cur_sym }}{{ showAmount($user->balance) }}</h2>
                            </div>
                            <span class="btn btn--global text-white w-100">@lang('View All')</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <a href="{{ route('admin.deposit.list') }}?search={{ $user->username }}">
                        <div class="card--main-warning card-shape">
                            <div class="content-wrap">
                                <div class="content">
                                    <h3 class="card-title">@lang('Deposits')</h3>
                                    <span class="icon-wrap">
                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                    </span>
                                </div>
                                <h2 class="card-subtitle mb-2">{{ $general->cur_sym }}{{ showAmount($totalDeposit) }}</h2>
                            </div>
                            <span class="btn btn--global text-white w-100">@lang('View All')</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <a href="{{ route('admin.withdraw.log') }}?search={{ $user->username }}">
                        <div class="card--main-info card-shape">
                            <div class="content-wrap">
                                <div class="content">
                                    <h3 class="card-title">@lang('Withdrawals')</h3>
                                    <span class="icon-wrap">
                                        <i class="fa-solid fa-money-check-dollar"></i>
                                    </span>
                                </div>
                                <h2 class="card-subtitle mb-2">{{ $general->cur_sym }}{{ showAmount($totalWithdrawals) }}
                                </h2>
                            </div>
                            <span class="btn btn--global text-white w-100">@lang('View All')</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <a href="{{ route('admin.report.transaction') }}?search={{ $user->username }}">
                        <div class="card--main-primary card-shape">
                            <div class="content-wrap">
                                <div class="content">
                                    <h3 class="card-title">@lang('Transactions')</h3>
                                    <span class="icon-wrap">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                    </span>
                                </div>
                                <h2 class="card-subtitle mb-2">{{ $totalTransaction }}</h2>
                            </div>
                            <span class="btn btn--global text-white w-100">@lang('View All')</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-3 mt-5">

                <div class="button-icon">
                    <button data-bs-toggle="modal" data-bs-target="#addSubModal" data-act="add" type="button"
                        class="btn mb-1 btn--global  pill btn--outline-global bal-btn">
                        <span class="btn-icon-left">
                            <i class="fa fa-plus"></i>
                        </span>
                        @lang('Add Balance')
                    </button>
                </div>

                <div class="button-icon">
                    <button data-bs-toggle="modal" data-bs-target="#addSubModal" data-act="sub" type="button"
                        class="btn mb-1 btn--global pill btn--outline-global bal-btn">
                        <span class="btn-icon-left">
                            <i class="fa-solid fa-minus"></i>
                        </span>
                        @lang('Subtract Balance')
                    </button>
                </div>

                <div class="button-icon">
                    <a href="{{ route('admin.users.login.history', $user->id) }}" class="btn mb-1 btn--global pill btn--outline-global">
                        <span class="btn-icon-left">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </span>
                        @lang('Account Login History')
                    </a>
                </div>

                <div class="button-icon">
                    <a href="{{ route('admin.users.notification.log', $user->id) }}"
                        class="btn mb-1 pill btn--global btn--outline-global">
                        <span class="btn-icon-left">
                            <i class="fa-solid fa-bell"></i>
                        </span>
                        @lang('Notification History')
                    </a>
                </div>

                <div class="button-icon">
                    <a target="_blank" href="{{ route('admin.users.login', $user->id) }}"
                        class="btn mb-1 btn--global pill btn--outline-global">
                        <span class="btn-icon-left">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </span>
                        @lang('Login as User')
                    </a>
                </div>

                @if ($user->kyc_data)
                    <div class="button-icon">
                        <a href="{{ route('admin.users.kyc.details', $user->id) }}"
                            class="btn mb-1 btn--global pill btn--outline-global">
                            <span class="btn-icon-left">
                                <i class="fa-solid fa-shield-halved"></i>
                            </span>
                            @lang('KYC Data')
                        </a>
                    </div>
                @endif

                @if ($user->status == Status::USER_ACTIVE)
                    <div class="button-icon">
                        <button data-bs-toggle="modal" data-bs-target="#userStatusModal" type="button"
                            class="btn mb-1 btn--global pill btn--outline-global userStatus">
                            <span class="btn-icon-left">
                                <i class="fa-solid fa-ban"></i>
                            </span>
                            @lang('Block User')
                        </button>
                    </div>
                @else
                    <div class="button-icon">
                        <button data-bs-toggle="modal" data-bs-target="#userStatusModal" type="button"
                            class="btn mb-1 btn--global pill btn--outline-global userStatus">
                            <span class="btn-icon-left">
                                <i class="fa-solid fa-rotate-left"></i>
                            </span>
                            @lang('Unblock User')
                        </button>
                    </div>
                @endif

            </div>

            <div class="row mt-4 gy-4">
                <div class="col-lg-12">
                    <div class="card-two">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                @lang('Information of') <strong>{{ ucwords(@$user->fullname) }}</strong>
                            </h5>
                            <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname" class="mb-2">@lang('First Name')</label>
                                            <input class="form--control w-100" type="text" id="fname"
                                                name="firstname" required value="{{ $user->firstname }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lname" class="mb-2">@lang('Last Name')</label>
                                            <input class="form--control w-100" type="text" name="lastname"
                                                id="lname" required value="{{ $user->lastname }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="mb-2">@lang('Email') </label>
                                            <input class="form--control w-100" type="email" id="email"
                                                name="email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile" class="mb-2">@lang('Mobile Number') </label>
                                            <div class="input-group ">
                                                <span class="input-group-text mobile-code br-left"></span>
                                                <input type="number" name="mobile" value="{{ old('mobile') }}"
                                                    id="mobile" class="form--control br-left--0 w-100 checkUser"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="address" class="mb-2">@lang('Address')</label>
                                            <input class="form--control w-100" type="text" id="address"
                                                name="address" value="{{ @$user->address->address }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-md-6">
                                        <div class="form-group">
                                            <label for="city" class="mb-2">@lang('City')</label>
                                            <input class="form--control w-100" type="text" id="city"
                                                name="city" value="{{ @$user->address->city }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-md-6">
                                        <div class="form-group ">
                                            <label for="state" class="mb-2">@lang('State')</label>
                                            <input class="form--control w-100" type="text" id="state"
                                                name="state" value="{{ @$user->address->state }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-md-6">
                                        <div class="form-group ">
                                            <label for="zipcode" class="mb-2">@lang('Zip/Postal')</label>
                                            <input class="form--control w-100" type="text" id="zipcode"
                                                name="zip" value="{{ @$user->address->zip }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-md-6">
                                        <div class="form-group ">
                                            <label for="country" class="mb-2">@lang('Country')</label>
                                            <select name="country" class="form--control w-100 select form-select"
                                                id="country">
                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}"
                                                        value="{{ $key }}">{{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-xl-3 col-md-6 col-sm-6 ">
                                        <div class="form--switch">
                                            <input type="checkbox" role="switch" class="me-2 form-check-input"
                                                data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                                data-bs-toggle="toggle" data-on="@lang('Verified')"
                                                data-off="@lang('Unverified')" name="ev" id="ev"
                                                @if ($user->ev) checked @endif>
                                            <label for="ev" class="mb-1">@lang('Email Verification')</label>
                                        </div>
                                    </div>

                                    <div class="form-group  col-xl-3 col-md-6 col-sm-6">
                                        <div class="form--switch">
                                            <input type="checkbox" class="me-2 form-check-input" data-width="100%"
                                                data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                                data-on="@lang('Verified')" data-off="@lang('Unverified')" name="sv"
                                                id="sv" @if ($user->sv) checked @endif>
                                            <label for="sv" class="mb-1">@lang('Mobile Verification')</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-3 col-md-6 col-sm-6">
                                        <div class="form--switch">
                                            <input type="checkbox" class="me-2 form-check-input" data-width="100%"
                                                data-height="50" data-onstyle="-success" data-offstyle="-danger"
                                                data-bs-toggle="toggle" data-on="@lang('Enable')"
                                                data-off="@lang('Disable')" name="ts" id="ts"
                                                @if ($user->ts) checked @endif>
                                            <label for="ts" class="mb-1">@lang('2FA Verification') </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-3 col-md-6 col-sm-6">
                                        <div class="form--switch">
                                            <input type="checkbox" class="me-2 form-check-input" data-width="100%"
                                                data-height="50" data-onstyle="-success" data-offstyle="-danger"
                                                data-bs-toggle="toggle" data-on="@lang('Verified')"
                                                data-off="@lang('Unverified')" name="kv" id="kv"
                                                @if ($user->kv == 1) checked @endif>
                                            <label for="kv" class="mb-1">@lang('KYC') </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-outline-base">
                                                @lang('Submit')
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="addSubModal" class="modal fade " tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span>@lang('Balance')</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.users.add.sub.balance', $user->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="act">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-2">@lang('Amount')</label>
                            <div class="input-group">
                                <input type="number" step="any" name="amount"
                                    class="form--control w-100 br-right--0" placeholder="@lang('Please provide positive amount')"
                                    min="0" required>
                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mb-2">@lang('Remark')</label>
                            <textarea class="form--control w-100" placeholder="@lang('Remark')" name="remark" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="userStatusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @if ($user->status == Status::USER_ACTIVE)
                                <span>@lang('Block User')</span>
                            @else
                                <span>@lang('Unblock User')</span>
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            @if ($user->status == Status::USER_ACTIVE)
                                <h6 class="mb-2 fw-bold">@lang('If you block this user he/she won\'t be able to access his/her dashboard.')</h6>
                                <div class="form-group">
                                    <label for="message" class="col-form-label text-danger">@lang('Reason'):</label>
                                    <textarea class="form--control w-100" name="reason" id="message"></textarea>
                                </div>
                            @else
                                <h4 class="text-center mt-3">@lang('Are you sure to unblock this user?')</h4>
                                <p><span>@lang('Ban reason was'):</span></p>
                                <p class="text-danger">{{ $user->ban_reason }}</p>
                            @endif

                        </div>
                        <div class="modal-footer">
                            @if ($user->status == Status::USER_ACTIVE)
                                <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                            @else
                                <button type="button" class="btn btn--md btn-outline-dark"
                                    data-bs-dismiss="modal">@lang('No')</button>
                                <button type="submit" class="btn btn--md btn-outline-base">@lang('Yes')</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict"
            $('.bal-btn').on('click', function() {
                var act = $(this).data('act');
                $('#addSubModal').find('input[name=act]').val(act);
                if (act == 'add') {
                    $('.type').text('Add');
                } else {
                    $('.type').text('Subtract');
                }
            });
            let mobileElement = $('.mobile-code');
            $('select[name=country]').change(function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });

            $('select[name=country]').val('{{ @$user->country_code }}');
            let dialCode = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber = `{{ $user->mobile }}`;
            mobileNumber = mobileNumber.replace(dialCode, '');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);

        })(jQuery);
    </script>
@endpush
