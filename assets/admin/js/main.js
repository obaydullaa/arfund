(function ($) {
    "use strict"

    $(".menu-icon").on("click", function () {
        $(".dashboard-sidebar").addClass("show-sidebar");
    });

    $(".close-btn").on("click", function () {
        $(".dashboard-sidebar").removeClass("show-sidebar");
    });      

    $(".has-dropdown > a").on('click', function (e) {
        e.preventDefault();
        var $submenu = $(this).next(".list--item-submenu");
        var $parent = $(this).parent();

        $parent.toggleClass("active");

        if ($(this).next('.list--item-submenu').hasClass('d-block')) {
            $(this).next('.list--item-submenu').removeClass('d-block');
        }


        $parent.find(".item--link").toggleClass("active");


        $submenu.slideToggle(800, function () {
            $(".list--item-submenu").not($submenu).slideUp(800);
            $(".list--item-submenu").not($submenu).removeClass('d-block');
        });

        $(".has-dropdown.active").not($parent).removeClass("active");

        $(".item--link.active").not($parent.find(".item--link")).removeClass("active");
    });

    $('select').on('change', function(){
        $(this).css('color', 'black');
    });

    var tr_elements = $('.search-table-content tbody tr');
    $(document).on('input','input[name=search_table]',function(){
        var search = $(this).val().toUpperCase();
        var match = tr_elements.filter(function (idx, elem) {
            return $(elem).text().trim().toUpperCase().indexOf(search) >= 0 ? elem : null;
        }).sort();
        var table_content = $('.search-table-content tbody');
        if (match.length == 0) {
            table_content.html('<tr><td colspan="100%" class="text-center">Data Not Found</td></tr>');
        }else{
            table_content.html(match);
        }
    });

    $.each($('input, select, textarea'), function (i, element) {
        if (element.hasAttribute('required')) {
            $(element).closest('.form-group').find('label').addClass('label-sign');
        }
    });
    Array.from(document.querySelectorAll('table')).forEach(table => {
        let heading = table.querySelectorAll('thead tr th');
        Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
            Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                colum.setAttribute('data-label', heading[i].innerText)
            });
        });
    });
})(jQuery);