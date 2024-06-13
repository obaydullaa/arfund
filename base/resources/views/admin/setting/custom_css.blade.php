@extends('admin.layouts.app')
@section('panel')

<div class="row gy-4   mb-5 align-items-center">
    <div class="col-md-12">
        <div class="card-two mb-4">
            <div class="card-header">
                <div class="row">
                    @include('admin.partials.tab.general')
                </div>

            </div>

        </div>
        <div class="card-two">
            <h5 class="card-title mb-3">@lang('Custom CSS')</h5>
            <div class="card-body">

                <p class="my-3">
                    <span>@lang('This page allows you to modify the CSS for the user interface. Any modifications made here require programming proficiency.')</span>
                    <span>@lang('Please refrain from altering, adding, or removing any code unless you possess adequate knowledge.')</span>
                </p>

                <form method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-lg-12">
                                <div class="form-group custom-css">
                                    <textarea class="form-control customCss" rows="10" name="css">{{ $fileContent }}</textarea>
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
</div>





@endsection
@push('style')
<style>
    .CodeMirror{
        border-top: 1px solid hsl(var(--white));
        border-bottom: 1px solid hsl(var(--white));
        line-height: 1.3;
        height: 500px;
    }
    .CodeMirror-linenumbers{
      padding: 0 8px;
    }
    .custom-css p, .custom-css li, .custom-css span{
      color: hsl(var(--white));
    }
    .cm-s-monokai span.cm-tag{
        margin-left: 15px;
    }
  </style>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{asset('assets/admin/css/codemirror.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/monokai.min.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset('assets/admin/js/codemirror.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/css.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/sublime.min.js')}}"></script>
@endpush
@push('script')
<script>
    "use strict";
    var editor = CodeMirror.fromTextArea(document.getElementsByClassName("customCss")[0], {
      lineNumbers: true,
      mode: "text/css",
      theme: "monokai",
      keyMap: "sublime",
      autoCloseBrackets: true,
      matchBrackets: true,
      showCursorWhenSelecting: true,
      matchBrackets: true
    });
</script>
@endpush
