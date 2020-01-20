/*  JavaScript functions for the Site Construction website 
    Copyright 2018 Rich DeBourke
    Code may be used under an MIT License:
    https://github.com/RichDeBourke/simple-f3-multi-lang-site/blob/master/LICENSE */
(function ($, win, doc) {
    "use strict";

    var nav = doc.querySelector("#mainNav"),
        footer = doc.getElementsByTagName("footer")[0],
        toTop = doc.querySelector("#scroll-to-top"),
        scrollTimer,
        passiveSupported = false;

    try {
        var options = Object.defineProperty({}, "passive", {
            get: function() {
            passiveSupported = true;
            }
        });

        win.addEventListener("test", options, options);
        win.removeEventListener("test", options, options);
    } catch(err) {
        passiveSupported = false;
    }

    function scrollHandler() {
        var totalHeight = doc.documentElement.scrollHeight,
            scrollTop = win.pageYOffset,
            windowHeight = win.innerHeight,
            footerHeight = footer.clientHeight;

        if (scrollTop > 100) {
            // IE9 does not support classList, but I've already
            // loaded a polyfill for the font loader
            nav.classList.add("small-logo");
        } else {
            nav.classList.remove("small-logo");
        }

        if (scrollTop > windowHeight) {
            toTop.style.opacity = "1";
        } else {
            toTop.style.opacity = "0";
        }

        if (scrollTop + windowHeight > totalHeight - footerHeight) {
            toTop.style.bottom = scrollTop + windowHeight - totalHeight + footerHeight + 32 + "px";
        } else {
            toTop.style.bottom = "32px";
        }
    }

    // Ignore scroll events as long as a scrollHandler execution is in the queue
    function scrollThrottler() {
        if (!scrollTimer) {
            scrollTimer = win.setTimeout(function () {
                scrollTimer = null;
                scrollHandler();
            // The scrollHandler will execute at a rate of 30fps
            }, 33);
        }
    }

    // Only do scroll listening if the browser supports win.pageYOffset (IE8 and older don't)
    if (win.pageXOffset !== undefined) {
        win.addEventListener("scroll", scrollThrottler,
            passiveSupported ? { passive: true } : false);
        // Mobile devices will fire a resize event when the URL bar is hidden or shown
        win.addEventListener("resize", scrollThrottler);
        // Call scrollThrottler one time to be sure the page is adjusted if the page is not at the top (Firefox wasn't consistant)
        scrollThrottler();
    }

    // Smooth scrolling for all the pages except the home page using jQuery easing
    $(".same-page-link").on("click", function (event) {
        var $target;

        event.preventDefault();

        //$target = $(decodeURIComponent(this.hash));
        $target = $($(this).attr("href"));

        $("html, body").animate({
            scrollTop: $target.offset().top
            }, 1000, "easeInOutExpo").promise().done(function () {
                $target.attr('tabindex', '0'); //Adding tabindex for elements not focusable
                $target.focus(); //Setting focus
            });
        
        return false;
    });

    // Smooth scrolling for the home page single-page menu using jQuery easing
    $(".js-scroll-trigger").on("click", function (event) {
        var $target;

        event.preventDefault();
        
        $target = $($(this).attr("href"));

        $('html, body').animate({
            scrollTop: $target.offset().top
        }, 1000, "easeInOutExpo").promise().done(function () {
            $target.attr('tabindex', '-1'); //Adding tabindex for elements not focusable
            $target.focus(); //Setting focus
        });
        // collapse the menu
        $('.navbar-toggler').click();

        return false;
    });

    // Scroll to top
    $("#scroll-to-top").click(function (event) {
        event.preventDefault();

        $("html, body").animate({
            scrollTop: 0
        }, 1000, "easeInOutExpo", function () {
            doc.documentElement.tabIndex = 0;
            doc.documentElement.focus();
        });

        return false;
    });

    $(".offcanvas-menu-item").on("click", function () {
        // collapse the menu
        $(".navbar-toggler").click();
    });

    $("a[href^='http']").on("click", function () {
        // show the loading icon
        $(".lds-container").show();
    });

}(jQuery, window, document));

$(document).ready(function () {
    // Have the dropdown menus slide down, rather than just appear
    // https://getbootstrap.com/docs/4.1/components/dropdowns/#events
    // https://codepen.io/adammacias/pen/dozPVQ
    $(".dropdown").on("show.bs.dropdown", function () {
        $(this).find(".dropdown-menu").first().stop(true, true).slideDown(300);
    });

    $(".dropdown").on("hide.bs.dropdown", function () {
        $(this).find(".dropdown-menu").first().stop(true, true).slideUp(200);
    });

    // Show the EU cookie notice (if first time to the site)
    if (document.cookie.indexOf("eu-cookie-notice-accepted=true") < 0) {
        //Cookie not found, so show
        $("#eu-cookie").slideDown();
        $(".detail-first-section").addClass("cookie-notice-margin");
        $("#btn-cookie").on("click", function () {
            var date = new Date();
            date.setTime(date.getTime() + 31536000000); // one year
            document.cookie = "eu-cookie-notice-accepted=true; expires=" + date.toGMTString() + ";path=/";
            $("#eu-cookie").slideUp();
            $(".detail-first-section").removeClass("cookie-notice-margin");
            // Trigger tracking for this visit
            gtag('config', 'UA-11155712-3', { 'anonymize_ip': true });
        });
    }

    // Toggler function for showing the offcanvas menu on mobile devices
    $('[data-toggle="offcanvas"]').click(function () {
        $('.offcanvas').toggleClass('off-canvas-active');
        $('.footer').toggleClass('off-canvas-active');
    });

    // Lazy load images - https://davidwalsh.name/lazyload-image-fade
    [].slice.apply(document.querySelectorAll('img[data-src].lazy-load')).forEach(function(img) {
		img.setAttribute('src', img.getAttribute('data-src'));
		img.onload = function() {
			img.removeAttribute('data-src');
		};
    });
    
    // Sticky footer height setting
    function adjustStickyFooter () {
        var footer = document.getElementsByTagName("footer")[0].clientHeight;

        document.getElementsByTagName("body")[0].style.marginBottom = footer + "px";
    }

    window.addEventListener("resize", adjustStickyFooter, false);

    // Initiate footer setting
    adjustStickyFooter();
    //window.scroll();
});
