var owl = $('.owl-carousel');
var isAnim = false;

owl.owlCarousel({
    smartSpeed: 1700,
    loop: true,
    margin: 30,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1.9
        },
        1000: {
            items: 1.7
        },
        1500: {
            items: 1.2
        },
        1900: {
            items: 1.2
        },
        2000: {
            items: 1.4
        },
        2100: {
            items: 1.45
        },
        2200: {
            items: 1.5
        },
        2300: {
            items: 1.55
        },
        2400: {
            items: 1.6
        },
        2500: {
            items: 1.65
        },
        2600: {
            items: 1.7
        },
        2700: {
            items: 1.75
        },
        2800: {
            items: 1.8
        },
        2900: {
            items: 1.85
        },
        3000: {
            items: 1.9
        },
        3100: {
            items: 1.95
        },
        3200: {
            items: 2
        }
    }
});
owl.on('mousewheel', '.owl-stage', function (e) {
    if (!isAnim) {
        isAnim = true;
        if (e.deltaY > 0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        setTimeout(function () { isAnim = false; }, 1700);
        e.preventDefault();
    }
});