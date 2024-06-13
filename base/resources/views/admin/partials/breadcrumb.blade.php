<div class="row gy-2  mb-4">
    <div class="col-lg-6 col-md-6">
        <ol class="breadcrumb page-titles">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a></li>
            @if (!request()->routeIs('admin.dashboard'))
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __($pageTitle) }}</a></li>
            @endif
        </ol>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="group--btn">
            @stack('breadcrumb-plugins')
        </div>
    </div>
</div>