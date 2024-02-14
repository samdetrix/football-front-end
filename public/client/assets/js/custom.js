$(document).ready(function () {
    "use strict";

    // 1. Scroll To Top
    $(window).on("scroll", function () {
        const scrollTop = $(this).scrollTop();
        const returnToTop = $(".return-to-top");

        if (scrollTop > 300) {
            returnToTop.fadeIn();
        } else {
            returnToTop.fadeOut();
        }
    });

    $(".return-to-top").on("click", function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            1500
        );
        return false;
    });

    // 2. Welcome Animation
    $(window).on("load", function () {
        const welcomeTextElements = $(".welcome-hero-txt h2, .welcome-hero-txt p");
        const welcomeButton = $(".welcome-hero-txt button");

        welcomeTextElements.removeClass("animated fadeInUp").css({ opacity: "0" });
        welcomeButton.removeClass("animated fadeInDown").css({ opacity: "0" });

        welcomeTextElements.addClass("animated fadeInUp").css({ opacity: "0" });
        welcomeButton.addClass("animated fadeInDown").css({ opacity: "0" });
    });

    // 3. Owl Carousel

    // i. new-cars-carousel
    $("#new-cars-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        dots: true,
        mouseDrag: true,
        nav: false,
        smartSpeed: 1000,
        transitionStyle: "fade",
        animateIn: "fadeIn",
        animateOut: "fadeOutLeft",
    });

    // ii. testimonial-carousel
    const testimonialCarousel = $(".testimonial-carousel");
    testimonialCarousel.owlCarousel({
        items: 3,
        margin: 0,
        loop: true,
        autoplay: true,
        smartSpeed: 1000,
        dots: false,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: { items: 1 },
            640: { items: 2 },
            992: { items: 3 },
        },
    });

    // iii. brand-item (carousel)
    $(".brand-item").owlCarousel({
        items: 6,
        loop: true,
        smartSpeed: 1000,
        autoplay: true,
        dots: false,
        autoplayHoverPause: false,
        responsive: {
            0: { items: 2 },
            415: { items: 2 },
            600: { items: 3 },
            1000: { items: 6 },
        },
    });

    $(".play").on("click", function () {
        testimonialCarousel.trigger("play.owl.autoplay", [1000]);
    });

    $(".stop").on("click", function () {
        testimonialCarousel.trigger("stop.owl.autoplay");
    });

   
});
