/*  JavaScript functions for the Site Construction website
    Copyright 2018-2022 Rich DeBourke
    Code may be used under an MIT License:
    https://github.com/RichDeBourke/simple-f3-multi-lang-site/blob/master/LICENSE */

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    "use strict";

    var footer = document.getElementsByTagName("footer")[0];
    var toTop = document.querySelector("#scroll-to-top");
    var scrollTimer;
    var passiveSupported = false;
    var options;
    var motionReduce = false;

    if (typeof window.matchMedia === 'function') {
        motionReduce = window.matchMedia("(prefers-reduced-motion: reduce)");
    }
    
    try {
        options = Object.defineProperty({}, "passive", {
            get: function() {
                passiveSupported = true;
            }
        });

        window.addEventListener("test", options, options);
        window.removeEventListener("test", options, options);
    } catch (err) {
        passiveSupported = false;
    }

    function scrollHandler() {
        var totalHeight = document.documentElement.scrollHeight;
        var scrollTop = window.pageYOffset;
        var windowHeight = window.innerHeight;
        var footerHeight = footer.clientHeight;

        if (scrollTop > 100) {
            // IE9 does not support classList, but I've already
            // loaded a polyfill
            document.body.classList.add("small-logo");
        } else {
            document.body.classList.remove("small-logo");
        }

        if (scrollTop > windowHeight) {
            toTop.style.opacity = "1";
        } else {
            toTop.style.opacity = "0";
        }

        if ((scrollTop + windowHeight > totalHeight - footerHeight) && (!motionReduce.matches)) {
            toTop.style.bottom = scrollTop + windowHeight - totalHeight + footerHeight + 32 + "px";
        } else {
            toTop.style.bottom = "32px";
        }
    }

    // Ignore scroll events as long as a scrollHandler execution is in the queue
    function scrollThrottler() {
        if (!scrollTimer) {
            scrollTimer = window.setTimeout(function() {
                scrollTimer = null;
                scrollHandler();
                // The scrollHandler will execute at a rate of 30fps
            }, 33);
        }
    }

    // Only do scroll listening if the browser supports window.pageYOffset (IE 8 and older don't)
    if (window.pageXOffset !== undefined) {
        window.addEventListener("scroll", scrollThrottler,
            passiveSupported ? {
                passive: true
            } : false);
        // Mobile devices will fire a resize event when the URL bar is hidden or shown
        window.addEventListener("resize", scrollThrottler);
        // Call scrollThrottler one time to be sure the page is adjusted if the page is not at the top (Firefox wasn't consistant)
        scrollThrottler();
    }

    // Smooth scrolling for all the pages except the home page using jQuery easing
    $(".same-page-link").on("click", function(event) {
        var $target;

        event.preventDefault();

        //$target = $(decodeURIComponent(this.hash));
        $target = $($(this).attr("href"));

        $("html, body").animate({
            scrollTop: $target.offset().top
        }, 1000, "easeInOutExpo").promise().done(function() {
            $target.attr("tabindex", "0"); //Adding tabindex for elements not focusable
            $target.focus(); //Setting focus
        });

        return false;
    });

    // Smooth scrolling for the home page single-page menu using jQuery easing
    $(".js-scroll-trigger").on("click", function(event) {
        var $target;

        event.preventDefault();

        $target = $($(this).attr("href"));

        $("html, body").animate({
            scrollTop: $target.offset().top
        }, 1000, "easeInOutExpo").promise().done(function() {
            $target.attr("tabindex", "-1"); //Adding tabindex for elements not focusable
            $target.focus(); //Setting focus
        });
        // If a small screen (menu button is showing), collapse the menu
        if ($(".navbar-toggler").css("display") !== "none") {
            $(".navbar-toggler").trigger("click");
        }
        
        return false;
    });

    // Scroll to top
    $("#scroll-to-top").on("click", function(event) {
        event.preventDefault();
        event.currentTarget.setAttribute("aria-pressed", true);

        $("html, body").animate({
            scrollTop: 0
        }, 1000, "easeInOutExpo", function() {
            document.documentElement.tabIndex = 0;
            document.documentElement.focus();
            event.currentTarget.setAttribute("aria-pressed", false);
        });

        return false;
    });

    $(".offcanvas-menu-item").on("click", function() {
        // collapse the menu
        $(".navbar-toggler").trigger("click");
    });

    $("a[href^='http']").on("click", function() {
        // show the loading icon
        $(".lds-container").show();
    });

    // jQuery document ready function
    $(function() {
        var motionReduce;
        var overlay;
        
        // Check if prefers reduced motion - if true, tell jQuery to not use animations
        // this includes the scroll to some position.
        if (typeof window.matchMedia === 'function') {
            motionReduce = window.matchMedia("(prefers-reduced-motion: reduce)");
    
            if (motionReduce.matches === true) {
                $.fx.off = true;
            }
        }

        // Have the dropdown menus slide down, rather than just appear
        // https://getbootstrap.com/docs/4.1/components/dropdowns/#events
        // https://codepen.io/adammacias/pen/dozPVQ
        overlay = document.getElementById("offcanvas-overlay");
    
        $(".dropdown").on("show.bs.dropdown", function() {
            $(this).find(".dropdown-menu").first().stop(true, true).slideDown(300);
        });
    
        $(".dropdown").on("hide.bs.dropdown", function() {
            $(this).find(".dropdown-menu").first().stop(true, true).slideUp(200);
        });
    
        // Show the EU cookie notice (if it's the first time to the site or a new session)
        if (document.cookie.indexOf("eu-cookie-notice") < 0) { // no cookie
            if (window.sessionStorage.getItem("eu-opt-out") !== "true") { // no session item
                //Cookie not found and no current session, so show the banner
                $("#eu-cookie").slideDown();
                $(".detail-first-section").addClass("cookie-notice-margin");
                $("#btn-cookie-accept").on("click", function() {
                    var date = new Date();
                    // gaScript is defined in the head
                    date.setTime(date.getTime() + 31536000000); // one year
                    document.cookie = "eu-cookie-notice=true; expires=" + date.toGMTString() + ";path=/";
                    $("#eu-cookie").slideUp();
                    $(".detail-first-section").removeClass("cookie-notice-margin");
                    
                    // Enable tracking
                    document.head.appendChild(gaScript);
                });
                $("#btn-cookie-opt-out").on("click", function() {
                    try {
                        window.sessionStorage.setItem("eu-opt-out", "true");
                    } catch (error) {
                        console.error(error);
                    }
                    $("#eu-cookie").slideUp();
                    $(".detail-first-section").removeClass("cookie-notice-margin");
                });
            }
            
        }
    
        // Toggler function for showing the offcanvas menu on mobile devices
        $("[data-toggle='offcanvas']").on("click", function(event) {
            var tmp;
    
            if (event.currentTarget.getAttribute("aria-expanded") === "false") {
                event.currentTarget.setAttribute("aria-expanded", true);
                if (document.body.style.transition !== undefined) { // only do for modern browsers
                    overlay.classList.add("transition-overlay");
                    tmp = overlay.clientWidth; // force layout
                    overlay.classList.remove("hide-overlay");
                }
            } else {
                event.currentTarget.setAttribute("aria-expanded", false);
                if (document.body.style.transition !== undefined) {
                    overlay.classList.add("transition-overlay");
                    overlay.classList.add("hide-overlay");
                }
            }
    
            $(".offcanvas").toggleClass("off-canvas-active");
            $(".footer").toggleClass("off-canvas-active");
        });
    
        if (document.body.style.transition !== undefined) {
            overlay.addEventListener("transitionend", function() {
                overlay.classList.remove("transition-overlay");
            }, false);
            overlay.addEventListener("click", function() {
                $(".navbar-toggler").trigger("click");
            }, false);
        }
    
        // Sticky footer height setting
        function adjustStickyFooter() {
            var footer = document.getElementsByTagName("footer")[0].clientHeight;
    
            document.getElementsByTagName("body")[0].style.marginBottom = footer + "px";
        }
    
        window.addEventListener("resize", adjustStickyFooter, false);
    
        // Initiate footer setting
        adjustStickyFooter();
    });

}));
