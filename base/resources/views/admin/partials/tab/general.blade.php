<div class="col-lg-12 ">
    <div class="link-wrap">
        <a href="{{ route('admin.setting.index') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.setting.index') ? 'btn-outline-base-active' : '' }} me-2 ">
            <span class="btn-icon-left"><i class="fa-solid fa-screwdriver-wrench"></i> </span>
            @lang('Site Setting')
        </a>

        <a href="{{ route('admin.setting.configuration') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.setting.configuration') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-gear"></i>
            </span>
            @lang('Configuration')
        </a>

        <a href="{{ route('admin.setting.logo.icon') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.setting.logo.icon') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-puzzle-piece"></i>
            </span>
            @lang('Logo & Icon')
        </a>

        <a href="{{ route('admin.plugins.index') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.plugins.index') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-bars-progress"></i>
            </span>
            @lang('Plugins')
        </a>

        <a href="{{ route('admin.seo') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.seo') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-magnifying-glass-chart"></i>
            </span>
            @lang('SEO')
        </a>

        <a href="{{ route('admin.maintenance.mode') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.maintenance.mode') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-file-code"></i>
            </span>
            @lang('Maintainance Mode')
        </a>

        <a href="{{ route('admin.setting.cookie') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.setting.cookie') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-cookie-bite"></i>
            </span>
            @lang('GDPR Cookie')
        </a>

        <a href="{{ route('admin.setting.custom.css') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.setting.custom.css') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-brands fa-css3"></i>
            </span>
            @lang('Custom CSS')
        </a>
        <a href="{{ route('admin.language.manage') }}"
            class="btn mb-1 btn--global pill btn--outline-global {{ request()->routeIs('admin.language.manage') || request()->routeIs('admin.language.key') ? 'btn-outline-base-active' : '' }} me-2">
            <span class="btn-icon-left">
                <i class="fa-solid fa-globe"></i>
            </span>
            @lang('Language Setting')
        </a>
    </div>
</div>