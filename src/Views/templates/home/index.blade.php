@extends('layout')
@section('content')
    @if ($productNB->isNotEmpty())
        <div class="wrap-slider">
            <div class="wrap-content">
                <div class="grid grid-cols-5 gap-[17px] mr-[100px] ">
                    <div class="col-span-4">
                        <div class="slider-novel-left swiper ">
                            <div class="swiper-wrapper ">
                                @foreach ($productNB as $v)
                                    <div class="swiper-slide">
                                        <div class="novel-item">
                                            <div class="grid grid-cols-3 items-center gap-[50px]">
                                                <div class="info col-span-2">
                                                    <a href="{{ $v->slugvi }}" class="text-decoration-none">
                                                        <div class="name line-clamp-2">
                                                            {{ $v->namevi }}
                                                        </div>
                                                    </a>
                                                    <div class="cover-properties-info">
                                                        @if (!empty($v->getAuthor->fullname))
                                                            <div class="items-properties-info author">
                                                                <img src="assets/images/TempImages/ico-author.png"
                                                                    alt="">
                                                                <span>
                                                                    <strong>
                                                                        Tác giả:
                                                                    </strong>
                                                                    {{ $v->getAuthor->fullname }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        @if ($v->tags->isNotEmpty())
                                                            <div class="items-properties-info tags">
                                                                <img src="assets/images/TempImages/ico-tl.png"
                                                                    alt="">
                                                                <span>
                                                                    <strong>
                                                                        Thể loại:
                                                                    </strong>
                                                                    @foreach ($v->tags as $ktag => $tag)
                                                                        <a href="{{ $tag->slugvi }}"
                                                                            class="text-decoration-none">
                                                                            {{ $tag->namevi }}
                                                                        </a>
                                                                        @if ($ktag < $v->tags->count() - 1)
                                                                            ,
                                                                        @endif
                                                                    @endforeach
                                                                </span>
                                                            </div>
                                                        @endif
                                                        @if (!empty($v->view))
                                                            <div class="items-properties-info view">
                                                                <img src="assets/images/TempImages/ico-view-2.png"
                                                                    alt="">
                                                                <span>
                                                                    <strong>
                                                                        Lượt đọc:
                                                                    </strong>
                                                                    {{ $v->view }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        @if (!empty($v->favorite))
                                                            <div class="items-properties-info favorite">
                                                                <img src="assets/images/TempImages/ico-like-2.png"
                                                                    alt="">
                                                                <span>
                                                                    <strong>
                                                                        Lượt thích: {{ $v->favorite }}
                                                                    </strong>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="desc">
                                                        <span class="line-clamp-9">
                                                            {{ $v->descvi }}
                                                        </span>
                                                    </div>
                                                    <div class="btn-rn">
                                                        <a href=""
                                                            class="flex items-center gap-[10px] text-decoration-none ">
                                                            Đọc ngay
                                                            <div class="move-left-right">
                                                                <img src="assets/images/TempImages/ico-rn.png"
                                                                    alt="">
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="image main-cover-img-novel  col-span-1">
                                                    @component('component.tool.image', [
                                                        'folder' => 'product',
                                                        'type' => 'truyen',
                                                        'item' => $v,
                                                    ])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="cover-novel-right p-[17px]">
                            <div class="slider-novel-right swiper">
                                <div class="swiper-wrapper">
                                    @php
                                        // $productNB = $productNB->slice(1, -1);
                                        // $productNB = $productNB->merge($productNB);
                                        // dd($productNB);
                                    @endphp
                                    @foreach ($productNB as $v)
                                        <div class="swiper-slide">
                                            <div class="novel-item">
                                                <div class="image main-cover-img-novel">
                                                    @component('component.tool.image', [
                                                        'folder' => 'product',
                                                        'type' => 'truyen',
                                                        'item' => $v,
                                                        'class' => 'noClass',
                                                        'aspect' => 'noAspect',
                                                    ])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="wrap-btn-cash">
        <div class="wrap-content">
            <div class="item-btn-cash">
                <a href="nap-hoa" class=" text-decoration-none ">
                    <span>
                        Bấm vào đây để nạp hoa
                    </span>
                </a>
            </div>
        </div>
    </div>

    @if ($productNB->isNotEmpty())
        <div class="wrap-novel-home padding-main">
            <div class="wrap-content">
                <div class="novel-home">
                    <div class="novel-home-top grid grid-cols-4 gap-[30px]">
                        <div class="title-tags-main">
                            <span>
                                HỒNG CHI ĐỀ XUẤT
                            </span>
                        </div>
                        <div class="title-tags-main active">
                            <span>
                                HỒNG CHI ĐỀ XUẤT
                            </span>
                        </div>
                    </div>

                    <div class="cover-novel-home">
                        <div class="grid grid-cols-5 gap-[20px]">
                            @foreach ($productNB as $item)
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
                                                                <img src="assets/images/TempImages/ico-author.png"
                                                                    alt="">
                                                                <span>
                                                                    <strong>
                                                                        Tác giả:
                                                                    </strong>
                                                                    {{ $item->getAuthor->fullname }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <div class="items-properties-info author">
                                                            <img src="assets/images/TempImages/cal-white-1.png"
                                                                alt="">
                                                            <span>
                                                                <strong>
                                                                    Xuất bản:
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
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="wrap-ranking-1 padding-bottom-main">
        <div class="wrap-content">
            <div class="box-title-ranking !mb-4">
                <div class="title-main !mb-0">
                    <h2>
                        Bảng xếp hạng
                    </h2>
                </div>
                <div class="text-center">
                    <img src="assets/images/TempImages/hoa.png" alt="">
                </div>
            </div>

            <div class="cover-ranking-1">
                <div class="grid grid-cols-2 gap-[150px]">
                    <div class="page">
                        <div class="title">
                            Truyện đọc nhiều nhất
                        </div>
                        <div class="cover-items">
                            @foreach ($productMostView->take(5) as $kitem => $item)
                                <div class="item grid grid-cols-5 items-center mb-3 ">
                                    <div class="col-span-4">
                                        <div class="info">
                                            <div class="name flex items-center gap-2">
                                                <img src="assets/images/TempImages/rank-{{ $kitem + 1 }}.png"
                                                    alt="">
                                                <span class="line-clamp-2">
                                                    {{ $item->namevi }}
                                                </span>
                                            </div>
                                            @if (!empty($item->getAuthor->fullname))
                                                <div class="items-properties-info author">
                                                    <img src="assets/images/TempImages/ico-author-black.png"
                                                        alt="">
                                                    <span>
                                                        <strong>
                                                            Tác giả:
                                                        </strong>
                                                        {{ $item->getAuthor->fullname }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="items-properties-info view">
                                                <img src="assets/images/TempImages/ico-view-black.png" alt="">
                                                <span>
                                                    <strong>
                                                        Lượt đọc:
                                                    </strong>
                                                    {{ $item->view }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="image text-end">
                                            <div class="main-cover-img-novel-2">
                                                <div class="cover-img">
                                                    @component('component.tool.image', [
                                                        'folder' => 'product',
                                                        'type' => 'truyen',
                                                        'item' => $item,
                                                        'thumb' => '70x115x1',
                                                        'class' => 'noClass',
                                                        'effect' => 'noneEff',
                                                        'aspect' => false,
                                                    ])
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="page">
                        <div class="title">
                            Tác giả chuyên cần
                        </div>
                        <div class="cover-items">
                            @foreach ($membersMostChapter->take(5) as $kitem => $item)
                                <div class="item grid grid-cols-5 items-center mb-3 ">
                                    <div class="col-span-4">
                                        <div class="info">
                                            <div class="name flex items-center gap-2">
                                                <img src="assets/images/TempImages/rank-{{ $kitem + 1 }}.png"
                                                    alt="">
                                                <span class="line-clamp-2">
                                                    {{ $item->fullname }}
                                                </span>
                                            </div>
                                            <div class="items-properties-info author">
                                                <img src="assets/images/TempImages/ico-chapter.png" alt="">
                                                <span>
                                                    <strong>
                                                        Số chương đăng
                                                    </strong>
                                                    {{ $item['product_count'] }} chương
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="image text-end">
                                            <div class="avt">
                                                <div class="cover-img rounded-full overflow-hidden inline-block">
                                                    <img onerror="this.src='{{ thumbs('thumbs/85x85x1/assets/images/noimage.png.webp') }}';"
                                                        src="{{ assets_photo('user', '85x85x1', $item['avatar'], 'thumbs') }}"
                                                        alt="{{ $item->fullname }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="wrap-novel-status bg-[#FFF5FB] padding-main">
        <div class="wrap-content">
            <div class="grid grid-cols-2 gap-[40px]">
                <div class="page">
                    <div class="title-tags-main active">
                        <span>
                            TRUYỆN ĐÃ HOÀN THÀNH
                        </span>
                    </div>
                    <div class="banner rounded-[10px] overflow-hidden mb-[20px]">
                        @component('component.tool.image', [
                            'folder' => 'photo',
                            'type' => 'banner-home',
                            'item' => $bannerHome->first(),
                            'thumb' => '',
                            // 'var' => 'photo',
                            // 'effect' => 'hover-img scale-img',
                            // 'aspect' => '1/1',
                        ])
                        @endcomponent
                    </div>
                    <div class="novel-complete">
                        <div class="novel-complete-list">
                            <div class="grid grid-cols-2 gap-[20px]">
                                @foreach ($productNB->take(4) as $item)
                                    <div class="item relative">
                                        <div class="image">
                                            @component('component.tool.image', [
                                                'folder' => 'product',
                                                'type' => 'truyen',
                                                'item' => $item,
                                                'thumb' => '283x360x1',
                                                'class' => 'noClass',
                                                'aspect' => false,
                                            ])
                                            @endcomponent
                                        </div>
                                        <div class="info">
                                            <div class="name">
                                                <span>
                                                    {{ $item->namevi }}
                                                </span>
                                            </div>
                                            <div class="info-cover flex flex-basis-1 items-center gap-[8px]">
                                                <div class="avt rounded-full overflow-hidden inline-block">
                                                    @component('component.tool.image', [
                                                        'folder' => 'product',
                                                        'type' => 'truyen',
                                                        'item' => $item,
                                                        'thumb' => '40x40x1',
                                                        'class' => 'noClass',
                                                        'aspect' => false,
                                                    ])
                                                    @endcomponent
                                                </div>
                                                <div class="ico">
                                                    <img src="assets/images/TempImages/ico-tl.png" alt="">
                                                </div>
                                                <div class="author">
                                                    <strong>
                                                        Tác giả:
                                                    </strong>
                                                    <span>
                                                        {{ $item->getAuthor->fullname }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page">
                    <div class="title-tags-main active">
                        <span>
                            TRUYỆN MỚI CẬP NHẬT
                        </span>
                    </div>

                    <div class="novel-update">
                        <div class="novel-update-list">
                            @foreach ($productNB->take(4) as $item)
                                <div class=" item grid grid-cols-3 gap-[15px]">
                                    <div class="image col-span-1">
                                        <div class="cover-novel-update">
                                            @component('component.tool.image', [
                                                'folder' => 'product',
                                                'type' => 'truyen',
                                                'item' => $item,
                                                'thumb' => '163x210x1',
                                                'aspect' => false,
                                            ])
                                            @endcomponent
                                        </div>
                                    </div>
                                    <div class="info col-span-2">
                                        <div class="chapter">
                                            <span>
                                                Chương 34
                                            </span>
                                        </div>
                                        <div class="name">
                                            <span class="line-clamp-1">
                                                {{ $item->namevi }}
                                            </span>
                                        </div>
                                        <div class="info-properties-cover">
                                            <div class="items-properties-info author">
                                                <img src="assets/images/TempImages/ico-author-black.png" alt="">
                                                <span>
                                                    <strong>
                                                        Tác giả:
                                                    </strong>
                                                    {{ $item->getAuthor->fullname }}
                                                </span>
                                            </div>
                                            @if ($item->tags->isNotEmpty())
                                                <div class="items-properties-info author">
                                                    <img src="assets/images/TempImages/ico-pt.png" alt="">
                                                    <span>
                                                        <strong>
                                                            Thể loại:
                                                        </strong>
                                                        @foreach ($item->tags as $ktag => $tag)
                                                            <a href="{{ $tag->slugvi }}" class="text-decoration-none">
                                                                {{ $tag->namevi }}
                                                            </a>
                                                            @if ($ktag < $item->tags->count() - 1)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </div>
                                            @endif

                                            <div class="ext grid grid-cols-2 gap-[10px]">
                                                <div class="items-properties-info author">
                                                    <img src="assets/images/TempImages/ico-view-black.png" alt="">
                                                    <span>
                                                        <strong>
                                                            Lượt đọc
                                                        </strong>
                                                        Khánh nè
                                                    </span>
                                                </div>
                                                <div class="items-properties-info author">
                                                    <img src="assets/images/TempImages/ico-like-black.png" alt="">
                                                    <span>
                                                        <strong>
                                                            Yêu thích:
                                                        </strong>
                                                        1000 lượt
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="btn-rn flex items-center gap-[5px]">
                                                <img src="assets/images/TempImages/ico-tl.png" alt="">
                                                <span>
                                                    ĐỌC TRUYỆN
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @if ($tagsHome->isNotEmpty())
        <div class="wrap-novel-home padding-main">
            <div class="wrap-content">
                <div class="novel-home novel-tags">
                    <div class="novel-home-top grid grid-cols-4 gap-[30px]">
                        @foreach ($tagsHome as $item)
                            <div class="title-tags-main active" data-id="{{ $item->id }}">
                                <span>
                                    {{ $item->namevi }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="cover-novel-home">
                        <div class="grid grid-cols-5 gap-[20px]">
                            @foreach ($productNB as $item)
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
                                                                <img src="assets/images/TempImages/ico-author.png"
                                                                    alt="">
                                                                <span>
                                                                    <strong>
                                                                        Tác giả:
                                                                    </strong>
                                                                    {{ $item->getAuthor->fullname }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <div class="items-properties-info author">
                                                            <img src="assets/images/TempImages/ico-author.png"
                                                                alt="">
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
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="wrap-ranking-1 padding-main">
        <div class="wrap-content">
            <div class="box-title-ranking mb-3">
                <div class="title-main">
                    <h2>
                        Bảng xếp hạng
                    </h2>
                </div>
                <div class="text-center">
                    <img src="assets/images/TempImages/hoa.png" alt="">
                </div>
            </div>

            <div class="cover-ranking-1 cover-ranking-2">
                <div class="grid grid-cols-2 gap-[150px]">
                    <div class="page">
                        <div class="title">
                            Phú hộ hoa hồng
                        </div>
                        <div class="cover-items">
                            @foreach ($memberNB->take(5) as $kitem => $item)
                                <div class="item grid grid-cols-5 items-center mb-3 ">
                                    <div class="col-span-4">
                                        <div class="info">
                                            <div class="name flex items-center gap-2">
                                                <img src="assets/images/TempImages/rank-{{ $kitem + 1 }}.png"
                                                    alt="">
                                                <span class="line-clamp-2">
                                                    {{ $item->fullname }}
                                                </span>
                                            </div>
                                            <div class="items-properties-info author">
                                                <img src="assets/images/TempImages/ico-chapter.png" alt="">
                                                <span>
                                                    <strong>
                                                        Số chương đăng
                                                    </strong>
                                                    8386 chương
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="image text-end">
                                            <div class="avt">
                                                <div class="cover-img rounded-full overflow-hidden inline-block">
                                                    <img onerror="this.src='{{ thumbs('thumbs/85x85x1/assets/images/noimage.png.webp') }}';"
                                                        src="{{ assets_photo('user', '85x85x1', $item['avatar'], 'thumbs') }}"
                                                        alt="{{ $item->fullname }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="page">
                        <div class="title">
                            Độc giả sôi động
                        </div>
                        <div class="cover-items">
                            @foreach ($memberNB->take(5) as $kitem => $item)
                                <div class="item grid grid-cols-5 items-center mb-3 ">
                                    <div class="col-span-4">
                                        <div class="info">
                                            <div class="name flex items-center gap-2">
                                                <img src="assets/images/TempImages/rank-{{ $kitem + 1 }}.png"
                                                    alt="">
                                                <span class="line-clamp-2">
                                                    {{ $item->fullname }}
                                                </span>
                                            </div>
                                            <div class="items-properties-info author">
                                                <img src="assets/images/TempImages/ico-chapter.png" alt="">
                                                <span>
                                                    <strong>
                                                        Số chương đăng
                                                    </strong>
                                                    8386 chương
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="image text-end">
                                            <div class="avt">
                                                <div class="cover-img rounded-full overflow-hidden inline-block">
                                                    <img onerror="this.src='{{ thumbs('thumbs/85x85x1/assets/images/noimage.png.webp') }}';"
                                                        src="{{ assets_photo('user', '85x85x1', $item['avatar'], 'thumbs') }}"
                                                        alt="{{ $item->fullname }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($commentHome->isNotEmpty())
        <div class="wrap-history-voted padding-bottom-main">
            <div class="wrap-content">
                <div class="box-title-ranking !mb-4">
                    <div class="title-main !mb-0">
                        <h2>
                            ĐÁNH GIÁ BẠN ĐỌC
                        </h2>
                    </div>
                    <div class="text-center">
                        <img src="assets/images/TempImages/hoa.png" alt="">
                    </div>
                </div>
                <div class="history-voted">
                    <div class="history-voted-list owl-page owl-carousel owl-theme"
                        data-items="screen:0|items:3|margin:30,screen:425|items:3|margin:30,screen:575|items:3|margin:30,screen:767|items:3|margin:30,screen:991|items:3|margin:30,screen:1199|items:3|margin:30"
                        data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="1"
                        data-touchdrag="1" data-smartspeed="500" data-autoplayspeed="3500" data-dots="0"
                        data-nav="0" data-navtext = "" data-navcontainer = ".">


                        @foreach ($commentHome as $item)
                            <div class="item grid grid-cols-6 gap-[10px] items-center">
                                <div class="image col-span-2">
                                    @component('component.tool.image', [
                                        'folder' => 'product',
                                        'type' => 'truyen',
                                        'item' => $item->getVariant,
                                        'thumb' => '120x165x1',
                                        'aspect' => false,
                                    ])
                                    @endcomponent
                                </div>
                                <div class="info col-span-4">
                                    <div class="star flex items-center gap-1 flex-wrap">
                                        @if ($item->star > 0)
                                            @for ($i = 0; $i < $item->star; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                        @endif
                                    </div>
                                    <div class="name-novel">
                                        <span class="text-split-1">
                                            {{ $item->getVariant->namevi }}
                                        </span>
                                    </div>
                                    <div class="content-vote">
                                        <span class="text-split-3">
                                            {{ $item->content }}
                                        </span>
                                    </div>
                                    <div class="user-vote-info flex items-center gap-2">
                                        <div class="avt shrink-0  rounded-full overflow-hidden">
                                            <img onerror="this.src='{{ thumbs('thumbs/50x50x1/assets/images/noimage.png.webp') }}';"
                                                src="{{ assets_photo('user', '50x50x1', $item->getUser->avatar, 'thumbs') }}"
                                                alt="{{ $item->getUser->fullname }}">
                                        </div>
                                        <div class="user-info">


                                            <div class="name">
                                                <span>
                                                    {{ $item->getUser->fullname }}
                                                </span>
                                            </div>
                                            <div class="desc">
                                                <span>
                                                    top 1 độc giả
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class=" control-owl transition"></div>
                </div>
            </div>
        </div>
    @endif
@endsection
