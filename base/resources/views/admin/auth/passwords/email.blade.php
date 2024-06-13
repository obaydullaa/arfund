@extends('admin.layouts.master')
@section('content')
    <section class="recovary-section" style="background-image: url('{{ asset('assets/admin/images/loginbg.png') }}')">
        <div class="container">
            <div class="row mx-0">
                <div class="col-xl-12">
                    <div class="row gy-4 justify-content-center mb-5">
                        <div class="col-xl-3 col-lg-4">
                            <div class="status-card status-card-btmborder">
                                <div class="number">
                                    <p class="text">1</p>
                                </div>
                                <div class="content">
                                    <p class="text">@lang('Recover Account')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="status-card">
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
                                    <h5 class="card-title">@lang('Recover Account')</h5>
                                    <p class="subtitle">@lang('If you are already a member you can login with your email address and password.')</p>
                                </div>
                                <div class="form-wrap mb-5">
                                    <form action="{{ route('admin.password.reset') }}" method="POST"
                                        class="login-form verify-gcaptcha">
                                        @csrf
                                        <div class="mb-4 form-group">
                                            <label class="mb-2 form--label">@lang('Email')</label>
                                            <input class="form--control form-control-2 w-100" type="email" name="email"
                                                value="{{ old('email') }}" required>
                                        </div>
                                        <button type="submit" class="btn base-two w-100">@lang('Submit')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </section>
@endsection


