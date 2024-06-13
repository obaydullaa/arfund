@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4 ">
        <div class="col-md-12">
            <h6 class="card-title mb-3">@lang('Template Short Codes')</h6>
            <div class="card-two p-0 mb-5">
                <div class="table-responsive table-responsive--sm">
                    <table class="table align-items-center table--light">
                        <thead>
                            <tr>
                                <th>@lang('Short Code')</th>
                                <th>@lang('Description')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse($template->shortcodes as $shortcode => $key)
                                <tr>
                                    <td data-label="@lang('Short Code')">
                                        <span class="short-codes">@php echo "{{". $shortcode ."}}"  @endphp
                                            <i  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="@lang('Click to Copy')" class="fa-solid fa-copy" data-shortcode="{{$shortcode}}"></i>
                                        </span>
                                    </td>
                                    <td data-label="@lang('Full form')">{{ __($key) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <h6 class="card-title mb-3">@lang('Global Short Codes')</h6>
            <div class="card-two overflow-hidden p-0 mb-5">
                <div class="card-body">
                    <div class="table-responsive table-responsive--sm">
                        <table class=" table align-items-center table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Short Code') </th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($general->global_shortcodes as $shortCode => $codeDetails)
                                    <tr>
                                        <td>
                                            <span class="short-codes">@php echo "{{". $shortCode ."}}"  @endphp
                                                <i  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="@lang('Click to Copy')" class="fa-solid fa-copy" data-shortcode="{{$shortCode}}"></i>
                                            </span>
                                        </td>
                                        <td>{{ __($codeDetails) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row gy-4 ">
        <div class="col-md-12">

                <form action="{{ route('admin.setting.notification.template.update', $template->id) }}" method="post">
                    @csrf
                    <div class="card-two">
                        <h4 class="card-title mb-4">@lang('Notification Template')</h4>
                        <ul class="nav nav-pills mb-5 gap-4">
                            <li class="nav-item">
                                <a href="#navemailtab" class="nav-link btn btn--global pill btn--outline-global active" data-bs-toggle="tab" aria-expanded="false">
                                    <span class="btn-icon-left">
                                        <i class="fa-regular fa-envelope"></i>
                                    </span>
                                    @lang('Email')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#navsmstab" class="nav-link btn btn--global pill btn--outline-global" data-bs-toggle="tab" aria-expanded="false">
                                    <span class="btn-icon-left">
                                        <i class="fa-solid fa-comment-sms"></i>
                                    </span>
                                    @lang('SMS')
                                </a>

                            </li>

                        </ul>

                        <div class="tab-content">
                            <div id="navemailtab" class="tab-pane active">
                                <div class="row align-items-center">
                                    <div class="row">
                                        <div class="col-xl-12">

                                            <div class="card-header">
                                                <h4 class="card-title mb-4">@lang('Email Template')</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row gy-3">
                                                    <div class="col-md-12 form-group">

                                                        <label class="mb-2" for="email_status">@lang('Email Notification Status')</label>
                                                        <div class="form--switch">
                                                            <input type="checkbox" role="switch"
                                                                class="form-check-input" data-width="100%"
                                                                data-onstyle="-success" data-offstyle="-danger"
                                                                data-bs-toggle="toggle" data-on="@lang('Send Email')"
                                                                data-off="@lang("Don't Send")" name="email_status"
                                                                id="email_status"
                                                                @if ($template->email_status) checked @endif>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="mb-2">@lang('Subject')</label>
                                                            <input type="text" class="form--control w-100" placeholder="@lang('Email subject')" name="subject" value="{{ $template->subj }}" required >
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="mb-2">@lang('Message') <span class="text-danger">*</span></label>
                                                            <textarea name="email_body" rows="10" class="form-control summernote" placeholder="@lang('Your message using short-codes')">{{ $template->email_body }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="navsmstab" class="tab-pane">
                                <div class="row align-items-center">
                                    <div class="row">
                                        <div class="col-xl-12">

                                                <div class="card-header">
                                                    <h4 class="card-title">@lang('SMS Template')</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="mb-2" for="sms_status">@lang('SMS Notification Status')</label>
                                                                <div class="form--switch">
                                                                    <input type="checkbox" role="switch"
                                                                        class="me-2 form-check-input" data-width="100%"
                                                                        data-onstyle="-success" data-offstyle="-danger"
                                                                        data-bs-toggle="toggle" data-on="@lang('Send SMS')"
                                                                        data-off="@lang("Don't Send")" name="sms_status"
                                                                        id="sms_status"
                                                                        @if ($template->sms_status) checked @endif>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="mb-2">@lang('Message')</label>
                                                                <textarea name="sms_body" rows="10" class="form-control" placeholder="@lang('Your message using short-codes')" required>{{ $template->sms_body }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row my-5">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>


@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.setting.notification.templates') }}" />
@endpush



@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.short-codes').on('click', function () {

                var text = $(this).text();
                var vInput = document.createElement("input");

                vInput.value = text;
                console.log(text);
                document.body.appendChild(vInput);
                vInput.select();
                document.execCommand("copy");
                document.body.removeChild(vInput);
                $(this).addClass('copied');

                    notify('success','Code copied successfully');
                    return false;

                setTimeout(() => {
                    $(this).removeClass('copied');
                }, 1000);
            });

        })(jQuery);
    </script>
@endpush
