@extends('admin.layouts.master')
@section('content')
    <section class="recovary-section" style="background-image: url('{{ asset('assets/admin/images/loginbg.png') }}')">
        <div class="container">
            <div class="row mx-0">
                <div class="col-xl-12">
                    <div class="row gy-4 justify-content-center mb-5">
                        <div class="col-xl-3 col-lg-4">
                            <div class="status-card">
                                <div class="number">
                                    <p class="text">1</p>
                                </div>
                                <div class="content">
                                    <p class="text">@lang('Recover Account')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="status-card status-card-btmborder">
                                <div class="number">
                                    <p class="text">2</p>
                                </div>
                                <div class="content">
                                    <p class="text">@lang('OTP Verification')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="status-card">
                                <div class="number">
                                    <p class="text">3</p>
                                </div>
                                <div class="content">
                                    <p class="text">@lang('Change password')</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6">
                            <div class="base-card">
                                <div class="content">
                                    <h5 class="card-title">@lang('OTP Verification')</h5>
                                    <p class="subtitle">@lang('Enter the verification code we just sent to your') </p>
                                </div>
                                <div class="form-wrap mb-5">
                                    <form action="{{ route('admin.password.verify.code') }}" method="POST"
                                        class="login-form w-100">
                                        @csrf
                                        <div class="mb-4 form-group">
                                            <div class="verification-code">
                                                <input type="text" class="form-control form--control overflow-hidden"
                                                    name="code">
                                                <div class="boxes">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn base-two w-100">@lang('Verify')</button>
                                    </form>
                                </div>
                                <p class="text-center class-timeline"><a
                                        href="{{ route('admin.password.reset') }}">@lang('Try to send again')</a></p>
                                <p class="text-center option-text"><a
                                        href="{{ route('admin.login') }}">@lang('Sign In')</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script>
        (function($) {
            'use strict';
            $('[name=code]').on('input', function() {

                $(this).val(function(i, val) {
                    if (val.length >= 6) {
                        $('form').find('button[type=submit]').html(
                            '<i class="las la-spinner fa-spin"></i>');
                        $('form').find('button[type=submit]').removeClass('disabled');
                        $('form')[0].submit();
                    } else {
                        $('form').find('button[type=submit]').addClass('disabled');
                    }
                    if (val.length > 6) {
                        return val.substring(0, val.length - 1);
                    }
                    return val;
                });

                for (let index = $(this).val().length; index >= 0; index--) {
                    $($('.boxes span')[index]).html('');
                }
            });

        })(jQuery)
    </script>
@endpush
