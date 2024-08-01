 //*==========FLASH SELL SLIDER========= 
    $('.flash_sell_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    
    

    

    