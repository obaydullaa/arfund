@php
    $languages = App\Models\Language::all();
    $user = auth()->user();
@endphp

<div class="dashboard_profile">
    <div class="dashboard_profile__details">
        <div class="dashboard_profile_wrap text-start mb-5">
            <div class="logo-wrapper">
                <a href="{{ route('home') }}" class="normal-logo">
                    <img src="{{ getImage(getFilePath('logoIcon') . '/' . @$general->image->logo) }}">
                </a>
            </div>
            <i class="fas fa-times close-hide-show"></i>
        </div>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-list__item {{ Route::is('user.home') ? 'active' : '' }}">
                <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                @lang('Dashboard')
                </a>
            </li> 
            <li class="sidebar-menu-list__item has-dropdown {{ Route::is('user.campaign.create') || Route::is('user.campaign.all') || Route::is('user.campaign.approved') || Route::is('user.campaign.pending') || Route::is('user.campaign.success') || Route::is('user.campaign.rejected') || Route::is('user.campaign.expired')  ? 'active' : '' }} ">
              <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                @lang('Campaigns') 
              </a>
              <div class="sidebar-submenu" style="display: {{ Route::is('user.campaign.create') || Route::is('user.campaign.all') || Route::is('user.campaign.approved') || Route::is('user.campaign.pending') || Route::is('user.campaign.success') || Route::is('user.campaign.rejected') || Route::is('user.campaign.expired') ? 'block' : '' }} ;">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.create') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.create')}}" class="sidebar-submenu-list__link">@lang('Create Campaign')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.all') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.all')}}" class="sidebar-submenu-list__link">@lang('All Campaigns')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.approved') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.approved')}}" class="sidebar-submenu-list__link">@lang('Approved Campaigns')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.pending') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.pending')}}" class="sidebar-submenu-list__link">@lang('Pending Campaigns')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.success') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.success')}}" class="sidebar-submenu-list__link">@lang('Completed Campaigns')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.rejected') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.rejected')}}" class="sidebar-submenu-list__link">@lang('Rejected Campaigns')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.expired') ? 'active' : ''}}">
                            <a href="{{route('user.campaign.expired')}}" class="sidebar-submenu-list__link">@lang('Expired Campaigns')</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item has-dropdown {{ Route::is('user.campaign.donation.my') || Route::is('user.campaign.donation.received') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <span class="text"> @lang('Donations')</span>
                </a>
                <div class="sidebar-submenu" style="display: {{ Route::is('user.campaign.donation.my') || Route::is('user.campaign.donation.received') ? 'block' : '' }};">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ Route::is('user.campaign.donation.my') ? 'active' : ''}}">
                            <a href="{{ route('user.campaign.donation.my') }}" class="sidebar-submenu-list__link">
                                @lang('My Donations')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.campaign.donation.received') ? 'active' : ''}}">
                            <a href="{{ route('user.campaign.donation.received') }}" class="sidebar-submenu-list__link">
                                @lang('Received Donations')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item has-dropdown {{ Route::is('user.withdraw') || Route::is('user.withdraw.history') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-search-dollar"></i></span>
                <span class="text"> @lang('Withdraw')</span>
                </a>
                <div class="sidebar-submenu" style="display: {{ Route::is('user.withdraw') || Route::is('user.withdraw.history') ? 'block' : '' }};">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{Route::is('user.withdraw') ? 'active' : ''}}">
                            <a href="{{ route('user.withdraw') }}" class="sidebar-submenu-list__link">
                                @lang('Withdraw Now')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{Route::is('user.withdraw.history') ? 'active' : ''}}">
                            <a href="{{ route('user.withdraw.history') }}" class="sidebar-submenu-list__link">
                                @lang('Withdraw Log')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item {{ Route::is('user.transactions') ? 'active' : '' }}">
                <a href="{{ route('user.transactions') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-book"></i></span>
                    @lang('Transactions')
                </a>
            </li>
            <li class="sidebar-menu-list__item has-dropdown {{ Route::is('ticket.open') || Route::is('ticket.index') ? 'active' : '' }}">
              <a href="javascript:void(0)" class="sidebar-menu-list__link">
                <span class="icon"><i class="fas fa-headphones"></i></span>
                @lang('Support Tickets') 
              </a>
                <div class="sidebar-submenu" style="display: {{ Route::is('ticket.open') || Route::is('ticket.index') ? 'block' : '' }};">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{Route::is('ticket.index') ? 'active' : ''}}">
                            <a href="{{ route('ticket.index') }}" class="sidebar-submenu-list__link">
                                @lang('Support Tickets')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ Route::is('ticket.open') ? 'active' : '' }}">
                            <a href="{{ route('ticket.open') }}" class="sidebar-submenu-list__link">
                                @lang('New Ticket')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-menu-list__item has-dropdown {{ Route::is('user.profile.setting') || Route::is('user.change.password') || Route::is('user.twofactor') ? 'active' : ''}}">
              <a href="javascript:void(0)" class="sidebar-menu-list__link">
              <span class="icon"><i class="fas fa-cog"></i></span>
              @lang('Setting') 
              </a>
              <div class="sidebar-submenu" style="display: {{ Route::is('user.profile.setting') || Route::is('user.change.password') || Route::is('user.twofactor') ? 'block' : ''}} ;">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ Route::is('user.profile.setting') ? 'active' : '' }}">
                            <a href="{{ route('user.profile.setting') }}" class="sidebar-submenu-list__link">
                                @lang('Profile Setting')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ Route::is('user.change.password') ? 'active' : '' }}">
                            <a href="{{ route('user.change.password') }}" class="sidebar-submenu-list__link">
                                @lang('Change Password')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ Route::is('user.twofactor') ? 'active' : '' }}">
                            <a href="{{ route('user.twofactor') }}" class="sidebar-submenu-list__link">
                                @lang('2Fa Security')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ Route::is('user.logout') ? 'active' : '' }}">
                            <a href="{{ route('user.logout') }}" class="sidebar-submenu-list__link">
                                @lang('Log Out')
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @if($general->language_status)
            <li class="sidebar-menu-list__item has-dropdown">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fa-solid fa-globe"></i></span>
                    @lang('Language') 
                </a>
                <div class="sidebar-submenu" style="display: none">
                    <ul class="sidebar-submenu-list ">
                        @foreach ($languages as $language)
                            <li class="sidebar-submenu-list__item">
                                <a href="javascript:void(0)" class="langSelSidebar" data-lang="{{ $language->code }}"
                                   @if (Session::get('lang') === $language->code) style="font-weight: bold;" @endif>
                                    {{ __($language->name) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endif
        </ul>
        <div class="sidebar-profile-img-wrap">
            <div class="thumb">
                <img src="{{ getImage(getFilePath('userProfile').'/'. @$user->image,getFileSize('userProfile')) }}" alt="@lang('User\'s prifile picture')">
            </div>
            <div class="content">
                <h6 class="mb-1">{{@$user->username}}</h6>
                <p>{{@$user->email}}</p>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    (function ($) {
        "use strict";

        $(".langSelSidebar").on("click", function() {
            var langCode = $(this).data('lang');
            window.location.href = "{{ route('home') }}/change/" + langCode;
        });

    })(jQuery);
</script>
@endpush