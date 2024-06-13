@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5 align-items-center">
        <div class="col-xl-12">
            <div class="card-two mb-4">
                <div class="card-header">
                    <div class="row">
                        @include('admin.partials.tab.general')
                    </div>

                </div>
            </div>
            <div class="card-two">
                <h5 class="card-title mb-3">@lang('Site Configuration')</h5>
                <form action="{{ route('admin.configuration.update') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="registration">@lang('User Registration')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                        data-on="@lang('Enable')" data-off="@lang('Disable')" name="registration"
                                        id="registration" @if ($general->registration) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="force_ssl">@lang('Force SSL')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                        data-on="@lang('Enable')" data-off="@lang('Disable')" id="force_ssl"
                                        name="force_ssl" @if ($general->force_ssl) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="secure_password">@lang('Secure Password')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                        data-on="@lang('Enable')" data-off="@lang('Disable')" id="secure_password"
                                        name="secure_password" @if ($general->secure_password) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="agree">@lang('Agree Policy')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                        data-on="@lang('Enable')" data-off="@lang('Disable')" id="agree"
                                        name="agree" @if ($general->agree) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="kv">@lang('KYC Verification')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                        data-on="@lang('Enable')" data-off="@lang('Disable')" id="kv"
                                        name="kv" @if ($general->kv) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="ev">@lang('Email Verification')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle"
                                        data-on="@lang('Enable')" data-off="@lang('Disable')" id="ev"
                                        name="ev" @if ($general->ev) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="en">@lang('Email Notification')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')"
                                        data-off="@lang('Disable')" id="en" name="en"
                                        @if ($general->en) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="sv">@lang('Mobile Verification')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')"
                                        data-off="@lang('Disable')" id="sv" name="sv"
                                        @if ($general->sv) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="sn">@lang('SMS Notification')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')"
                                        data-off="@lang('Disable')" id="sn" name="sn"
                                        @if ($general->sn) checked @endif>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label class="mb-1" for="language_status">@lang('Language Option')</label>
                                <div class="form--switch">
                                    <input type="checkbox" role="switch" class="me-2 form-check-input"
                                        data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-bs-toggle="toggle" data-on="@lang('Enable')"
                                        data-off="@lang('Disable')" id="language_status" name="language_status"
                                        @if ($general->language_status) checked @endif>
                                </div>
                            </div>


                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
