<div class="menu-res !bg-main-b">
    <div class="menu-bar-res">
        <a id="hamburger" href="#menu" title="Menu"><span></span></a>
        <div class="header-logo mobile">
            <a href="" class=" text-decoration-none flex items-center gap-2">
                @component('component.tool.image', [
                    'folder' => 'photo',
                    'type' => 'logo',
                    'item' => $logoPhoto,
                    'thumb' => '57x57x1',
                    'effect' => 'none-eff',
                    'class' => 'none-clss',
                ])
                @endcomponent
                <div class="info">
                    <p>CHỢ TÂN BÌNH</p>
                    <SPAN>
                        Online Market
                    </SPAN>
                </div>
            </a>
        </div>
        <div class="dropdown">
            <i class="fas fa-user" role="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @if ($usernamelogin == 'nologin')
                <li><a class="dropdown-item" href="{{ url('member.registration') }}">Đăng ký gian hàng</a></li>
                <li><a class="dropdown-item" href="{{ url('member.login') }}">Đăng nhập</a></li>
                @else
                <li><a class="dropdown-item" href="{{ url('member.man') }}">Hi, {{ $usernamelogin }}</a></li>
                <li><a class="dropdown-item" href="{{ url('member.logout') }}">Đăng xuất</a></li>
                @endif
            </ul>
        </div>
        <div class="search-res">
            <p class="icon-search transition"><i class="fa fa-search"></i></p>
            <div class="search-grid w-clear">
                <input type="text" name="keyword-res" id="keyword-res" placeholder="Nhập từ khóa tìm kiếm"
                    onkeypress="doEnter(event,'keyword-res');" />
                <p onclick="onSearch('keyword-res');"><i class="fa fa-search"></i></p>
            </div>
        </div>
    </div>
    <nav id="menu">
        <ul class="menu-mobile-ul">
            <li><a class=" @if (($com ?? '') == 'trang-chu') active @endif transition" href=""
                title="Trang chủ">Trang chủ</a></li>
            </li>
            <li>
                <a href="san-pham">Sản phẩm</a>
                @if ($listProductMenu->isNotEmpty())
                <ul class="{{ ($com ?? '') == 'trang-chu' ? 'ul-spec ul-product' : '' }} ">
                    @foreach ($listProductMenu ?? [] as $vlist)
                        <li>
                            <a class="transition !flex items-center justify-between gap-2"
                                href="{{ url('slugweb', ['slug' => $vlist['slugvi']]) }}"title="{{ $vlist['namevi'] }}">
                                {{ $vlist['namevi'] }}
                            </a>
                            @if ($vlist->getCategoryCats()->get()->isNotEmpty())
                                <ul>
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
            <li>
                <a class=" @if (($com ?? '') == 'gioi-thieu') active @endif transition" href="gioi-thieu"
                    title="Giới thiệu">Giới thiệu</a>
                </li>
            </li>
            <li>
                <a class=" @if (($com ?? '') == 'dich-vu') active @endif transition" href="dich-vu" title="Dịch vụ">Dịch
                    vụ</a></li>
            </li>
            <li><a class=" @if (($com ?? '') == 'tin-tuc') active @endif transition" href="tin-tuc" title="Tin tức">Tin
                    tức</a></li>
            </li>
            <li><a class=" @if (($com ?? '') == 'lien-he') active @endif transition" href="lien-he" title="Liên hệ">Liên
                    hệ</a></li>
        </ul>
    </nav>
</div>