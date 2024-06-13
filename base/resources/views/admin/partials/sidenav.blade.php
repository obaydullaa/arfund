<div class="dashboard-sidebar">
    <div class="close-btn">
        <i class="fa-regular fa-circle-xmark"></i>
    </div>
    <div class="mian-logo--wrap">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ siteLogo(true) }}" alt="@lang('Site Logo')">
        </a>
    </div>
    <div class="sidebar-content--wrap">
        <ul class="menu--list">
            <li class="list--item {{ menuActive('admin.dashboard') }} link">
                <a href="{{ route('admin.dashboard') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-table-columns"></i></span>
                    <span class="text">@lang('Dashboard')</span>
                </a>
            </li>
            <li class="list--item lable">
                <span class="text">@lang('CAMPAIGNS')</span>
            </li>
            {{-- Category  --}}
            <li class="list--item link {{ menuActive('admin.category.index') }} ">
                <a href="{{ route('admin.category.index') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-list"></i></span>
                    <span class="text">@lang('Categories')</span>
                </a>
            </li>
            {{-- // campaign  --}}
            <li class="list--item has-dropdown {{ menuActive(['admin.campaign.*']) }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive(['admin.campaign.*']) }}">
                    <span class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                    <span class="text">
                        @lang('Campaigns')
                        @if ($pendingCampaign || $extendCampaign || $pendingComment)
                            <i class="fa-solid fa-triangle-exclamation text-warning ms-2"></i>
                        @endif
                    </span>
                </a>
                {{-- // campaigns  --}}
                <div class="list--item-submenu {{ menuActive(['admin.campaign.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.campaign.index') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.index') }}">
                                @lang('All Campaigns')
                            </a>
                        </li>

                        <li class="submenu--item">
                            <a href="{{route('admin.campaign.pending') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.pending') }}">
                                @lang('Pending Campaign')
                                @if ($pendingCampaign)
                                    <span class="notify-indecator bg--warning">{{ ($pendingCampaign) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.campaign.running') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.running') }}">
                                @lang('Running Campaigns')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.campaign.success') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.success') }}">
                                @lang('Completed Campaigns')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.campaign.rejected') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.rejected') }}">
                                @lang('Rejected Campaigns')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.campaign.update.request') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.update.request') }}">
                                @lang('Extend Campaigns')
                                @if ($extendCampaign)
                                    <span class="notify-indecator bg--warning">{{ ($extendCampaign) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.campaign.comments') }}" class="submenu--link navmenu {{ menuActive('admin.campaign.comments') }}">
                                @lang('Comments Campaign')
                                @if ($pendingComment)
                                    <span class="notify-indecator bg--warning">{{ ($pendingComment) }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="list--item link {{ menuActive('admin.donation.index') }} ">
                <a href="{{ route('admin.donation.index') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-graduation-cap"></i></span>
                    <span class="text">@lang('All Donations')</span>
                </a>
            </li>

            <li class="list--item lable">
                <span class="text">@lang('USER MANAGEMENT')</span>
            </li>

            <li class="list--item has-dropdown {{ menuActive(['admin.users.*']) }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive(['admin.users.*']) }}">
                    <span class="icon"><i class="fa-solid fa-user-gear"></i></span>
                    <span class="text">@lang('Manage Users')
                        @if (fetchCount('User', 'ev', 0) > 0 ||
                                fetchCount('User', 'sv', 0) > 0 ||
                                fetchCount('User', 'kv', 0) > 0 ||
                                fetchCount('User', 'kv', 2))
                            <i class="fa-solid fa-triangle-exclamation text-warning ms-2"></i>
                        @endif
                    </span>
                </a>
                <div class="list--item-submenu {{ menuActive(['admin.users.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.all') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.all') }}">
                                @lang('All Users')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.active') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.active') }}">@lang('Active Users')</a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.banned') }}"
                                class="navmenu submenu--link {{ menuActive('admin.users.banned') }}">
                                @lang('Blocked Users')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.email.unverified') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.email.unverified') }}">
                                @lang('Email Unverified')
                                @if (fetchCount('User', 'ev', 0) > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('User', 'ev', 0) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.mobile.unverified') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.mobile.unverified') }}">
                                @lang('Mobile Unverified')
                                @if (fetchCount('User', 'sv', 0) > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('User', 'sv', 0) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.kyc.unverified') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.kyc.unverified') }}">
                                @lang('KYC Unverified')
                                @if (fetchCount('User', 'kv', 0) > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('User', 'kv', 0) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.kyc.pending') }}"
                                class="submenu--link navmenu {{ menuActive(['admin.users.kyc.pending', 'admin.users.kyc.details']) }}">
                                @lang('KYC Pending')
                                @if (fetchCount('User', 'kv', 2) > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('User', 'kv', 2) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.users.with.balance') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.with.balance') }}">
                                @lang('With Balance')
                            </a>
                        </li>

                        <li class="submenu--item">
                            <a href="{{ route('admin.users.notification.all') }}"
                                class="submenu--link navmenu {{ menuActive('admin.users.notification.all') }}">
                                @lang('Notification to All')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="list--item has-dropdown {{ menuActive(['admin.ticket.*']) }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive(['admin.ticket.*']) }}">
                    <span class="icon"><i class="fa-solid fa-life-ring"></i></span>
                    <span class="text">@lang('Support Ticket')
                        @if (fetchCount('SupportTicket', 'status', 0) > 0)
                            <i class="fa-solid fa-triangle-exclamation text-warning ms-2"></i>
                        @endif
                    </span>
                </a>
                <div class="list--item-submenu {{ menuActive(['admin.ticket.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.ticket.index') }}" class="submenu--link navmenu {{ menuActive('admin.ticket.index') }}">@lang('All Ticket')</a>
                        </li>

                        <li class="submenu--item">
                            <a href="{{ route('admin.ticket.pending') }}" class="submenu--link navmenu {{ menuActive('admin.ticket.pending') }}">@lang('Pending Ticket')
                                @if (fetchCount('SupportTicket', 'status', 0) > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('SupportTicket', 'status', 0) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.ticket.closed') }}" class="submenu--link navmenu {{ menuActive('admin.ticket.closed') }}">
                                @lang('Closed Ticket')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.ticket.answered') }}" class="submenu--link navmenu {{ menuActive('admin.ticket.answered') }}">
                                @lang('Answered Ticket')
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="list--item {{ menuActive('admin.kyc.setting') }} link">
                <a href="{{ route('admin.kyc.setting') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-user-shield"></i></span>
                    <span class="text">@lang('KYC Management')</span>
                </a>
            </li>
            <li class="list--item {{ menuActive('admin.guest.support.index') }} link">
                <a href="{{ route('admin.guest.support.index') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-hand-holding-hand"></i></span>
                    <span class="text">@lang('Contact Message')</span>
                </a>
            </li>

            <li class="list--item {{ menuActive('admin.subscriber.*') }} link">
                <a href="{{ route('admin.subscriber.index') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-paper-plane"></i></span>
                    <span class="text">@lang('Newsletter Subscriptions')</span>
                </a>
            </li>
            <li class="list--item has-dropdown {{ menuActive(['admin.report.*']) }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive(['admin.report.*']) }}">
                    <span class="icon"><i class="fa-solid fa-clock"></i></span>
                    <span class="text">@lang('Report History')</span>
                </a>
                <div class="list--item-submenu {{ menuActive(['admin.report.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.report.transaction') }}"
                                class="submenu--link navmenu {{ menuActive(['admin.report.transaction', 'admin.report.transaction.search']) }}">
                                @lang('Transactions History')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.report.login.history') }}"
                                class="submenu--link navmenu {{ menuActive(['admin.report.login.history', 'admin.report.login.ipHistory']) }}">
                                @lang('Login History')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.report.notification.history') }}"
                                class="submenu--link navmenu {{ menuActive('admin.report.notification.history') }}">
                                @lang('Notification History')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="list--item lable">
                <span class="text">@lang('FINANCE')</span>
            </li>

            <li
                class="list--item has-dropdown {{ menuActive(['admin.gateway.automatic.*', 'admin.gateway.manual.*']) }}">
                <a href="javascript:void(0)"
                    class="item--link {{ menuActive(['admin.gateway.automatic.*', 'admin.gateway.manual.*']) }}">
                    <span class="icon"><i class="fa-solid fa-credit-card"></i></span>
                    <span class="text">@lang('Deposit Gateway')</span>
                </a>
                <div
                    class="list--item-submenu {{ menuActive(['admin.gateway.automatic.*', 'admin.gateway.manual.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.gateway.automatic.index') }}"
                                class="submenu--link navmenu {{ menuActive('admin.gateway.automatic.*') }}">
                                @lang('Automatic')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.gateway.manual.index') }}"
                                class="submenu--link navmenu {{ menuActive('admin.gateway.manual.*') }}">
                                @lang('Manual')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="list--item {{ menuActive('admin.withdraw.method.*') }} link">
                <a href="{{ route('admin.withdraw.method.index') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-money-bill-transfer"></i></span>
                    <span class="text">@lang('Withdraw Gateway')</span>
                </a>
            </li>


            <li class="list--item has-dropdown {{ menuActive(['admin.deposit.*']) }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive(['admin.deposit.*']) }}">
                    <span class="icon"><i class="fa-solid fa-money-bill"></i></span>
                    <span class="text">@lang('Donations')
                        @if (fetchCount('Deposit', 'status', 2, 'false', 'pending') > 0)
                            <i class="fa-solid fa-triangle-exclamation text-warning ms-2"></i>
                        @endif
                    </span>
                </a>
                <div class="list--item-submenu {{ menuActive(['admin.deposit.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.deposit.list') }}"
                                class="submenu--link navmenu {{ menuActive('admin.deposit.list') }}">
                                @lang('All Donations')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.deposit.pending') }}"
                                class="submenu--link navmenu {{ menuActive('admin.deposit.pending') }}">
                                @lang('Donation Pending')
                                @if (fetchCount('Deposit', 'status', 2, 'false', 'pending') > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('Deposit', 'status', 2, 'false', 'pending') }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.deposit.approved') }}"
                                class="submenu--link navmenu {{ menuActive('admin.deposit.approved') }}">
                                @lang('Donation Approved')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.deposit.successful') }}"
                                class="submenu--link navmenu {{ menuActive('admin.deposit.successful') }}">
                                @lang('Donation Successful')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.deposit.rejected') }}"
                                class="submenu--link navmenu {{ menuActive('admin.deposit.rejected') }}">
                                @lang('Donation Rejected')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.deposit.initiated') }}"
                                class="submenu--link navmenu {{ menuActive('admin.deposit.initiated') }}">
                                @lang('Donation Initiated')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li
                class="list--item has-dropdown {{ menuActive(['admin.withdraw.pending', 'admin.withdraw.approved', 'admin.withdraw.rejected', 'admin.withdraw.log', 'admin.withdraw.details']) }}">
                <a href="javascript:void(0)"
                    class="item--link {{ menuActive(['admin.withdraw.pending', 'admin.withdraw.approved', 'admin.withdraw.rejected', 'admin.withdraw.log', 'admin.withdraw.details']) }}">
                    <span class="icon"><i class="fa-solid fa-money-bill-transfer"></i></span>
                    <span class="text">@lang('Withdrawals')
                        @if (fetchCount('Withdrawal', 'status', 2) > 0)
                            <i class="fa-solid fa-triangle-exclamation text-warning ms-2"></i>
                        @endif
                    </span>
                </a>

                <div
                    class="list--item-submenu {{ menuActive(['admin.withdraw.pending', 'admin.withdraw.approved', 'admin.withdraw.rejected', 'admin.withdraw.log', 'admin.withdraw.details'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.withdraw.log') }}"
                                class="submenu--link navmenu {{ menuActive('admin.withdraw.log') }}">
                                @lang('All Withdrawals')
                            </a>
                        </li>

                        <li class="submenu--item">
                            <a href="{{ route('admin.withdraw.pending') }}"
                                class="submenu--link navmenu {{ menuActive('admin.withdraw.pending') }}">
                                @lang('Pending Withdraw')
                                @if (fetchCount('Withdrawal', 'status', 2) > 0)
                                    <span class="notify-indecator bg--warning">{{ fetchCount('Withdrawal', 'status', 2) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.withdraw.approved') }}"
                                class="submenu--link navmenu {{ menuActive('admin.withdraw.approved') }}">
                                @lang('Approved Withdraw')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.withdraw.rejected') }}"
                                class="submenu--link navmenu {{ menuActive('admin.withdraw.rejected') }}">
                                @lang('Rejected Withdraw')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="list--item lable">
                <span class="text">@lang('SYSTEM SETTINGS')</span>
            </li>
            <li class="list--item {{ menuActive(['admin.setting.index', 'admin.setting.configuration', 'admin.setting.logo.icon', 'admin.plugins.index', 'admin.seo', 'admin.maintenance.mode', 'admin.setting.cookie', 'admin.setting.custom.css', 'admin.cron.*', 'admin.language.*']) }} link">
                <a href="{{ route('admin.setting.index') }}" class="item--link">
                    <span class="icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                    <span class="text">@lang('Site Setting')</span>
                </a>
            </li>

            <li class="list--item has-dropdown {{ menuActive(['admin.setting.notification.*']) }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive(['admin.setting.notification.*']) }}">
                    <span class="icon"><i class="fa-solid fa-bell"></i></span>
                    <span class="text">@lang('Notifications Setting')</span>
                </a>
                <div class="list--item-submenu {{ menuActive(['admin.setting.notification.*'], 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.setting.notification.templates') }}"
                                class="submenu--link navmenu {{ menuActive('admin.setting.notification.templates') }}">
                                @lang('All Templates')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.setting.notification.global') }}"
                                class="submenu--link navmenu {{ menuActive('admin.setting.notification.global') }}">
                                @lang('Default Template')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.setting.notification.email') }}"
                                class="submenu--link navmenu {{ menuActive('admin.setting.notification.email') }}">
                                @lang('Email Configuration')
                            </a>
                        </li>
                        <li class="submenu--item">
                            <a href="{{ route('admin.setting.notification.sms') }}"
                                class="submenu--link navmenu {{ menuActive('admin.setting.notification.sms') }}">
                                @lang('SMS Configuration')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="list--item {{ menuActive('admin.frontend.manage.*') }} link">
                <a href="{{ route('admin.frontend.manage.pages') }}" class="item--link navmenu">
                    <span class="icon"><i class="fa-solid fa-file"></i></span>
                    <span class="text">@lang('Page Management')</span>
                </a>
            </li>

            <li class="list--item has-dropdown {{ menuActive('admin.frontend.sections*') }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive('admin.frontend.sections*') }}">
                    <span class="icon"><i class="fa-solid fa-bars-progress"></i></span>
                    <span class="text">@lang('Section Management')</span>
                </a>
                <div class="list--item-submenu {{ menuActive('admin.frontend.sections*', 4) }}">
                    @php
                        $lastSegment = collect(request()->segments())->last();
                    @endphp
                    <ul class="submenu-list">
                        @foreach (getPageSections(true) as $k => $secs)
                            @if ($secs['builder'])
                                <li class="submenu--item">
                                    <a href="{{ route('admin.frontend.sections', $k) }}"
                                        class="submenu--link navmenu @if ($lastSegment == $k) active @endif">
                                        {{ __($secs['name']) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </li>

            <li class="list--item has-dropdown {{ menuActive('admin.system.*') }}">
                <a href="javascript:void(0)" class="item--link {{ menuActive('admin.system.*') }}">
                    <span class="icon"><i class="fa-solid fa-desktop"></i></span>
                    <span class="text">@lang('System & Server')</span>
                </a>
                <div class="list--item-submenu {{ menuActive('admin.system.server.info', 4) }}">
                    <ul class="submenu-list">
                        <li class="submenu--item">
                            <a href="{{ route('admin.system.server.info') }}" class="submenu--link navmenu {{ menuActive('admin.system.server.info') }}">@lang('Information')</a>
                        </li>
                        <li class="submenu--item">
                            <a data-bs-toggle="modal" data-bs-target="#cacheModal" href="javascript:void(0)" class="submenu--link cache_nav_btn c-pointer">
                                @lang('Cache')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
</div>
<!-- Sidebar End -->

{{-- Cache Modal Start --}}
<div id="cacheModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('System Cache Clear')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <span><i class="fa-regular fa-circle-check"></i> @lang('The cache containing complied views will be removed')</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <span><i class="fa-regular fa-circle-check"></i> @lang('the cache containing application will be removed')</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <span><i class="fa-regular fa-circle-check"></i> @lang('The cache containg route will be removed')</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <span><i class="fa-regular fa-circle-check"></i> @lang('The cache containing configuration will be removed')</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <span><i class="fa-regular fa-circle-check"></i> @lang('Clearing out the compiled service and package files')</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <span><i class="fa-regular fa-circle-check"></i> @lang('The cache containing system will be removed')</span>
                            </li>
                        </ul>

                    </div>
                    <div class="col-xl-12 text-end">
                        <a href="{{ route('admin.system.optimize.clear') }}"
                            class="btn btn-outline-base">@lang('Clear Cache')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Cache Modal  End --}}

@push('script')
    <script>
        "use strict";
         var $scroll = $('.sidebar-content--wrap');
        $('.list--item').each(function() {
            if ($(this).hasClass('active')) {
                var itemPosition = $(this).position().top + $scroll.scrollTop() - 110;
                $scroll.animate({
                    scrollTop: itemPosition
                }, 500);
            }
        });
    </script>
@endpush
