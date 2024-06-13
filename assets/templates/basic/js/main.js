/*============== Main Js Start ========*/

(function ($) {
    "use strict";
    /*============ header menu show hide =========*/
    $(".sidebar-menu-show-hide").on("click", function () {
        $(".sidebar-menu-wrapper").addClass("show");
        $(".sidebar-overlay").addClass("show");
    });

    $(".sidebar-overlay, .close-hide-show").on("click", function () {
        $(".sidebar-menu-wrapper").removeClass("show");
        $(".sidebar-overlay").removeClass("show");
    });

    /* ==========================================
  *     Start Document Ready function
  ==========================================*/
    $(document).ready(function () {
        /*================== Password Show Hide Js ==========*/
        $(".toggle-password-change").on("click", function () {
            var targetId = $(this).data("target");
            var target = $("#" + targetId);
            var icon = $(this);
            if (target.attr("type") === "password") {
                target.attr("type", "text");
                icon.removeClass("fa-eye-slash");
                icon.addClass("fa-eye");
            } else {
                target.attr("type", "password");
                icon.removeClass("fa-eye");
                icon.addClass("fa-eye-slash");
            }
        });

        /*============** Mgnific Popup **============*/
        $(".image-popup").magnificPopup({
            type: "image",
            gallery: {
                enabled: true,
            },
        });

        $(".popup_video").magnificPopup({
            type: "iframe",
        });

        /*============== Slick Slider Js Start ==============*/
        // category Active
        $(".category-slider-active").slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 1500,
            dots: true,
            pauseOnHover: false,
            arrows: true,
            prevArrow:
                '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></i></button>',
            nextArrow:
                '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        arrows: true,
                        slidesToShow: 4,
                        dots: true,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: false,
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 370,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                    },
                },
            ],
        });

        // Campaign Active
        $(".campaign-slider-active").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 1500,
            dots: true,
            pauseOnHover: true,
            arrows: true,
            prevArrow:
                '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></i></button>',
            nextArrow:
                '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1450,
                    settings: {
                        arrows: false,
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 1199,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 624,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                    },
                },
            ],
        });

        // Team Slider
        $(".team-slider-active").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 1500,
            dots: true,
            pauseOnHover: true,
            arrows: true,
            prevArrow:
                '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></i></button>',
            nextArrow:
                '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        arrows: false,
                        slidesToShow: 3,
                        dots: true,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 667,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 424,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                    },
                },
            ],
        });

        // Testimonial Active
        $(".testimonial-active").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 1500,
            dots: true,
            pauseOnHover: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        dots: true,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                    },
                },
            ],
        });

        /*========= Mouse hover Js Start =========*/
        $(".demo-class").on("mouseover", function () {
            $(".service-item").removeClass("active");
            $(this).addClass("active");
        });

        /*============ Sidebar Menu Js Start ============ */
        // Sidebar Dropdown Menu Start
        $(".has-dropdown > a").click(function () {
            $(".sidebar-submenu").slideUp(200);
            if ($(this).parent().hasClass("active")) {
                $(".has-dropdown").removeClass("active");
                $(this).parent().removeClass("active");
            } else {
                $(".has-dropdown").removeClass("active");
                $(this).next(".sidebar-submenu").slideDown(200);
                $(this).parent().addClass("active");
            }
        });

        /*==================== Sidebar Icon & Overlay js ===============*/
        $(".dashboard-body__bar-icon").on("click", function () {
            $(".sidebar-menu").addClass("show-sidebar");
            $(".sidebar-overlay").addClass("show");
        });
        $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
            $(".sidebar-menu").removeClass("show-sidebar");
            $(".sidebar-overlay").removeClass("show");
        });

        /*============ odometer Js Start ============ */
        if ($(".odometer").length) {
            var odo = $(".odometer");
            odo.each(function () {
                $(this).appear(function () {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            });
        }

        /* =========== User Profile Upload Photo Js ========== */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagePreview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $("#imagePreview").hide();
                    $("#imagePreview").fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function () {
            readURL(this);
        });
    });

    /*========= End Document Ready function ==========*/

    /*=========== Preloader Js Start ===========*/

    $(window).on("load", function () {
        $("#loading").fadeOut();
    });

    /*========= Header Sticky Js Start =======*/
    $(window).on("scroll", function () {
        if ($(window).scrollTop() >= 300) {
            $(".header").addClass("fixed-header");
        } else {
            $(".header").removeClass("fixed-header");
        }
    });

    /*======== Scroll To Top Icon Js Start =========*/
    var btn = $(".scroll-top");
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass("show");
        } else {
            btn.removeClass("show");
        }
    });

    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "300");
    });

    /*========== header menu show hide =========*/
    $(".sidebar-menu-show-hide").on("click", function () {
        $(".sidebar-menu-wrapper").addClass("show");
        $(".sidebar-overlay").addClass("show");
    });

    $(".sidebar-overlay, .close-hide-show").on("click", function () {
        $(".sidebar-menu-wrapper").removeClass("show");
        $(".sidebar-overlay").removeClass("show");
    });

    /*========== Search input show hide =========*/
    $("#search-input-show").on("click", function () {
        $(".search-input-wrap").toggleClass("show");
    });

    $("#search-input-show").on("click", function () {
        $(".search-input-wrap").addClass("show");
    });
    $(document).on("click", function (event) {
        if (
            !$(event.target).closest(".search-input-wrap, #search-input-show")
                .length
        ) {
            $(".search-input-wrap").removeClass("show");
        }
    });
    /*========== Dashboard Menu show hide =========*/
    $(".dashboard-show-hide").on("click", function () {
        $(".dashboard_profile").addClass("show");
        $(".sidebar-overlay").addClass("show");
    });

    $(".sidebar-overlay, .close-hide-show").on("click", function () {
        $(".dashboard_profile").removeClass("show");
        $(".sidebar-overlay").removeClass("show");
    });
})(jQuery);
