// JavaScript Document

// main.js
(function ($) {
    "use strict";

    window.dts = {};
    dts.modules = {};
    dts.scroll = 0;
    dts.window = $(window);
    dts.document = $(document);
    dts.windowWidth = $(window).width();
    dts.windowHeight = $(window).height();
    dts.body = $('body');
    dts.html = $('html, body');
    dts.loader = {
        start: function () {
            $('body').addClass('dts-loading');
        },
        stop: function () {
            $('body').removeClass('dts-loading');
        }
    };

    /*predefined values which is used globally start */

    dts.headerHeight = 75;
    dts.footerHeight = 220;

    /*predefined values which is used globally end */

    dts.window.ready(function () {
        dts.window.scrollTop(0);
        dts.scroll = $(window).scrollTop();

    });

    dts.window.resize(function () {
        dts.windowWidth = $(window).width();
        dts.windowHeight = $(window).height();
    });

    dts.window.scroll(function () {
        dts.scroll = dts.window.scrollTop();

    });

})(jQuery);


