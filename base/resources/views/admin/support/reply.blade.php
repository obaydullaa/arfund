@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-3">
        <div class="col-lg-12">
            <div class="card-two">
                <div class="card-body ">
                    <div class="row mb-4">
                        <div class="col-sm-8 col-md-6 fw-normal">
                            @php echo $ticket->statusBadge; @endphp

                            [@lang('Ticket#'){{ $ticket->ticket }}] {{ $ticket->subject }}
                        </div>

                        <div class="col-sm-4  col-md-6 text-sm-end mt-sm-0 mt-3">
                            @if ($ticket->status != Status::TICKET_CLOSE)
                                <button class="btn btn-outline--danger btn--sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#DelModal">
                                    <i class="fa fa-lg fa-times-circle"></i> @lang('Close Ticket')
                                </button>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('admin.ticket.reply', $ticket->id) }}" enctype="multipart/form-data"
                        method="post" class="form-horizontal">
                        @csrf



                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputMessage" class="mb-2">@lang('Send Message')</label>
                                    <textarea class="form--control w-100" placeholder="Type message" name="message" rows="5" required
                                        id="inputMessage"></textarea>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="browse-mage-container-multiple">
                                        <div class="multi-content-wrap">
                                            <div class="icon-wrap">
                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                                <label for="images" class="title selectMultiFiles"
                                                    role="button">@lang('Attachment Image') <span>@lang('Browse')</span></label>
                                            </div>
                                            <p class="support-text">@lang('Supported Files'):<span>.png, .jpg, .jpeg, .zip, .pdf,
                                                    .docs,
                                                    .xls</span></p>
                                        </div>

                                        <div class="thumb_area" id="multiContainerArea">

                                        </div>
                                        <input type="file" name="attachments[]" id="images"
                                            accept=".png, .jpg, .jpeg, .zip, .pdf, .docs, .xls" multiple hidden>
                                    </div>
                                </div>
                            </div>





                            <div class="col-lg-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <p class="mb-0">@lang('Attachments Max 5 files can be uploaded. Maximum upload size is 20MB')</p>
                                <button class="btn btn-outline-base" type="submit" name="replayTicket" value="1"><i
                                        class="la la-fw la-lg la-reply"></i> @lang('Reply')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <div class="row gy-4 ">
        <div class="col-lg-12">

            @foreach ($messages as $message)
                <div class="replay-box {{ $message->admin_id == 0 ? 'replay-even' : 'replay-odd' }}">
                    <div class="content-wrap">
                        <div class="d-flex justify-content-between flex-wrap mb-3">


                            <h6 class="name">
                                @if ($message->admin_id == 0)
                                    @if ($ticket->user_id != null)
                                        <a
                                            href="{{ route('admin.users.detail', $ticket->user_id) }}">&#64;{{ $ticket->name }}</a>
                                    @else
                                        @<span>{{ $ticket->name }}</span>
                                    @endif
                                @else
                                    {{ @$message->admin->name }}
                                @endif
                            </h6>

                            <p class="date-time">@lang('Posted on')
                                {{ showDateTime($message->created_at, 'l, dS F Y @ H:i') }}</p>
                        </div>
                        <p class="main-message">
                            {{ $message->message }}
                        </p>
                    </div>
                    <div class="attchfile-wrap">
                        <ul class="filelist-wrap">
                            @if ($message->attachments->count() > 0)
                                @foreach ($message->attachments as $k => $image)
                                    <li class="list">
                                        <a href="{{ route('admin.ticket.download', encrypt($image->id)) }}">
                                            <div class="icon-wrap">
                                                <img src="{{ asset('assets/admin/images/mw.png') }}" alt="...">
                                            </div>
                                            <p class="file-name"> @lang('Attachment') {{ ++$k }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                        <button type="button" class="btn text-danger px-0 confirmationBtn"
                            data-question="@lang('Are you sure to delete this message?')"
                            data-action="{{ route('admin.ticket.delete', $message->id) }}">
                            <i class="la la-trash-o me-2"></i> @lang('Remove')
                        </button>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Close Support Ticket!')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you want to close this support ticket?')</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('admin.ticket.close', $ticket->id) }}">
                        @csrf
                        <input type="hidden" name="replayTicket" value="2">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"> @lang('No')
                        </button>
                        <button type="submit" class="btn btn-outline-base"> @lang('Yes') </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection



