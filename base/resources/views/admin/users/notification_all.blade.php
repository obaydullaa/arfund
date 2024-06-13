@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        <div class="col-xl-12">
            <div class="card-two">
                <form class="notify-form">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Being Sent') </label>
                                    <div class="input-group">
                                        <span class="input-group-text">@lang('To')</span>
                                        <select class="form--control w-100 select form-select br-left--0" name="being_sent_to"
                                            required>
                                            @foreach ($notifyToUser as $key => $toUser)
                                                <option value="{{ $key }}">{{ __($toUser) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-append"></div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Send Via') </label>
                                    <select class="form--control w-100 select form-select" name="send_via" required>
                                        <option value="all">@lang('All')</option>
                                        <option value="sms">@lang('SMS')</option>
                                        <option value="email">@lang('Email')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Subject') </label>
                                    <input class="form--control w-100" name="subject" type="text"
                                        placeholder="@lang('Email subject')" required >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">@lang('Message') </label>
                                    <textarea class="form--control w-100 summernote" name="message" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 start-from-col">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Start Form') </label>
                                            <input class="form--control w-100" name="start_form" type="number"
                                                placeholder="@lang('Start form user')" required >
                                        </div>
                                    </div>
                                    <div class="col-md-4 per-batch-col">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Per Batch') </label>
                                            <div class="input-group">
                                                <input class="form--control w-100 br-right--0" name="batch" type="number"
                                                    placeholder="@lang('How many user')" required >
                                                <span class="input-group-text br-left--0">
                                                    @lang('User')
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 cooling-period-col">
                                        <div class="form-group">
                                            <label class="mb-2">@lang('Cooling Period') </label>
                                            <div class="input-group">
                                                <input class="form--control w-100 br-right--0" name="cooling_time" type="number"
                                                    placeholder="@lang('Waiting time')" required >
                                                <span class="input-group-text br-left--0">
                                                    @lang('Seconds')
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <button class="btn btn-outline-base" type="submit">@lang('Submit')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notificationSending" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header  modal-close-btn d-none">

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-5">

                    <div class="mail-wrapper mb-3">
                        <div class="thumb-wrap">
                            <img src="{{ asset('assets/admin/images/imgs/bell.png') }}" alt="@lang('Notification Image')">
                        </div>
                        <h4 class="modal-title text-center">@lang('Notification Sending')</h4>

                        <p class="text--danger dontCloseWarning text-center">@lang('Don\'t close or refresh the window till finish.')</p>



                        <div class='animation'>
                            <div class='i-mail'>
                                <i class="fa-solid fa-earth-europe"></i>
                                <div class='mail-anim'><i class="fa-solid fa-envelope"></i></div>
                            </div>
                            <div class='line'></div>
                            <div class='i-success'>
                                <div class='success-anim'>
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="finalStatistics d-none">
                        <div class="mail-icon text--success fw-bold text-center my-4">
                            <i class="fas fa-check"></i> @lang('Done')
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Start From')<span class="fw-bold startFrom">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Ended at')<span class="fw-bold sent">0</span>
                            </li>
                        </ul>
                    </div>
                    <h4 class="text--primary remainingTime d-none text-center">0</h4>

                    <div class="mt-3">
                        <p class="sentStatistics text-center mb-4">@lang('Email sent') <span class="startFrom">0</span>
                            @lang('to') <span class="sent">-</span> @lang('users')
                        </p>
                        <div class="text-center sentStatistics">
                            <button class="btn btn-outline-danger stop-sent-btn stopSending"><i
                                    class="fa-solid fa-power-off"></i></button>
                            <p class="text-danger"> @lang('Stop')</p>

                        </div>
                        <div class="modelCloseButton d-none text-end">
                            <button class="btn btn-outline-danger" data-bs-dismiss="modal" type="button"
                                aria-label="Close">
                                @lang('Close')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('style')
    <style>
        .coolingIcon {
            margin: 0 auto;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"

            var subject = null,
                message = null,
                start = null,
                perBatch = null,
                sendingStatus = true,
                coolingTime = null,
                being_sent_to = null,
                _token = null,
                user = null,
                number_of_top_deposited_user,
                number_of_days,
                sendVia
            $('.notify-form').on('submit', function(e) {
                subject = $(this).find('[name=subject]').val();
                being_sent_to = $(this).find('[name=being_sent_to]').val();
                message = $(this).find('.summernote').summernote('code');
                start = parseInt($(this).find('[name=start_form]').val());
                perBatch = parseInt($(this).find('[name=batch]').val());
                coolingTime = parseInt($(this).find('[name=cooling_time]').val());
                user = $(".input-append").find(`#user_list`).val();

                number_of_top_deposited_user = $(".input-append").find(
                    'input[name=number_of_top_deposited_user]').val();
                number_of_days = $(".input-append").find('input[name=number_of_days]').val();

                sendVia = $(this).find('select[name=send_via]').val();
                _token = $(this).find('[name=_token]').val();

                if ({{ $users }} <= 0) {
                    notify('error', 'Users not found');
                    return false;
                }
                if (!coolingTime) {
                    notify('error', `@lang('Cooling period must be greater then zero')`);
                    return false;
                }
                if (!perBatch) {
                    notify('error', `@lang('Per batch must be greater then zero')`);
                    return false;
                }
                e.preventDefault();
                sendingStatus = true;
                $('.progress-bar').css('width', `0%`);
                $('.progress-bar').text(`0%`);
                $('.sent').text('-');
                $('.stopSending,.dontCloseWarning,.sentStatistics').removeClass('d-none');
                $('.finalStatistics,.modelCloseButton').addClass('d-none');
                $('#notificationSending').modal('show');

                $('.startFrom').text(start);
                postMail();
            });

            function postMail() {
                if (!sendingStatus) {
                    $('.remainingTime,.coolingIcon,.dontCloseWarning,.sentStatistics').addClass('d-none')
                    $('.finalStatistics,.modelCloseButton').removeClass('d-none');
                    return;
                }
                $('.remainingTime').text('Cooling...')
                $('.remainingTime,.coolingIcon').addClass('d-none')
                $('.sendingIcon').removeClass('d-none')
                $.post("{{ route('admin.users.notification.all.send') }}", {
                    "subject": subject,
                    "_token": _token,
                    "start": start,
                    "batch": perBatch,
                    "message": message,
                    'being_sent_to': being_sent_to,
                    'user': user,
                    'number_of_top_deposited_user': number_of_top_deposited_user,
                    'number_of_days': number_of_days,
                    'send_via': sendVia,
                }, function(response) {

                    $('.remainingTime').removeClass('d-none')
                    $('.sendingIcon').addClass('d-none')
                    $('.coolingIcon').removeClass('d-none')
                    if (response.error) {
                        response.error.forEach(error => {
                            notify('error', error)
                        });
                    } else {
                        start += parseInt(response.total_sent);
                        $('.sent').text(start);
                        if (!parseInt(response.total_sent)) {
                            sendingStatus = false;
                            postMail();
                            return;
                        }
                        $('.sentStatistics').removeClass('d-none');
                        setTimeout(function() {
                            clearInterval(interval)
                            postMail();
                        }, coolingTime * 1000);
                        var counter = coolingTime - 1,
                            interval = setInterval(function() {
                                $('.remainingTime').text("Reloading after " + counter + " seconds");
                                counter--;
                                if (counter <= 0) clearInterval(interval);
                            }, 1000);
                    }
                });
            }

            $('.stopSending').on('click', function() {
                sendingStatus = false;
                notify('info', `@lang('Notification sending will stop after this batch.')`);
                $('.modal-close-btn').removeClass('d-none');
                $('.sentStatistics').addClass('d-none')
            });

            $('select[name=being_sent_to]').on('change', function(e) {
                let methodName = $(this).val();
                methodName = methodName.toUpperCase();
                if (methodName == 'SELECTEDUSERS') {
                    $('.input-append').html(`
                    <div class="form-group" id="user_list_wrapper">
                        <label class="required mb-2">@lang('Select User')</label>
                        <select name="user[]"  class="form--control w-100 select form-select" id="user_list" required multiple>
                            <option disabled>@lang('Select One')</option>
                        </select>
                    </div>
                    `);

                    fetchUserList();
                    changeEmailSendingOptionHtml(true);
                    return;
                }

                if (methodName == 'TOPDEPOSITEDUSERS') {
                    $('.input-append').html(`
                    <div class="form-group">
                        <label class="required">@lang('Number Of Top Deposited User')</label>
                        <input class="form-control" type="number" name="number_of_top_deposited_user" >
                    </div>
                    `);
                    changeEmailSendingOptionHtml(true);
                    return
                }

                if (methodName == 'NOTLOGINUSERS') {
                    $('.input-append').html(`
                    <div class="form-group">
                        <label class="required">@lang('Number Of Days')</label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="number_of_days" >
                            <span class="input-group-text">@lang('Days')</span>
                        </div>
                    </div>
                    `);
                    changeEmailSendingOptionHtml(true);
                    return
                }

                $('.input-append').empty();
                changeEmailSendingOptionHtml();

            });

            function fetchUserList() {
                $('.row #user_list').select2({
                    ajax: {
                        url: "{{ route('admin.users.list') }}",
                        type: "get",
                        dataType: 'json',
                        delay: 1000,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page,
                            };
                        },
                        processResults: function(response, params) {
                            params.page = params.page || 1;
                            let data = response.users.data;
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.email,
                                        id: item.id
                                    }
                                }),
                                pagination: {
                                    more: response.more
                                }
                            };
                        },
                        cache: false,
                    },
                    dropdownParent: $('.input-append #user_list_wrapper')
                });
            }

            function changeEmailSendingOptionHtml(change = true) {
                if (change) {
                    $('.start-from-col').addClass('d-none');
                    $('.cooling-period-col').addClass('col-lg-6').removeClass('.col-md-4');
                    $('.per-batch-col').addClass('col-lg-6').removeClass('.col-md-4');
                    $('input[name=start_form]').attr('required', false).val(0);
                    return;
                }
                $('.start-from-col').removeClass('d-none');
                $('.cooling-period-col').removeClass('col-lg-6').addClass('col-md-4');
                $('.per-batch-col').removeClass('col-lg-6').addClass('col-md-4');
                $('input[name=start_form]').attr('required', true);
            }

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        #user_list_wrapper {
            position: relative
        }

        .loaderr {
            width: 100%;
            height: 18px;
            display: inline-block;
            position: relative;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .loaderr::before {
            content: '';
            box-sizing: border-box;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            position: absolute;
            background-color: rgba(255, 255, 255, 0.15);
            background-image: linear-gradient(45deg, rgba(0, 0, 0, 0.25) 25%, transparent 25%, transparent 50%, rgba(0, 0, 0, 0.25) 50%, rgba(0, 0, 0, 0.25) 75%, transparent 75%, transparent);
            background-size: 15px 15px;
            z-index: 10;
            border-radius: 74px
        }

        .loaderr::after {
            content: '';
            box-sizing: border-box;
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #4540F7 0%, #1919DE 100%);
            position: absolute;
            border-radius: 0 74px 74px 0;
            top: 0;
            left: 0;
            animation: animFw 10s ease-in infinite;
        }


        @keyframes animFw {
            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
        }


        .animation {

            display: flex;
            align-items: center;
            justify-content: space-between;
            align-items: center
        }

        .fa-earth-europe:before, .fa-globe-europe:before {
            content: "\f390";
        }

        .fa-envelope:before {
            content: "\f0e0";
            color: hsl(var(--main));
        }

        .i-mail,
        .i-mail .mail-anim {
            font-size: 30px;
            position: relative;
            animation: transformS 0.3s linear;
        }

        @keyframes transformS {
            50% {
                transform: scale(0.5, 0.5);
                opacity: 0.5;
            }
        }

        .i-mail .mail-anim {
            position: absolute;
            top: 0px;
            left: 0px;
            animation: moveL 0.8s linear infinite;
        }

        @keyframes moveL {
            100% {
                transform: translateX(220px) rotateY(90deg);
            }
        }

        .line {
            padding: 1px 210px;
            background-image: linear-gradient(to right, #000 30%, rgba(255, 255, 255, 0) 0%);
            background-position: top;
            background-size: 15px 2px;
            background-repeat: repeat-x;
        }

        .i-success,
        .i-success .success-anim {
            position: relative;
            animation: transformB 0.3s 1.4s linear forwards;
            font-size: 30px;
            color: hsl(var(--main));

        }

        .i-success::after {
            content: '\f0c0';
            font-family: FontAwesome;
            color: hsl(var(--yellow));
            position: absolute;
            top: 0px;
            right: -12px;
        }


        @keyframes transformB {
            50% {
                transform: scale(1.5, 1.5);

            }

            100% {}
        }

        @keyframes transformBA {
            100% {
                border-bottom: 2px solid #fff;
                border-left: 2px solid #fff;
            }
        }

        .i-success .success-anim {
            animation: moveR 1.8s 1s linear infinite;
            color: hsl(var(--yellow));
        }

        @keyframes moveR {
            0% {
                transform: translateX(-220px) rotateY(90deg);
            }

            50% {
                transform: translateX(0) rotateY(0);
            }
            55%{
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
@endpush
