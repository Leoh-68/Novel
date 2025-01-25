{{-- <div class="slideshow relative">
    <div class="slider-swip swiper">
        <div class="swiper-wrapper">
            @foreach ($slider as $v)
                <div class="swiper-slide">
                    <div class="slideshow-item block aspect-[1366/580]" owl-item-animation>
                        <a class="slideshow-image " href="" target="_blank" title="{{ $v['namevi'] }}">
                            <picture>
                                <source media="(max-width: 500px)"
                                    srcset="{{ assets_photo('photo', '500x290x1', $v['photo'], 'thumbs') }}">
                                <img class="w-100" onerror="this.src='assets/images/noimage.png';"
                                    src="{{ assets_photo('photo', '1366x580x1', $v['photo'], 'thumbs') }}"
                                    alt="{{ $v['namevi'] }}" title="{{ $v['namevi'] }}" loading="lazy" />
                            </picture>
                            <div class="swiper-lazy-preloader"></div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}