@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.ticket.index') }}" />
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.delete-message').on('click', function(e) {
                $('.message_id').val($(this).data('id'));
            });

            var imageLengthCount = $(".thumb_area .image").length;

            if (imageLengthCount > 4) {
                notify('error', 'You\'ve added the maximum number of files');
                return false;
            }

            var fileArr = [];

            $("#images").change(function() {
                if (fileArr.length > 0) fileArr = [];

                $('#image_preview').html("");
                var total_file = document.getElementById("images").files;
                if (!total_file.length) {
                    return;
                }
                $('.post-thumb-upload-area').removeClass('d-none');

                $(".multi-content-wrap").addClass("d-none");
                var baseUrl = "{{ url('/') }}";

                var pdfLogo = baseUrl + '/assets/admin/images/ticket_pdf.png';
                var xlsLogo = baseUrl + '/assets/admin/images/ticket_xls.png';
                var docLogo = baseUrl + '/assets/admin/images/ticket_docs.png';
                var zipLogo = baseUrl + '/assets/admin/images/ticket_zip.png';

                for (var i = 0; i < total_file.length; i++) {
                    var file = total_file[i];
                    var fileType = file.type.split('/')[0];
                    var images = [];
                    switch (fileType) {
                        case 'image':
                            if (!images.some((e) => e.name === file.name)) {
                                images.push({
                                    name: file.name,
                                    url: URL.createObjectURL(file),
                                    type: 'image'
                                });
                            }
                            break;
                        case 'application':
                            if (file.name.endsWith('.pdf')) {
                                if (!images.some((e) => e.name === file.name)) {
                                    images.push({
                                        name: file.name,
                                        url: pdfLogo,
                                        type: 'pdf'
                                    });
                                }
                            } else if (file.name.endsWith('.xls') || file.name.endsWith('.xlsx')) {
                                if (!images.some((e) => e.name === file.name)) {
                                    images.push({
                                        name: file.name,
                                        url: xlsLogo,
                                        type: 'excel'
                                    });
                                }
                            } else if (file.name.endsWith('.doc') || file.name.endsWith('.docx')) {
                                if (!images.some((e) => e.name === file.name)) {
                                    images.push({
                                        name: file.name,
                                        url: docLogo,
                                        type: 'word'
                                    });
                                }
                            } else if (file.name.endsWith('.zip')) {
                                if (!images.some((e) => e.name === file.name)) {
                                    images.push({
                                        name: file.name,
                                        url: zipLogo,
                                        type: 'zip'
                                    });
                                }
                            } else {
                                $(".multi-content-wrap").removeClass("d-none");
                                $('#images').val('');
                                notify('error', 'Unsupported file type: ' + file.name);
                                return false;
                            }
                            break;
                        default:
                            $(".multi-content-wrap").removeClass("d-none");
                            $('#images').val('');
                            notify('error', 'Unsupported file type: ' + file.name);
                    }


                    fileArr.push(total_file[i]);

                    const text = total_file[i].name;
                    let filename;
                    if (text.includes(" ")) {
                        filename = text.replace(/ /g, "_");
                    } else {
                        filename = text;
                    }


                    $('#multiContainerArea').append(`
                        <div class="image oldImage" id="img-div${i}">
                            <span class="delete"><i class="fa-solid fa-xmark action-icon" role="temp${filename}" temp="img-div${i}"></i></span>
                            <img src="${images[0].url}" alt="${images[0].name}" />
                        </div>
                    `);

                }

                var imageLengthCount = $(".thumb_area .image").length;

                if (imageLengthCount > 5) {
                    notify('error', 'You\'ve added the maximum number of files');
                    $(".multi-content-wrap").removeClass("d-none");
                    $('#multiContainerArea').html('');
                    $('#images').val('');
                    return false;
                } else {
                    var newAddedItem = $('.fileSelect-option.selectMultiFiles.newAddedImage.emptyDiv').length;
                    if (imageLengthCount <= 4) {

                        if ($('.fileSelect-option.selectMultiFiles.newAddedImage.emptyDiv').length === 0) {
                            var labelId = Math.floor(Math.random() * 9000) + 1000;
                            var selectNewFileInput = '';
                            var baseUrl = "{{ url('/') }}";
                            var attachmentLogo = baseUrl + '/assets/admin/images/add-attchment.png';
                            selectNewFileInput +=
                                `<div class="fileSelect-option selectMultiFiles newAddedImage emptyDiv" id="newAddedImage-${labelId}" data-count='0'>`;
                            selectNewFileInput += `<div class="image" id="img-div${labelId}">`;
                            selectNewFileInput += `<label for="images-${labelId}" >`;
                            selectNewFileInput += `<img src="${attachmentLogo}" alt="add-attchmewnt"/>`;
                            selectNewFileInput += ` </label>`;
                            selectNewFileInput += `<span class="delete newAddedImageDelete">x</span>`;
                            selectNewFileInput +=
                                `<input type="file" name="attachments[]" id="images-${labelId}" accept=".png, .jpg, .jpeg, .zip, .pdf, .docs, .xls" hidden>`;
                            selectNewFileInput += '</div>';
                            selectNewFileInput += '</div>';

                            $("#multiContainerArea").append(selectNewFileInput);
                        }
                    }

                }

            });


            $(document).on('change', '[id^="images-"]', function() {

                var inputId = $(this).attr('id');
                var idNumber = inputId.split("-")[1];

                var imgId = inputId.replace('images-', 'img-div');
                var imgElement = $('#' + imgId + ' img');
                if ($(this).closest('#' + 'newAddedImage-' + idNumber).hasClass('emptyDiv')) {
                    $(this).closest('#' + 'newAddedImage-' + idNumber).removeClass('emptyDiv');
                }

                if (this.files && this.files[0]) {
                    var file = this.files[0];
                    var fileType = file.type.split('/')[0];


                    var baseUrl = "{{ url('/') }}";
                    var pdfLogo = baseUrl + '/assets/admin/images/ticket_pdf.png';
                    var xlsLogo = baseUrl + '/assets/admin/images/ticket_xls.png';
                    var docLogo = baseUrl + '/assets/admin/images/ticket_docs.png';
                    var zipLogo = baseUrl + '/assets/admin/images/ticket_zip.png';

                    switch (fileType) {
                        case 'image':
                            imgElement.attr('src', URL.createObjectURL(file));
                            break;
                        case 'application':
                            var iconUrl;
                            if (file.name.endsWith('.pdf')) {
                                iconUrl = pdfLogo;
                            } else if (file.name.endsWith('.xls') || file.name.endsWith('.xlsx')) {
                                iconUrl = xlsLogo;
                            } else if (file.name.endsWith('.doc') || file.name.endsWith('.docx')) {
                                iconUrl = docLogo;
                            } else if (file.name.endsWith('.zip')) {
                                iconUrl = zipLogo;
                            } else {
                                $(".multi-content-wrap").removeClass("d-none");
                                $("#multiContainerArea").addClass("d-none");
                                $("input[name='attachments[]']").val('');
                                notify('error', 'Unsupported file type: ' + file.name);
                                return false;
                            }

                            imgElement.attr('src', iconUrl);
                            break;
                        default:
                            $(".multi-content-wrap").removeClass("d-none");
                            $("#multiContainerArea").addClass("d-none");
                            $("input[name='attachments[]']").val('');
                            notify('error', 'Unsupported file type: ' + file.name);
                    }

                    $(this).closest('#' + 'newAddedImage-' + idNumber).addClass('notEmpty');



                    var oldImage = $('.thumb_area .image.oldImage').length;
                    var newAddedItem = $('.fileSelect-option.selectMultiFiles.newAddedImage').length;

                    if (oldImage + newAddedItem <= 4) {

                        if ($('.fileSelect-option.selectMultiFiles.newAddedImage.emptyDiv').length === 0) {
                            var labelId = Math.floor(Math.random() * 9000) + 1000;
                            var selectNewFileInput = '';
                            var baseUrl = "{{ url('/') }}";
                            var attachmentLogo = baseUrl + '/assets/admin/images/add-attchment.png';
                            selectNewFileInput +=
                                `<div class="fileSelect-option selectMultiFiles newAddedImage emptyDiv" id="newAddedImage-${labelId}" data-count='0'>`;
                            selectNewFileInput += `<div class="image" id="img-div${labelId}">`;
                            selectNewFileInput += `<label for="images-${labelId}" >`;
                            selectNewFileInput += `<img src="${attachmentLogo}" alt="add-attchmewnt"/>`;
                            selectNewFileInput += ` </label>`;
                            selectNewFileInput += `<span class="delete newAddedImageDelete">x</span>`;
                            selectNewFileInput +=
                                `<input type="file" name="attachments[]" id="images-${labelId}" accept=".png, .jpg, .jpeg, .zip, .pdf, .docs, .xls" hidden>`;
                            selectNewFileInput += '</div>';
                            selectNewFileInput += '</div>';

                            $("#multiContainerArea").append(selectNewFileInput);
                        }


                    }

                }

            });


            $('body').on('click', '.action-icon', function(evt) {
                var divName = $(this).attr('temp');
                var fileName = $(this).attr('role').replace("temp", "");

                $('#' + $(this).attr('temp')).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    const text1 = fileArr[i].name;
                    let filename1;
                    if (text1.includes(" ")) {
                        filename1 = text1.replace(/ /g, "_");
                    } else {
                        filename1 = text1;
                    }

                    if (filename1 === fileName) {
                        fileArr.splice(i, 1);
                        break;
                    }
                }
                document.getElementById('images').files = FileListItem(fileArr);
                if (fileArr.length <= 0) {
                    $('.post-thumb-upload-area').addClass('d-none');
                }

                var oldImage = $('.thumb_area .image.oldImage').length;
                var newAddedItem = $('.fileSelect-option.selectMultiFiles.newAddedImage.notEmpty').length;

                if (oldImage + newAddedItem <= 4) {
                    if ($('.fileSelect-option.selectMultiFiles.newAddedImage.emptyDiv').length === 0) {
                        var labelId = Math.floor(Math.random() * 9000) + 1000;
                        var selectNewFileInput = '';
                        var baseUrl = "{{ url('/') }}";
                        var attachmentLogo = baseUrl + '/assets/admin/images/add-attchment.png';
                        selectNewFileInput +=
                            `<div class="fileSelect-option selectMultiFiles newAddedImage emptyDiv" id="newAddedImage-${labelId}" data-count='0'>`;
                        selectNewFileInput += `<div class="image" id="img-div${labelId}">`;
                        selectNewFileInput += `<label for="images-${labelId}" >`;
                        selectNewFileInput += `<img src="${attachmentLogo}" alt="add-attchmewnt"/>`;
                        selectNewFileInput += ` </label>`;
                        selectNewFileInput += `<span class="delete newAddedImageDelete">x</span>`;
                        selectNewFileInput +=
                            `<input type="file" name="attachments[]" id="images-${labelId}" accept=".png, .jpg, .jpeg, .zip, .pdf, .docs, .xls" hidden>`;
                        selectNewFileInput += '</div>';
                        selectNewFileInput += '</div>';

                        $("#multiContainerArea").append(selectNewFileInput);
                    }
                }

                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }


            $('body').on('click', '.newAddedImageDelete', function(evt) {

                $(this).closest('.newAddedImage').remove();
                var oldImage = $('.thumb_area .image.oldImage').length;
                var newAddedItem = $('.fileSelect-option.selectMultiFiles.newAddedImage.notEmpty').length;

                console.log(oldImage, newAddedItem);

                if (oldImage + newAddedItem <= 4) {
                    if ($('.fileSelect-option.selectMultiFiles.newAddedImage.emptyDiv').length === 0) {
                        var labelId = Math.floor(Math.random() * 9000) + 1000;
                        var selectNewFileInput = '';
                        var baseUrl = "{{ url('/') }}";
                        var attachmentLogo = baseUrl + '/assets/admin/images/add-attchment.png';
                        selectNewFileInput +=
                            `<div class="fileSelect-option selectMultiFiles newAddedImage emptyDiv" id="newAddedImage-${labelId}" data-count='0'>`;
                        selectNewFileInput += `<div class="image" id="img-div${labelId}">`;
                        selectNewFileInput += `<label for="images-${labelId}" >`;
                        selectNewFileInput += `<img src="${attachmentLogo}" alt="add-attchmewnt"/>`;
                        selectNewFileInput += ` </label>`;
                        selectNewFileInput += `<span class="delete newAddedImageDelete">x</span>`;
                        selectNewFileInput +=
                            `<input type="file" name="attachments[]" id="images-${labelId}" accept=".png, .jpg, .jpeg, .zip, .pdf, .docs, .xls" hidden>`;
                        selectNewFileInput += '</div>';
                        selectNewFileInput += '</div>';

                        $("#multiContainerArea").append(selectNewFileInput);
                    }

                }

            });


        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .emptyDiv {
            cursor: pointer;
            .image {
                label{
                    cursor: pointer;
                }
                .newAddedImageDelete {
                    display: none !important
                }
            }
        }
    </style>
@endpush
