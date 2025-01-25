if ($('.swiper-left').length > 0) {
    new Swiper(".swiper-left", {
        speed: 800,
        spaceBetween: 10,
        slidesPerView: 3,
        rewind: false,
        loop: true,
        freeMode: false,
        allowTouchMove: true,
        direction: "vertical",
        lazy: true,

        autoplay: { delay: 2000, pauseOnMouseEnter: true, },
        on: {
            init: function () {
                setSlideHeight(this);
            },
            slideChangeTransitionEnd: function () {
                setSlideHeight(this);
            }
        }
    });
}
