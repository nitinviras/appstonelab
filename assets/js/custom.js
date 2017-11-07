

jQuery(function ($) {
    "use strict";

    /* ========================================================================= */
    /*	Nice Scroll - Custom Scrollbar
     /* ========================================================================= */

    var nice = $("html").niceScroll({
        cursorborderradius: 0,
        cursorwidth: "8px",
        cursorfixedheight: 150,
        cursorcolor: "#EC2A45",
        zindex: 9999,
        cursorborder: 0,
    });


    /* ========================================================================= */
    /*	Scroll Up / Back to top
     /* ========================================================================= */

    $(window).scroll(function () {
        if ($(window).scrollTop() > 400) {
            $("#scrollUp").fadeIn(200);
        } else {
            $("#scrollUp").fadeOut(200);
        }
    });

    $('#scrollUp').click(function () {
        $('html, body').stop().animate({
            scrollTop: 0
        }, 1500, 'easeInOutExpo');
    });

    $('.mdb-select').material_select();

});

new WOW().init();
