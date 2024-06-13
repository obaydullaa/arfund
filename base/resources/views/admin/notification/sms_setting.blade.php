@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-md-12">
            <div class="card-two">
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="mb-2">@lang('Sms Send Method')</label>
                            <select name="sms_method" class="form--control form--select select form-select" >
                                <option value="messageBird" @if(@$general->sms_config->name == 'messageBird') selected @endif>@lang('Message Bird')</option>
                                <option value="nexmo" @if(@$general->sms_config->name == 'nexmo') selected @endif>@lang('Nexmo')</option>
                                <option value="twilio" @if(@$general->sms_config->name == 'twilio') selected @endif>@lang('Twilio')</option>
                                <option value="custom" @if(@$general->sms_config->name == 'custom') selected @endif>@lang('Custom API')</option>
                            </select>
                        </div>

                        <div class="row mt-4 d-none configForm" id="messageBird">
                            <div class="col-md-12">
                                <h6 class="card-title mb-4">@lang('Message Bird Configuration')</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('API Key') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('API Key')" name="message_bird_api_key" value="{{ @$general->sms_config->message_bird->api_key }}">
                                </div>
                            </div>
                        </div>

                        <div class="row gy-3 mt-4 d-none configForm" id="nexmo">
                            <div class="col-md-12">
                                <h6 class="card-title">@lang('Nexmo Configuration')</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">@lang('API Key') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('API Key')" name="nexmo_api_key" value="{{ @$general->sms_config->nexmo->api_key }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">@lang('API Secret') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('API Secret')" name="nexmo_api_secret" value="{{ @$general->sms_config->nexmo->api_secret }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 d-none configForm" id="twilio">
                            <div class="col-md-12">
                                <h6 class="card-title mb-4">@lang('Twilio Configuration')</h6>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="w-100 mb-2">@lang('Account SID') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('Account SID')" name="account_sid" value="{{ @$general->sms_config->twilio->account_sid }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="w-100 mb-2">@lang('Auth Token') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('Auth Token')" name="auth_token" value="{{ @$general->sms_config->twilio->auth_token }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="w-100 mb-2">@lang('From Number') </label>
                                    <input type="text" class="form--control w-100" placeholder="@lang('From Number')" name="from" value="{{ @$general->sms_config->twilio->from }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 d-none configForm" id="custom">
                            <div class="col-md-12">
                                <h6 class="card-title mb-4">@lang('Custom API')</h6>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('API URL') </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <select name="custom_api_method" class="method-select form--control form--select select form-select">
                                                <option value="get">@lang('GET')</option>
                                                <option value="post">@lang('POST')</option>
                                            </select>
                                        </span>
                                        <input type="text" class="form--control w-100 br-left--0" name="custom_api_url" value="{{ @$general->sms_config->custom->url }}" placeholder="@lang('API URL')">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-two p-0 mb-4">
                                    <div class="table-wrap">
                                        <table class="table table--responsive--xl table-hover">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Short Code') </th>
                                                    <th>@lang('Description')</th>
                                                </tr>
                                            </thead>

                                            <tbody class="list">
                                                <tr>
                                                    <td><span class="short-codes">@{{message}}</span></td>
                                                    <td>@lang('Message')</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="short-codes">@{{number}}</span></td>
                                                    <td>@lang('Number')</td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-two mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h5>@lang('Headers')</h5>
                                        <button type="button" class="btn btn--sm btn--global btn-outline--global float-right addHeader"><i class="fa-solid fa-plus"></i> @lang('Add') </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="headerFields">
                                            @for($i = 0; $i < count($general->sms_config->custom->headers->name); $i++)
                                                <div class="row mt-3">
                                                    <div class="col-md-5">
                                                        <input type="text" name="custom_header_name[]" class="form--control w-100" value="{{ @$general->sms_config->custom->headers->name[$i] }}" placeholder="@lang('Headers Name')">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="custom_header_value[]" class="form--control w-100" value="{{ @$general->sms_config->custom->headers->value[$i] }}" placeholder="@lang('Headers Value')">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn--sm h-100 w-100 btn-outline--danger btn-block removeHeader"><i class="fa-solid fa-xmark"></i></button>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-two mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h5>@lang('Body')</h5>
                                        <button type="button" class="btn btn--sm btn--global btn-outline--global float-right addBody"><i class="fa-solid fa-plus"></i> @lang('Add') </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="bodyFields">
                                            @for($i = 0; $i < count($general->sms_config->custom->body->name); $i++)
                                                <div class="row mt-3">
                                                    <div class="col-md-5">
                                                        <input type="text" name="custom_body_name[]" class="form--control w-100" value="{{ @$general->sms_config->custom->body->name[$i] }}" placeholder="@lang('Body Name')">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="custom_body_value[]" value="{{ @$general->sms_config->custom->body->value[$i] }}" class="form--control w-100" placeholder="@lang('Body Value')">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn--sm h-100 w-100 btn-outline--danger btn-block removeBody"><i class="fa-solid fa-xmark"></i></button>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="testSMSModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Test SMS Setup')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.setting.notification.sms.test') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Sent to') </label>
                                    <input type="text" name="mobile" class="form--control w-100" placeholder="@lang('Mobile')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <button type="button" data-bs-target="#testSMSModal" data-bs-toggle="modal" class="btn btn-outline-base btn--sm"><i class="fa-regular fa-paper-plane"></i> @lang('Send Test SMS')</button>
@endpush
@push('style')
<style>
    .method-select{
        padding: 2px 7px;
    }
</style>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";

            var method = '{{ @$general->sms_config->name }}';

            if (!method) {
                method = 'clickatell';
            }

            smsMethod(method);
            $('select[name=sms_method]').on('change', function() {
                var method = $(this).val();
                smsMethod(method);
            });

            function smsMethod(method){
                $('.configForm').addClass('d-none');
                if(method != 'php') {
                    $(`#${method}`).removeClass('d-none');
                }
            }

            $('.addHeader').on('click', function(){
                var html = `
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <input type="text" name="custom_header_name[]" class="form--control w-100" placeholder="@lang('Headers Name')">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="custom_header_value[]" class="form--control w-100" placeholder="@lang('Headers Value')">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn h-100 w-100 btn-outline--danger btn-block removeHeader"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                `;
                $('.headerFields').append(html);

            })
            $(document).on('click','.removeHeader',function(){
                $(this).closest('.row').remove();
            })

            $('.addBody').on('click', function(){
                var html = `
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <input type="text" name="custom_body_name[]" class="form--control w-100" placeholder="@lang('Body Name')">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="custom_body_value[]" class="form--control w-100" placeholder="@lang('Body Value')">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn h-100 w-100 btn-outline--danger btn-block removeBody"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                `;
                $('.bodyFields').append(html);

            })
            $(document).on('click','.removeBody',function(){
                $(this).closest('.row').remove();
            })

            $('select[name=custom_api_method]').val('{{ @$general->sms_config->custom->method }}');

        })(jQuery);

    </script>
@endpush
