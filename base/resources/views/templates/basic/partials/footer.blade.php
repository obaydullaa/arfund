@php
    $policyLinks = getContent('policy_pages.element');
    $importantLinks = getContent('footer_important_links.element', false, null, true);
    $subscribe = getContent('subscribe.content', true);
    $contact = getContent('contact_us.content', true);
    $socialIcons = getContent('social_icon.element', false);
    $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
    $footerContent = getContent('footer.content', true);
@endphp
<!-- ======== Footer Start Here ======== -->
<footer class="footer-area bg-img bg-overlay pt-100"
    style="background-image: url({{ getImage(getFilePath('footer') . '/' . @$footerContent->data_values->background_image) }})">
    <img class="section-bg-img" src="{{ asset($activeTemplateTrue . 'images/footer/logo-white.png') }}" alt="">
    <div class="container">
        <div class="row gy-4">
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <div class="footer-item__logo">
                        <a href="{{ route('home') }}" class="footer-logo-normal">
                            <img src="{{ siteLogo('white') }}" alt="@lang('img')">
                        </a>
                    </div>

                    <p class="news-desc">{{ $footerContent->data_values->footer_description }}</p>
                    
                    <ul class="social-list">
                        @forelse($socialIcons as $item)
                            <li class="social-list__item">
                                <a href="{{ $item->data_values->url }}" class="social-list__link">
                                    @php echo $item->data_values->social_icon; @endphp
                                </a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Company Links')</h5>
                    <ul class="footer-menu">
                        @foreach ($pages as $page)
                            @if ($page->footer_status == 1)
                                <li class="footer-menu__item">
                                    <a class="footer-menu__link" href="{{ route('pages', $page->slug) }}">
                                        <i class="fas fa-circle"></i>{{ __($page->name) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Important Links')</h5>
                    <ul class="footer-menu">
                        @foreach ($importantLinks as $link)
                            <li class="footer-menu__item">
                                <a href="{{ url('/') . $link->data_values->url }}" class="footer-menu__link">
                                    {{ $link->data_values->title }}
                                </a>
                            </li>
                        @endforeach
                        @foreach ($policyLinks as $link)
                            <li class="footer-menu__item">
                                <a href="{{ route('policy.pages', [slug($link->data_values->title), $link->id]) }}"
                                    class="footer-menu__link">
                                    {{ $link->data_values->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Newsletter')</h5>
                    <ul class="footer-contact-menu">
                        <li class="footer-contact-menu__item">
                            <div class="footer-contact-menu__item-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="footer-contact-menu__item-content">
                                <h4 class="title-three">@lang('Email Address')</h4>
                                <p>
                                    <a href="mailto:{{ __($contact->data_values->email_address) }}">{{ __($contact->data_values->email_address) }}</a>
                                </p>
                            </div>
                        </li>
                        <li class="footer-contact-menu__item">
                            <div class="footer-contact-menu__item-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="footer-contact-menu__item-content">
                                <h4 class="title-three">@lang('Phone Number')</h4>
                                <p>
                                    <a href="tel:{{ formatPhoneNumber(@$contact->data_values->contact_number) }}">
                                        {{ __($contact->data_values->contact_number) }}
                                    </a>
                                </p>
                            </div>
                        </li>
                        <li class="footer-contact-menu__item">
                            <div class="footer-contact-menu__item-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="footer-contact-menu__item-content">
                                <p>{{ __($contact->data_values->contact_address) }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom-border"></div>
        </div>
    </div>
    <div class="bottom-footer py-3">
        <div class="container">
            <div class="row justify-content-center gy-3">
                <div class="col-lg-6 col-md-6">
                    <div class="bottom-footer-tex text-center">
                        <p>
                            @php echo trans(@$footerContent->data_values->website_footer_editor) @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ======== Footer End Here ======== -->
