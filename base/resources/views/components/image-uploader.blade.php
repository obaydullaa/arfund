@props([
    'type' => null,
    'image' => null,
    'imagePath' => null,
    'size' => null,
    'name' => 'image',
    'id' => 'fileInput',
    'accept' => '.png, .jpg, .jpeg',
    'required' => true,
    'darkMode' => false,
    'isImage' => false,
    'class' => '',
])

@php
    $size = $size ?? getFileSize($type);
    $imagePath = $imagePath ?? getImage(getFilePath($type) . '/' . $image, $size);
    $containerClass = trim('browse-mage-container ' . $class);
@endphp

<div class="form-group">
    <div class="{{ $containerClass }}">
        <div class="content-wrap {{$id}} {{ $isImage ? 'd-none' : ''}}">
            <span class="icon-wrap">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </span>
            <h6 class="title selectFiles_{{$id}}">@lang('Image here please') <span>@lang('Browse')</span></h6>
            <p class="support-text mb-2">@lang('Supported Files'):<span>{{ $accept }}</span></p>
            <p class="img-size-text">@lang('Image will be resized into'): <span>{{ $size }} @lang('px')</span></p>
        </div>
        <div class="thumb_area" id="containerArea_{{$id}}">
            <div class="image {{$isImage ? '' : 'd-none'}}">
                <div class="edit-button selectFiles_{{$id}}">
                    <i class="fa-solid fa-pen"></i>
                </div>
                <img src="{{ $imagePath }}" alt="{{$type}}">
            </div>
        </div>
        <input type="file" class="file" name="{{ $name }}" id="{{ $id }}" accept="{{ $accept }}" @required($required)>
    </div>
    <p class="fw-bold mt-1">@lang('Image Size'): (<span class="text-success">{{ @$size }}</span>)</p>
</div>
 
@push('script-lib')
    <script>
        (function() {
            "use strict";
            var images = [];
            var fileInputId = "{{$id}}";

            function selectFiles() {
                $("#" + fileInputId).click();
            }

            function onFileSelect(event) {
                const files = event.target.files;

                if (files.length === 0) {
                    $(".content-wrap." + fileInputId).removeClass("d-none");
                    return;
                }

                for (let i = 0; i < files.length; i++) {
                    if (files[i].type.split('/')[0] !== 'image') continue;
                    if (!images.some((e) => e.name == files[i].name)) {
                        images.push({
                            name: files[i].name,
                            url: URL.createObjectURL(files[i])
                        });
                    }
                }

                $(".content-wrap." + fileInputId).addClass("d-none");
                updateImages();
            }


            function deleteImage(index) {
                images.splice(index, 1);
                $(".content-wrap." + fileInputId).removeClass('d-none');
                updateImages();
            }

            function updateImages() {
                $("#containerArea_"+fileInputId).empty();

                images.forEach(function(image, index) {
                    var deleteButton = $('<span class="delete"><i class="fa-solid fa-xmark"></i></span>');
                    deleteButton.on('click', function() {
                        deleteImage(index);
                    });

                    var imageDiv = $('<div class="image"></div>').append(deleteButton).append(
                        $('<img src="' + image.url + '" alt="..."/>')
                    );
                    $("#containerArea_" + fileInputId).append(imageDiv);
                });
            }

            $(".selectFiles_"+fileInputId).click(selectFiles);
            $("#" + fileInputId).change(onFileSelect);
        })();
    </script>
@endpush