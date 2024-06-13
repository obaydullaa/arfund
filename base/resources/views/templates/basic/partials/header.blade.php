@php
    $languages = App\Models\Language::all();
    $pages = App\Models\Page::all();
    $socialIcons = getContent('social_icon.element', false);
    $contact = getContent('contact_us.content', true);
@endphp

<!--=============== Header section Start ===============-->
<div class="header-main-area">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="top-header-wrapper">
                    <div class="top-contact">
                        <ul class="login-registration-list d-flex flex-wrap justify-content-between align-items-center">
                            <li class="login-registration-list__item">
                                <ul class="social-list">
                                    @forelse($socialIcons as $item)
                                        <li class="social-list__item">
                                            <a href="{{$item->data_values->url}}" class="social-list__link">
                                                @php echo $item->data_values->social_icon; @endphp 
                                            </a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="top-button">
                        <ul class="contact-list">
                            <li class="contact-list__item">
                                <span class="contact-list__item-icon">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <a href="tel:{{ formatPhoneNumber(@$contact->data_values->contact_number) }}" class="contact-list__link">{{__($contact->data_values->contact_number)}}</a>
                            </li>
                            <li class="contact-list__item">
                                <span class="contact-list__item-icon"
                                    ><i class="fas fa-envelope"></i></span>
                                    <a href="mailto:{{__($contact->data_values->email_address)}}" class="contact-list__link">{{__($contact->data_values->email_address)}}</a>
                            </li>

                            @if($general->language_status)
                            <li class="contact-list__item d-flex align-items-center">
                                <span class="contact-list__item-icon">
                                    <i class="fa-solid fa-globe"></i>
                                </span>
                                <div class="language-box">
                                    <select class="select langSel">
                                        @foreach ($languages as $language)
                                        <option value="{{ $language->code }}" @if (Session::get('lang')===$language->code) selected @endif>
                                            {{ __($language->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header" id="header">
        <div class="container position-relative">
            <div class="row">
                <div class="header-wrapper">
                    <img class="header-bg-shape" src="{{asset($activeTemplateTrue . 'images/header/header-bg-1.png')}}" alt="@lang('image')">
                    <div class="logo-wrapper">
                        <a href="{{ route('home') }}" class="normal-logo">
                            <img src="{{ getImage(getFilePath('logoIcon') . '/' . @$general->image->logo) }}" alt="@lang('Image')">
                        </a>
                    </div>

                    <div class="menu-right-wrapper d-flex align-items-center">
                        <div class="menu-wrapper">
                            <ul class="main-menu">
                                <li class="main-menu__menu-item">
                                    <a class="main-menu__menu-link {{ Request::url() == url('/') ? 'active' : '' }}" href="{{route('home')}}">
                                        @lang('Home')
                                    </a>
                                </li>

                                @foreach ($pages as $data)
                                @if ($data->slug != '/' && $data->slug != 'contact')
                                <li class="main-menu__menu-item">
                                        <a class="main-menu__menu-link {{ url()->current() == route('pages', [$data->slug]) ? 'active' : '' }}" href="{{route('pages',[$data->slug])}}">
                                            {{__($data->name)}}
                                        </a>
                                    </li>
                                @endif
                                @endforeach

                                @if($pages->contains('slug', 'contact'))
                                <li class="main-menu__menu-item">
                                    <a class="main-menu__menu-link {{ Request::url() == url('/contact') ? 'active' : '' }}" href="{{route('contact')}}">
                                        @lang('Contact')
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <ul>
                            <li class="mobile-menubar">
                                <i class="fas fa-bars sidebar-menu-show-hide"></i>
                            </li>
                            <li class="button-wrapper-menu ms-2">
                            @auth()
                                <a class="btn btn--base" href="{{ route('user.home') }}"> 
                                    @lang('Dashboard') <i class="fas fa-tachometer-alt ms-1"></i>
                                </a>
                            @else
                                <a class="btn btn--base" href="{{ route('user.login') }}"> 
                                    @lang('Login') <i  class="fas fa-angle-double-right ms-1"></i>
                                </a>
                            @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--=============== Header section End ===============-->

<!--=============== Sidebar mobile menu wrap Start ===============-->
<div class="sidebar-menu-wrapper">
    <div class="top-close d-flex align-items-center justify-content-between mb-4">
        <div class="header-wrapper-siedebar">
            <div class="logo-wrapper ms-3">
                <a href="index.html" class="normal-logo" >
                    <img src="{{ getImage(getFilePath('logoIcon') . '/' . @$general->image->logo) }}" alt="@lang('Image')">
                </a>
            </div>
        </div>
        <i class="fas fa-times close-hide-show"></i>
    </div>

    <ul class="sidebar-menu-list">
        <li class="sidebar-menu-list__item">
            <a class="sidebar-menu-list__link {{ Request::url() == url('/') ? 'active' : '' }}" href="{{route('home')}}">
                @lang('Home')
            </a>
        </li>

        @foreach ($pages as $data)
        @if ($data->slug != '/' && $data->slug != 'contact')
        <li class="sidebar-menu-list__item">
                <a class="sidebar-menu-list__link {{ url()->current() == route('pages', [$data->slug]) ? 'active' : '' }}" href="{{route('pages',[$data->slug])}}">
                    {{__($data->name)}}
                </a>
            </li>
        @endif
        @endforeach
        

        @if($pages->contains('slug', 'contact'))
        <li class="sidebar-menu-list__item">
            <a class="sidebar-menu-list__link {{ Request::url() == url('/contact') ? 'active' : '' }}" href="{{route('contact')}}">
                @lang('Contact')
            </a>
        </li>
        @endif

        @if($general->language_status)
        <li class="sidebar-menu-list__item ms-3">
            <div class="language-box">
                <select class="select langSel">
                    @foreach ($languages as $language)
                    <option value="{{ $language->code }}" @if (Session::get('lang')===$language->code) selected @endif>
                        {{ __($language->name) }}</option>
                    @endforeach
                </select>
            </div>
        </li>
        @endif
        <li class="sidebar-menu-list__item border-bottom-0 mt-3 mb-3 ms-3">
            <div class="login-box mb-3">                
                @auth()
                <a class="btn btn--base" href="{{ route('user.login') }}"> 
                    @lang('Dashboard') <i class="fas fa-tachometer-alt ms-1"></i>
                </a>
            @else
                <a class="btn btn--base" href="{{ route('user.login') }}"> 
                    @lang('Login') <i  class="fas fa-angle-double-right ms-1"></i>
                </a>
            @endauth
            </div>
        </li>
    </ul>
</div>
<!--=============== Sidebar mobile menu wrap End ===============-->