$(document).ready(function () {
    var slicked = $(".slicker-for");

    slicked.each(function () {
        if ($(this).is(".8-slides")) {
            $(this).slick({
                slidesToShow: 8,
                slidesToScroll: 1,
                infinite: true,
                autoplaySpeed: 2000,
                autoplay: true,
                lazyLoad: 'ondemand',
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 1,
                            infinite: true,
                            autoplaySpeed: 2000,
                            autoplay: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            infinite: true,
                            autoplaySpeed: 2000,
                            autoplay: true
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            autoplaySpeed: 2000,
                            autoplay: true
                        }
                    }
                ]

            });
        }
        else if ($(this).is(".7-slides")) {
            $(this).slick({
                slidesToShow: 7,
                slidesToScroll: 1,
                infinite: true,
                autoplaySpeed: 2000,
                autoplay: true,
                lazyLoad: 'ondemand',
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]


            });
        }
        else if ($(this).is(".6-slides")) {
            $(this).slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite: true,
                autoplaySpeed: 2000,
                autoplay: true,
                lazyLoad: 'ondemand',
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]


            });
        }
        else if ($(this).is(".5-slides")) {
            $(this).slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
                autoplaySpeed: 2000,
                autoplay: true,
                lazyLoad: 'ondemand',
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]

            });
        }
        else if ($(this).is(".4-slides")) {
            $(this).slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                autoplaySpeed: 2000,
                autoplay: true,
                lazyLoad: 'ondemand',
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        else if ($(this).is(".3-slides")) {
            $(this).slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                autoplaySpeed: 2000,
                autoplay: true,
                lazyLoad: 'ondemand',
                arrows: true
            });
        }
        else {
            $(this).slick({
                infinite: true,
                autoplaySpeed: 1000,
                autoplay: true,
                arrows: false,
                draggable: true,
                lazyLoad: 'ondemand'
            });
        }
    });

})
$('.nav-item a').on('click', function (e) {
    e.target
    e.preventDefault
    $('.nav-link').removeClass('active');
    $(this).tab('show');
})
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('.slicker-for').slick('setPosition');
})