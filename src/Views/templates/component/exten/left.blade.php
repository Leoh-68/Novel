@push('styles')
    <link rel="stylesheet" href="{{ assets('assets/css/exten/left.css?v=' . Func::stringRandom()) }}">
@endpush

@push('scripts')
    <script src="{{ assets('assets/js/exten/left.js?v=' . Func::stringRandom()) }}"></script>
@endpush

<div class="wrap-left">
    @if (!empty($criteriaHome) && ($com ?? '') == 'san-pham')
        <div class="cover-left sticky top-[50px] ">
            @foreach ($criteriaHome as $item)
                <div class="item-criteria-inner mt-3 p-3 border-main ">
                    <a class="text-decoration-none flex items-center gap-3">
                        <div class="img shrink-0 ">
                            @component('component.tool.image', [
                                'item' => $item,
                                'type' => 'tieu-chi',
                                'thumb' => '50x50x3',
                                'folder' => 'news',
                            ])
                            @endcomponent
                        </div>
                        <div class="name">
                            <span>{{ $item['namevi'] }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="cover-left sticky top-[50px]">
            <div class="swiper-left swiper">
                <div class="swiper-wrapper">
                    @foreach ($news as $item)
                        <div class="swiper-slide">
                            <div class="item-left mt-3 p-3 border-main ">
                                <a class="text-decoration-none flex items-center gap-3">
                                    <div class="img shrink-0">
                                        @component('component.tool.image', [
                                            'item' => $item,
                                            'type' => 'tieu-chi',
                                            'thumb' => '100x100x1',
                                            'folder' => 'news',
                                        ])
                                        @endcomponent
                                    </div>
                                    <div class="info">
                                        <div class="name mb-2 text-base font-semibold">
                                            <span class="line-clamp-2">{{ $item['namevi'] }}</span>
                                        </div>
                                        <div class="desc">
                                            <span class="line-clamp-3">{{ $item['descvi'] }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
