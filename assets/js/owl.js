$(document).ready(() => {
    $('.hero-slider').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        margin: 0,
        autoplay: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // one
    $('.box-2-child').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        lazyLoad: true,
        margin: 0,
        responsiveBaseElement: 'body',
        autoplay: true,
        rtl: true,
        responsive: {
            0: {
                items: 2,
                dots: false,
                nav: false,
            },
            576: {
                items: 2,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 4,
            },
            1746: {
                items: 4,
            }
        }
    });

    // slider 1
    $('.carousel_1').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        lazyLoadEager: 7,
        margin: 10,
        responsiveBaseElement: 'body',
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2,
                nav: true,
            },
            600: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 4
            },
            1300: {
                items: 6
            },
            1400: {
                items: 6
            }
        }
    });

    // slider 2
    $('.carousel_2').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        margin: 10,
        dots: false,
        responsiveBaseElement: 'body',
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 5
            },
            1024: {
                items: 5
            },
            1200: {
                items: 5
            },
            1400: {
                items: 6
            },
            1746: {
                items: 7
            }
        }
    });

    // slider 3
    $('.carousel_3').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        lazyLoadEager: 8,
        margin: 10,
        dots: false,
        responsiveBaseElement: 'body',
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 4
            },
            1300: {
                items: 6
            },
            1400: {
                items: 6
            }
        }
    });

    $('.carousel_4').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        margin: 10,
        dots: false,
        responsiveBaseElement: 'body',
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 4
            },
            1300: {
                items: 6
            },
            1400: {
                items: 6
            }
        }
    });

    // slider 7
    $('.carousel_5').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        margin: 10,
        responsiveBaseElement: 'body',
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 4
            },
            1300: {
                items: 6
            },
            1400: {
                items: 6
            }
        }
    });

    $('.carousel_6').owlCarousel({
        loop: true,
        nav: true,
        lazyLoad: true,
        margin: 10,
        dots: false,
        responsiveBaseElement: 'body',
        autoplay: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 4
            },
            1300: {
                items: 6
            },
            1400: {
                items: 6
            }
        }
    });

    $('.carousel_nav_1').owlCarousel({
        loop: true,
        nav: false,
        lazyLoad: true,
        responsiveBaseElement: 'body',
        margin: 0,
        autoplay: true,
        dots: false,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            },
            1024: {
                items: 4
            },
            1200: {
                items: 4
            },
            1400: {
                items: 4
            }
        }
    });

});

var windows = $(window);
var screenSize = windows.width();
var sticky = $('.header-top');
var nav = $('.hero-child-1');
var mega = $('.a_meganav');
var $html = $('html');
var $body = $('body');

windows.on('scroll', function () {
    var scroll = windows.scrollTop();
    var headerHeight = sticky.height();

    if (screenSize >= 320) {
        if (scroll < headerHeight) {
            sticky.removeClass('is-sticky');
            nav.removeClass('nav-stick');
            mega.removeClass('mega-stick');
        } else {
            sticky.addClass('is-sticky');
            nav.addClass('nav-stick');
            mega.addClass('mega-stick');
        }
    }

});



