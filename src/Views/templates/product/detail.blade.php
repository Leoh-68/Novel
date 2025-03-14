@extends('layout')
@section('content')
    <section>
        <div class="grid-pro-detail">
            <div class="wrap-content">
                <div class=" grid grid-cols-5 gap-[50px]">
                    <div class="left-pro-detail col-span-1">
                        <div class="main-cover-img-novel-2 cover-detail">
                            <div class="cover-img">
                                @component('component.tool.image', [
                                    'folder' => 'product',
                                    'type' => 'truyen',
                                    'item' => $rowDetail,
                                    'thumb' => '225x396x1',
                                    'class' => 'noClass',
                                    'effect' => 'noneEff',
                                    'aspect' => false,
                                ])
                                @endcomponent
                            </div>
                        </div>
                    </div>

                    <div class="right-pro-detail col-span-4">
                        <div class="title-pro-detail">
                            <h1>{{ $rowDetail['namevi'] }}</h1>
                        </div>

                        <div class="rate-detail flex items-center gap-3">
                            <div class="comment-star">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <span style="width: {{ Comment::avgStar($rowDetail['id'], $rowDetail['type']) }}%">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                            </div>
                            ({{ Comment::avgPoint($rowDetail['id'], $rowDetail['type']) }}/10 từ {{ $countComment }} bạn
                            đọc)
                        </div>

                        <div class="publish-detail">
                            <span>
                                Xuất bản ngày {{ \Carbon\Carbon::parse($rowDetail['created_at'])->format('d/m/Y') }}
                            </span>
                        </div>
                        @if ($tags->isNotEmpty())
                            <div class="cover-tags-detail flex items-center flex-wrap gap-2">
                                @foreach ($tags as $k => $v)
                                    <div class="tags-detail" style="--tag-color: {{ $v->color }}">
                                        <a href="{{ $v->slugvi }}" class=" text-decoration-none ">
                                            {{ $v->namevi }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($rowDetail['descvi'])
                            <div class="product-dt-desc mt-4" x-data="{ expanded: false }">
                                <div class="desc-detail-top flex items-center justify-between">
                                    <div class="title">
                                        Giới thiệu
                                    </div>
                                    <div class="detail-collapse-button flex items-center gap-3 cursor-pointer "
                                        @click="expanded = !expanded">
                                        <span class=""x-text="(!expanded)?'MỞ RỘNG':'THU GỌN'"></span>
                                        <div class="transition-all duration-300" :class="expanded ? 'rotate-180' : ''">
                                            <img src="assets/images/TempImages/ico-collapse.png" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="desc-detail relative" x-show="expanded" x-collapse.min.90px>
                                    <div x-show="!expanded" class="desc-detail-mask absolute bottom-0 left-0 w-full "></div>
                                    {!! Func::decodeHtmlChars($rowDetail['descvi']) !!}
                                </div>
                            </div>
                        @endif

                        {{-- <div class="share">
                            <b>Chia sẻ:</b>
                            <div class="social-plugin w-clear">
                                @component('component.share')
                                @endcomponent
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="product-detail-tools">
            <div class="wrap-content">
                <div class="cover-tools flex items-center justify-center gap-3 ">
                    <div class="item ">
                        <a href="{{ $rowChapter->isNotEmpty() ? $rowChapter->first()->slugvi : '' }}"
                            class="text-decoration-none flex items-center gap-2">
                            <img src="assets/images/TempImages/ico-tl.png" alt="">
                            <span>
                                Đọc từ đầu
                            </span>
                        </a>
                    </div>
                    @php
                        if ($userLoginCheck) {
                            $checkFollow = Func::checkFollow($userLogin->id, $rowDetail['id']);
                            $checkRecommend = Func::checkFollow($userLogin->id, $rowDetail['id'], 'recommend');
                        }
                    @endphp
                    <div class="item {{ $userLoginCheck ? 'btn-subscribe' : '' }} {{ !empty($checkFollow) ? 'active' : '' }}"
                        data-type="follow" data-novel-id="{{ $rowDetail['id'] }}"
                        data-id-member="{{ !empty($userLogin) ? $userLogin->id : '' }}">
                        <a class="text-decoration-none  flex items-center gap-2">
                            <img src="assets/images/TempImages/ico-tl.png" alt="">
                            <span>
                                {{ !empty($checkFollow) ? 'Đã trong giá sách ' : 'Thêm vào giá sách' }}
                            </span>
                        </a>
                    </div>
                    <div class="item  {{ $userLoginCheck ? 'btn-subscribe' : '' }} {{ !empty($checkRecommend) ? 'active' : '' }}"
                        data-type="recommend" data-novel-id="{{ $rowDetail['id'] }} "
                        data-id-member=" {{ !empty($userLogin) ? $userLogin->id : '' }} ">
                        <a class="text-decoration-none  flex items-center gap-2">
                            <img src="assets/images/TempImages/ico-tl.png" alt="">
                            <span>
                                {{ !empty($checkRecommend) ? 'Đã đề cử ' : 'Đề cử' }}
                            </span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="" class="text-decoration-none flex items-center gap-2">
                            <img src="assets/images/TempImages/ico-tl.png" alt="">
                            <span>
                                Bình luận
                            </span>
                        </a>
                    </div>
                    <div class="btn-donate flex items-center gap-2 ">
                        <div class="cover-btn-donate" data-bs-toggle="modal" data-bs-target="#modalDonate">
                            <a class="text-decoration-none">
                                <img src="assets/images/TempImages/ico-hoa-2.png" alt="{{ $setting['namevi'] }}">
                                <span>
                                    Tặng hoa
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-detail-chapter padding-main">
            <div class="wrap-content">
                <div class="grid grid-cols-9 gap-[30px]">
                    <div class="col-span-6">
                        <div class="left">
                            @if (!empty($authorInfo))
                                <div class="author-info">
                                    <div class="grid grid-cols-4 gap-[50px]">
                                        <div class="cover-avatar text-center col-span-1">
                                            <div class="avatar">
                                                <div class="avatar-user-merger"
                                                    data-border="{{ assets_photo('news', '200x200x1', $archievement['photo'], 'thumbs') }}"
                                                    data-avt="{{ assets_photo('user', '155x155x1', $authorInfo['avatar'], 'thumbs') }}"
                                                    alt="{{ $authorInfo['fullname'] }}">
                                                    <img>
                                                </div>
                                                <div class="name">
                                                    <span>{{ $authorInfo->fullname }}</span>
                                                </div>
                                                <div class="archievement">
                                                    <span>
                                                        Cầm đầu thiên hạ
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-3 gap-[30px]">
                                                <div class="info-item count-novel">
                                                    <img src="assets/images/TempImages/book.png" alt="">
                                                    <p>Tổng số truyện</p>
                                                    <span>
                                                        {{ Func::counterProductMember($authorInfo->id) ?? 0 }}
                                                    </span>
                                                </div>
                                                <div class="info-item count-novel">
                                                    <img src="assets/images/TempImages/like.png" alt="">
                                                    <p>Lượt yêu thích</p>
                                                    <span>
                                                        100
                                                    </span>
                                                </div>
                                                <div class="info-item count-novel">
                                                    <img src="assets/images/TempImages/book.png" alt="">
                                                    <p>Số ngày hoạt động</p>
                                                    <span>
                                                        @php
                                                            $date = \Carbon\Carbon::parse($authorInfo->created_at);
                                                            $now = \Carbon\Carbon::now();
                                                            $diff = round($now->diffInDays($now));
                                                        @endphp
                                                        {{ $diff }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="cover-donate text-center">
                                                <div class="block my-[20px]">
                                                    <img src="assets/images/TempImages/hoa.png" alt="">
                                                </div>

                                                <div class="btn-donate inline-flex items-center gap-2">
                                                    <div class="cover-btn-donate" data-bs-toggle="modal"
                                                        data-bs-target="#modalDonate">
                                                        <a class="text-decoration-none">
                                                            <img src="assets/images/TempImages/ico-hoa-2.png"
                                                                alt="{{ $setting['namevi'] }}">
                                                            <span>
                                                                Tặng hoa
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($rowChapterNew->isNotEmpty())
                                <div class="box-chapter">
                                    <div class="title-chapter flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="15"
                                            viewBox="0 0 22 15" fill="none">
                                            <rect width="3" height="3" fill="#C9184A" />
                                            <rect y="12" width="3" height="3" fill="#C9184A" />
                                            <rect y="6" width="3" height="3" fill="#C9184A" />
                                            <rect x="6" width="13" height="3" fill="#C9184A" />
                                            <rect x="6" y="12" width="13" height="3" fill="#C9184A" />
                                            <rect x="6" y="6" width="16" height="3" fill="#C9184A" />
                                        </svg>
                                        <h2>CHƯƠNG MỚI NHẤT</h2>
                                    </div>
                                    <div class="list-chapter grid grid-cols-2 gap-1">
                                        @php
                                            $halfCount = ceil($rowChapterNew->count() / 2);
                                            $firstHalf = $rowChapterNew->take($halfCount);
                                            $secondHalf = $rowChapterNew->slice($halfCount);
                                        @endphp

                                        <div>
                                            @foreach ($firstHalf as $k => $v)
                                                @component('component.novel.chapterItem', ['item' => $v])
                                                @endcomponent
                                            @endforeach
                                        </div>
                                        <div>
                                            @foreach ($secondHalf as $k => $v)
                                                @component('component.novel.chapterItem', ['item' => $v])
                                                @endcomponent
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($rowChapter->isNotEmpty())
                                <div class="box-chapter">
                                    <div class="title-chapter flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="15"
                                            viewBox="0 0 22 15" fill="none">
                                            <rect width="3" height="3" fill="#C9184A" />
                                            <rect y="12" width="3" height="3" fill="#C9184A" />
                                            <rect y="6" width="3" height="3" fill="#C9184A" />
                                            <rect x="6" width="13" height="3" fill="#C9184A" />
                                            <rect x="6" y="12" width="13" height="3" fill="#C9184A" />
                                            <rect x="6" y="6" width="16" height="3" fill="#C9184A" />
                                        </svg>
                                        <h2>DANH SÁCH CHƯƠNG</h2>
                                    </div>
                                    <div class="list-chapter grid grid-cols-2 gap-1">
                                        @php
                                            $halfCount = ceil($rowChapter->count() / 2);
                                            $firstHalf = $rowChapter->take($halfCount);
                                            $secondHalf = $rowChapter->slice($halfCount);
                                        @endphp

                                        <div>
                                            @foreach ($firstHalf as $k => $v)
                                                @component('component.novel.chapterItem', ['item' => $v])
                                                @endcomponent
                                            @endforeach
                                        </div>

                                        <div>
                                            @foreach ($secondHalf as $k => $v)
                                                @component('component.novel.chapterItem', ['item' => $v])
                                                @endcomponent
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="right cover-ranking-1 ranking-detail">
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
                                                        <img src="assets/images/TempImages/ico-view-black.png"
                                                            alt="">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-3">
            @component('component.comment.comment', ['rowDetail' => $rowDetail])
            @endcomponent
        </div>


        <div class="modal fade" id="modalDonate" tabindex="-1" aria-labelledby="modalDonateLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header relative">
                        <h5 class="modal-title w-full" id="modalDonateLabel">
                            <div class="title-main text-center w-full mb-0">
                                <span>
                                    ỦNG HỘ CHÚNG TỚ
                                </span>
                            </div>
                        </h5>
                        <button type="button" class="btn-close absolute top-3 right-3" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="donate" method="post">
                        <div class="modal-body">

                            <input type="hidden" name="id_product" value="{{ $rowDetail->id }}">
                            <input type="hidden" name="id_author" value="{{ $rowDetail->id_member }}">

                            <input type="hidden" name="id_member"
                                value="{{ Auth::guard('member')->check() ? Auth::guard('member')->user()->id : '' }}">
                            <div class="form-group">
                                <input type="number" id="input-donate" class="form-control" name="number_flower"
                                    placeholder="Số hoa ủng hộ">
                            </div>
                            <div class="donate-desc mt-3" data-user-coin = '{{ $userLogin->coin }}'>
                                Bạn còn <span class="text-danger">{{ $userLogin->coin }}</span> hoa.
                            </div>
                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="recaptcha_response_donate" id="recaptchaResponseDonate">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
