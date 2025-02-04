@if ($productTags->isNotEmpty())


    <div class="grid grid-cols-5 gap-[20px]">
        @foreach ($productTags as $item)
            <div class="item relative">
                <a href="{{ $item->slugvi }}" class=" text-decoration-none ">
                    <div class="image main-cover-img-novel">
                        @component('component.tool.image', [
                            'folder' => 'product',
                            'type' => 'truyen',
                            'item' => $item,
                            'effect' => 'noneEff',
                            'aspect' => false,
                        ])
                        @endcomponent
                    </div>
                </a>
                <div class="info">

                    <div class="info-content">
                        <a href="{{ $item->slugvi }}" class=" text-decoration-none ">
                            <div class="name">
                                <span>
                                    {{ $item->namevi }}
                                </span>
                            </div>
                        </a>
                        <div class="cover-info">
                            <div class="grid grid-cols-2 items-end">
                                <div class="left">
                                    @if (!empty($item->getAuthor->fullname))
                                        <div class="items-properties-info author">
                                            <img src="assets/images/TempImages/ico-author.png" alt="">
                                            <span>
                                                <strong>
                                                    Tác giả:
                                                </strong>
                                                {{ $item->getAuthor->fullname }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="items-properties-info author">
                                        <img src="assets/images/TempImages/ico-author.png" alt="">
                                        <span>
                                            <strong>
                                                Xuất bản
                                            </strong>
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="right flex gap-2">
                                    <div class="btn-rn flex items-center gap-[5px]">
                                        <img src="assets/images/TempImages/ico-tl.png" alt="">
                                        <span>
                                            ĐỌC TRUYỆN
                                        </span>
                                    </div>
                                    <div class="btn-favor">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="desc">
                            <span class="line-clamp-4">
                                {{ $item->descvi }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @continue
        @endforeach
    </div>
@endif
