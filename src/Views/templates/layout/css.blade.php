{!! cssminify()->set('css/animate.min.css');
    cssminify()->set('css/style-tailwind.css');
    cssminify()->set('bootstrap/bootstrap.css');
    cssminify()->set('fontawesome640/all.css');
    cssminify()->set('owlcarousel2/owl.carousel.css');
    cssminify()->set('owlcarousel2/owl.theme.default.css');
    cssminify()->set('holdon/HoldOn.css');
    cssminify()->set('holdon/HoldOn-style.css');
    cssminify()->set('confirm/confirm.css');
    cssminify()->set('simplenotify/simple-notify.css');
    cssminify()->set('fancybox5/fancybox.css');
    cssminify()->set('slick/slick.css');
    cssminify()->set('slick/slick-theme.css');
    cssminify()->set('slick/slick-style.css');
    cssminify()->set('photobox/photobox.css');
    cssminify()->set('fotorama/fotorama.css');
    cssminify()->set('mmenu/mmenu.css');
    cssminify()->set('sweetalert/sweetalert2.all.min.css');
    cssminify()->set('fotorama/fotorama-style.css');
    cssminify()->set('admin/toastify/toastify.css');
    cssminify()->set('css/aos.css');
    cssminify()->set('css/swiper-bundle.min.css');
    // cssminify()->set('css/cart.css');
    cssminify()->set('css/style.css');
    cssminify()->set('css/media.css');
    echo cssminify()->get();
!!}
@stack('styles')
