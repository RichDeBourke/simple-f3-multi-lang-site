/*  JavaScript functions for image overlay slider
    Copyright 2018 Rich DeBourke
    Code may be used under an MIT License:
    https://github.com/RichDeBourke/simple-f3-multi-lang-site/blob/master/LICENSE */
(function ($, win, doc){
    var $overlay,
        $overlayCurrent,
        imgIndex = 1,
        intervalID,
        delayTime = 4000;

    function updateFront() {
        "use strict";
        $overlay.removeClass("front").attr("aria-hidden","true");
        $(".overlay:nth-last-child(" + imgIndex + ")").addClass("front").removeAttr("aria-hidden");
    }

    function updateIndicator() {
        "use strict";
        $overlayCurrent.removeClass("selected");
        $(".overlay-current:nth-child(" + imgIndex + ")").addClass("selected");
    }

    function next() {
        "use strict";
        if (imgIndex >= $overlay.length) {
            imgIndex -= $overlay.length;
        }
        imgIndex += 1;
        updateFront();
        updateIndicator();
    }

    function prev() {
        "use strict";
        imgIndex -= 1;
        if (imgIndex < 1) {
            imgIndex += $overlay.length;
        }
        updateFront();
        updateIndicator();
    }

    function select() {
        imgIndex = $(this).index() + 1;
        updateFront();
        updateIndicator();
    }

    // Display stops on mouse-enter - restart 0.5 seconds after leaving
    function mouseLeft () {
        next();
        intervalID = win.setInterval(next, delayTime);
    }

    $(function () {
        "use strict";
        $overlay = $(".overlay");
        $overlayCurrent = $(".overlay-current");
        updateFront();
        updateIndicator();
        $("#next").on("click", next).on("focus", function () {
            win.clearInterval(intervalID);
        }).on("blur", function () {
            intervalID = setTimeout(mouseLeft, 500);
        });
        $("#prev").on("click", prev).on("focus", function () {
            win.clearInterval(intervalID);
        }).on("blur", function () {
            intervalID = setTimeout(mouseLeft, 500);
        });
        $(".overlay-indicator li").on("click", select);
        $("#overlay-slider").on("mouseenter", function () {
        win.clearInterval(intervalID);
        });
        $("#overlay-slider").on("mouseleave", function () {
            setTimeout(mouseLeft, 500);
        });
        intervalID = win.setInterval(next, delayTime);
    });
}($, window, document));