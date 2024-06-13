(function ($) {
    "use strict";
    $(document).ready(function () {

        var sectionIds = [
            '#introduction', '#server-req', '#server-faq', '#installation',
            '#folder', '#admin-dashboard', '#setting', '#system',
            '#extensions', '#seo', '#language', '#manager-dashboard',
            '#staff-dashboard', '#support'
        ];
        function updateActiveClasses() {
            var scrollPosition = $(window).scrollTop();
            var windowHeight = $(window).height();
            var documentHeight = $(document).height();
            sectionIds.forEach(function (sectionId, index) {
                var section = $(sectionId);
                var sectionPosition = section.offset().top - 40;
                var sectionHeight = section.outerHeight();
                var sectionBottom = sectionPosition + sectionHeight;
                // if (index === sectionIds.length - 1) {
                //     if (scrollPosition + windowHeight >= documentHeight - 10) {
                //         section.addClass('active');
                //         $('a[href="' + sectionId + '"]').addClass('active');
                //         var previousSectionId = sectionIds[sectionIds.length - 1];
                //         $(previousSectionId).removeClass('active');
                //         $('a[href="' + previousSectionId + '"]').removeClass('active');
                //     } else {
                //         section.removeClass('active');
                //         $('a[href="' + sectionId + '"]').removeClass('active');
                //     }
                // } else {
                    if (scrollPosition >= sectionPosition && scrollPosition < sectionBottom) {
                        section.addClass('active');
                        $('a[href="' + sectionId + '"]').addClass('active');
                    } else {
                        section.removeClass('active');
                        $('a[href="' + sectionId + '"]').removeClass('active');
                    }
                // }
            });
        }
        $(window).on('scroll', updateActiveClasses);
        $(window).trigger('scroll');
        $('a.doc-nav__link').on('click', function (e) {
            e.preventDefault();
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top - 10
            }, 500, function () {
                updateActiveClasses();
            });
        });
    });



})(jQuery);
