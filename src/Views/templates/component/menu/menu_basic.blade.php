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
        </li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" @if (($com ?? '') == 'dang-tien-hanh') active @endif transition" href="danh-sach-truyen?status=dang-tien-hanh"
                title="Đang tiến hành">Đang tiến hành</a></li>
        <li class="menu-line">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="18" viewBox="0 0 7 18" fill="none">
                <path d="M0.5 1L5.5 9.53333L0.5 17" stroke="#6A6A6A" />
            </svg>
        </li>
        <li><a class=" @if (($com ?? '') == 'hoan-thanh') active @endif transition" href="danh-sach-truyen?status=hoan-thanh"
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
