@if (!empty($productAjax))
    <div class="p-relative">
        <div class="owl-page owl-carousel owl-theme"
            data-items="screen:0|items:2|margin:5,screen:425|items:2|margin:5,screen:575|items:3|margin:5,screen:767|items:3|margin:5,screen:991|items:4|margin:5,screen:1199|items:5|margin:5"
            data-rewind="1" data-autoplay="0" data-loop="0" data-lazyload="0" data-mousedrag="0" data-touchdrag="0"
            data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000" data-dots="0"
            data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
            data-nav="1" data-navcontainer=".control-sale">
            @foreach ($productAjax as $v)
                @component('component.itemProduct', ['product' => $v])
                @endcomponent
            @endforeach
        </div>
        <div class="control-sale control-owl transition"></div>
    </div>
@endif