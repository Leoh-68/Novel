@push('styles')
        {!! cssminify()->set('css/menu/menu_logo_center.css'); !!}
@endpush
<div class="header-menu flex gap-8 items-center justify-between">
    <div class="header-left lg:w-[42%]">
        <div class="bottom">
            <div class="menu">
                <ul class="menu-main" id="menu-main">
                    <li><a class=" @if ($com == '') active @endif transition" href=""
                            title="Trang chủ">Trang chủ</a></li>
                    <li><a class=" @if ($com == 'gioi-thieu') active @endif transition" href="gioi-thieu"
                            title="Giới thiệu">Giới thiệu</a></li>
                    <li>
                        <a class="has-child {{ $com == 'dich-vu' ? 'active' : '' }} transition" href="dich-vu"
                            title="Dịch vụ">Dịch vụ</a>
                        {{-- @if (!empty($listNewsMenu))
                            <ul>
                                @foreach ($listNewsMenu as $klist => $vlist)
                                    <li>
                                        <a class="has-child transition" title="{{ $vlist['namevi'] }}"
                                            href="{{ $vlist['slugvi'] }}">{{ $vlist['namevi'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif --}}
                    </li>
                    <li><a class=" @if ($com == 'san-pham') active @endif transition" href="san-pham"
                            title="Sản phẩm">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-mid lg:w-[15%] relative z-[10] my-[-30px]  text-center">
        <a class="logo-header peShine inline-block" href="">
            <img onerror="this.src='{{ thumbs('thumbs/160x160x1/assets/images/noimage.png') }}';"
                src="{{ assets_photo('photo', '160x160x1', $logoPhoto->photo, 'thumbs') }}"
                alt="{{ $setting->namevi }}">
        </a>
    </div>
    <div class="header-right lg:w-[42%]">
        <div class="bottom">
            <div class="menu">
                <ul class="menu-main" id="menu-main">
                    <li><a class=" @if ($com == 'dao-tao-hoc-vien') active @endif transition" href="dao-tao-hoc-vien"
                            title="Đào tạo học viên">Đào tạo học viên</a></li>
                    <li><a class=" @if ($com == 'cong-tac-vien') active @endif transition" href="cong-tac-vien"
                            title="Cộng tác viên">Cộng tác viên</a></li>
                    <li><a class=" {{ ($com ?? '') == 'lien-he' ? 'active' : '' }} transition" href="lien-he"
                            title="liên hệ">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
