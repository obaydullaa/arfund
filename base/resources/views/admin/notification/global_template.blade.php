@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">

        <div class="col-md-12">
            <h6 class="card-title mb-3">@lang('Template Short Codes')</h6>

            <div class="card-two overflow-hidden p-0">

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
                                <td  data-label="@lang('Short Code')">
                                    <span class="short-codes">@{{ fullname }}
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="@lang('Click to Copy')"
                                            class="fa-solid fa-copy" data-shortcode="@{{ fullname }}"></i>
                                    </span>
                                </td>
                                <td data-label="@lang('Full form')">@lang('Full Name of User')</td>
                            </tr>
                            <tr>
                                <td data-label="@lang('Short Code')">
                                    <span class="short-codes">@{{ username }}
                                        <i data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="@lang('Click to Copy')" class="fa-solid fa-copy"
                                            data-shortcode="@{{ username }}"></i>
                                    </span>
                                </td>
                                <td data-label="@lang('Full form')">@lang('Username of User')</td>
                            </tr>
                            <tr>
                                <td data-label="@lang('Short Code')">
                                    <span class="short-codes">@{{ message }}
                                        <i data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="@lang('Click to Copy')" class="fa-solid fa-copy"
                                            data-shortcode="@{{ message }}"></i>
                                    </span>
                                </td>
                                <td data-label="@lang('Full form')">@lang('Message')</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <h6 class="card-title mt-5 mb-3">@lang('Global Short Codes')</h6>
            <div class="card-two overflow-hidden p-0">

                <div class="table-wrap">
                    <table class="table table--responsive--xl table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Short Code') </th>
                                <th>@lang('Description')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($general->global_shortcodes as $shortCode => $codeDetails)
                                <tr>
                                    <td data-label="@lang('Short Code')"><span class="short-codes">@{{ @php echo $shortCode @endphp }}
                                            <i data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="@lang('Click to Copy')" class="fa-solid fa-copy"
                                                data-shortcode="{{ $shortCode }}"></i>
                                        </span>
                                    </td>
                                    <td data-label="@lang('Full form')">{{ __($codeDetails) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card-two">
                <h6 class="card-title mb-3">@lang('Design Template')</h6>
                <form action="{{ route('admin.setting.notification.global.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">@lang('Email Sent From') </label>
                                <input type="text" class="form--control w-100" placeholder="@lang('Email address')"
                                    name="email_from" value="{{ $general->email_from }}" required >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">@lang('Email Body') </label>
                                <textarea name="email_template" rows="10" class="form--control w-100 summernote" placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">@lang('SMS Sent From') </label>
                                <input class="form--control w-100" placeholder="@lang('SMS Sent From')" name="sms_from"
                                    value="{{ $general->sms_from }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">@lang('SMS Body') </label>
                                <textarea class="form--control w-100" rows="4" placeholder="@lang('SMS Body')" name="sms_body" required>{{ $general->sms_body }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-outline-base">@lang('Submit')</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@push('style')
    <style>
        .note-editor .note-editing-area .note-editable table td, .note-editor .note-editing-area .note-editable table th {
            border: none;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.short-codes').on('click', function() {
                var text = $(this).text();
                var vInput = document.createElement("input");

                vInput.value = text;
                console.log(text);
                document.body.appendChild(vInput);
                vInput.select();
                document.execCommand("copy");
                document.body.removeChild(vInput);
                $(this).addClass('copied');

                notify('success', 'Code copied successfully');
                return false;

                setTimeout(() => {
                    $(this).removeClass('copied');
                }, 1000);
            });

        })(jQuery);
    </script>
@endpush
