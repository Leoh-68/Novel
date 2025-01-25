@push('styles')
    {!! cssminify()->set('css/menu/menu_basic.css') !!}
@endpush

<div class="menu">
    <ul class="menu-main" id="menu-main">
        <li>
            <a class=" @if (($com ?? '') == 'trang-chu') active @endif transition" href="" title="Trang chủ">Trang
                chủ</a>
        </li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" @if (($com ?? '') == 'the-loai') active @endif transition" href="the-loai" title="Thể loại">Thể
                loại</a></li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" @if (($com ?? '') == 'truyen') active @endif transition" href="truyen"
                title="Tất cả truyện">Tất cả truyện</a>
            @if ($listProductMenu->isNotEmpty())
                <ul>
                    @foreach ($listProductMenu ?? [] as $vlist)
                        <li>
                            <a class="transition" href="{{ url('slugweb', ['slug' => $vlist['slugvi']]) }}"
                                title="{{ $vlist['namevi'] }}">{{ $vlist['namevi'] }}
                                {!! $vlist->getCategoryCats()->get()->isNotEmpty() ? '<span class="icon-down">&#8250;</span>' : '' !!}</a>
                            @if ($vlist->getCategoryCats()->get()->isNotEmpty())
                                <ul x-show="open" x-transition>
                                    @foreach ($vlist->getCategoryCats()->get() ?? [] as $vcat)
                                        <li>
                                            <a class="transition"
                                                href="{{ url('slugweb', ['slug' => $vcat['slugvi']]) }}"
                                                title="{{ $vcat['namevi'] }}">{{ $vcat['namevi'] }}
                                            </a>
                                            <ul>
                                                @foreach ($vcat->getCategoryItems()->get() ?? [] as $vitem)
                                                    <li>
                                                        <a class="transition"
                                                            href="{{ url('slugweb', ['slug' => $vitem['slugvi']]) }}"
                                                            title="{{ $vitem['namevi'] }}">{{ $vitem['namevi'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" @if (($com ?? '') == 'dang-tien-hanh') active @endif transition" href="dang-tien-hanh"
                title="Đang tiến hành">Đang tiến hành</a></li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" @if (($com ?? '') == 'hoan-thanh') active @endif transition" href="hoan-thanh"
                title="Hoàn thành">Hoàn thành</a>
        </li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" {{ ($com ?? '') == 'bang-xep-hang' ? 'active' : '' }} transition" href="bang-xep-hang"
                title="Bảng xếp hạng">Bảng xếp hạng</a></li>
    </ul>
</div>
