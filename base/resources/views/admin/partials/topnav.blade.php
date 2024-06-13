<!-- Top Navbar Start -->
<div class="row gx-0 mb-4">
    <div class="col-lg-12">
        <div class="dashboard-header">
            <div class="search-bar">
                <div class="menu-icon">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>

                <div class="input-wrap">
                    <input class="form--control navbar-search-field" placeholder="@lang('Search Menu Here')" name="searchmenu" id="searchInput" autocomplete="off">
                    <span class="icon-wrap">
                        <i class="fa-solid fa-magnifying-glass"></i>

                    </span>
                </div>
                <ul class="search-list global-search--list"></ul>
            </div>

            <ul class="header-item">
                <li class="list">
                    <a target="_blank" title="@lang('Visit Site')" href="{{ route('home') }}" class="notification"><i class="fa-solid fa-globe"></i></a>
                </li>

                <li class="list dropdown">
                    <div class="notification bell" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                        <i class="fa-solid fa-bell"></i>
                        <span class="count">{{ @$adminNotifications->count() ?? 0 }}</span>
                    </div>

                    <div class="dropdown-notification dropdown-menu">
                        <div class="notification-body">
                            <ul class="notification-list-wrap">
                                @foreach ($adminNotifications as $notification)
                                    <li class="list">
                                        <a href="{{ route('admin.notification.read', $notification->id) }}"
                                            class="item">
                                            <span class="icon-wrap">
                                                <i class="fa-regular fa-bell"></i>
                                            </span>
                                            <span class="notification--content">
                                                <span class="title">{{ __(@$notification->title) }}</span>
                                                <span class="date">{{ $notification->created_at->diffForHumans() }}</span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="notification-footer d-flex justify-content-between px-2">
                                <a href="{{ route('admin.notifications.readAll') }}"
                                    class="btn btn--global btn--sm btn--outline-global w-40 me-2 mt-2">@lang('Mark All Read')</a>
                                <a href="{{ route('admin.notifications') }}"
                                    class="btn btn--global btn--sm btn--outline-global w-40 me-2 mt-2">@lang('View All')</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="list">
                    <div class="language">
                        @php
                            $language = App\Models\Language::all();
                        @endphp

                        <select class="langSel form--control form--select select">
                            @foreach (fetchModal('Language')->get() as $item)
                                <option value="{{ $item->code }}" @if (session('lang') == $item->code) selected @endif>
                                    {{ __($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

                <li class="list">
                    <div class="user-profile dropdown">
                        <div class="thumb-wrap " role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <img src="{{ getImage(getFilePath('adminProfile') . '/' . auth()->guard('admin')->user()->image, getFileSize('adminProfile')) }}"
                                alt="@lang('Profile Image')">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('admin.profile') }}"
                                    class="dropdown-item dropdown--item d-flex align-items-center gap-2">
                                    <i class="fa-regular fa-user"></i>
                                    <p class="mb-0">@lang('Profile Setting')</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}"
                                    class="dropdown-item dropdown--item d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <p class="mb-0">@lang('Logout')</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Top Navbar End -->



@push('script')
    <script>
        (function($) {
        "use strict";

        function performSearch(query) {
            var originalList = $('.sidebar-content--wrap .menu--list .navmenu');
            var searchList = $('.search-list');
            searchList.html('');
            var match = originalList.filter(function(idx, elem) {
                return $(elem).text().trim().toLowerCase().indexOf(query) >= 0 ? elem : null;
            }).sort();

            if (match.length > 0) {
                searchList.addClass('show');
            } else {
                searchList.removeClass('show');
            }

            if (match.length == 0) {
                searchList.append('<li class="no-result"><p>No search result found.</p></li>');
            } else {
                match.each(function(idx, elem) {
                    var item_url = $(elem).attr('href') || $(elem).data('default-url');
                    var item_text = $(elem).text().replace(/(\d+)/g, '').trim();
                    searchList.append(`<li><a href="${item_url}">${item_text}</a></li>`);
                });
            }
        }

        $('.navbar-search-field').on('input', function() {
            var query = $(this).val().toLowerCase();
            if (query.length == 0) {
                $('.search-list').removeClass('show');
            }
            performSearch(query);
        });

        $(document).on("click", function(event) {
            event.stopPropagation();
            $('.search-list').removeClass("show");
        });

        $('.navbar-search-field').on('blur', function() {
            var inputValue = $(this).val().trim();
            if (inputValue === '') {
                $('.search-list').removeClass("show");
            }
        });

        var currentIndex = -1;

        $(document).on('keydown', function(e) {
            var searchList = $('.global-search--list');
            var searchListItems = $('.search-list li');
            if (searchListItems.length === 0) return;

            var listItemHeight = searchListItems.eq(0).outerHeight();
            var containerHeight = searchList.outerHeight();
            var containerScrollTop = searchList.scrollTop();

            if (e.keyCode === 38) {
                currentIndex = Math.max(currentIndex - 1, 0);
                updateHighlight(searchListItems);
                e.preventDefault();
            } else if (e.keyCode === 40) {
                currentIndex = Math.min(currentIndex + 1, searchListItems.length - 1);
                updateHighlight(searchListItems);
                e.preventDefault();
            } else if (e.keyCode === 13) {
                if (currentIndex >= 0) {
                    var selectedItem = searchListItems.eq(currentIndex);
                    var item_link = selectedItem.find('a');
                    var item_url = item_link.attr('href');

                    if (item_url) {
                        window.location.href = item_url;
                        location.replace(item_url);
                        return true;
                    }
                }
            } else {
                currentIndex = -1;
                searchListItems.removeClass('highlight');
            }

            if (currentIndex >= 0) {
                var highlightedItemText = searchListItems.eq(currentIndex).text();
                $('.navbar-search-field').val(highlightedItemText);
            }

            var selectedOffsetTop = searchListItems.eq(currentIndex).position().top;
            var selectedScrollTop = containerScrollTop + selectedOffsetTop;

            if (selectedScrollTop < containerScrollTop) {
                searchList.scrollTop(selectedScrollTop);
            } else if (selectedScrollTop + listItemHeight > containerScrollTop + containerHeight) {
                searchList.scrollTop(selectedScrollTop - containerHeight + listItemHeight);
            }
        });

        function updateHighlight(searchListItems) {
            searchListItems.removeClass('highlight');
            searchListItems.eq(currentIndex).addClass('highlight');
        }

    })(jQuery);

    </script>
@endpush





