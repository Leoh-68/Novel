<div class="header z-100">
    <div class="wrap-content grid grid-cols-3 items-center gap-4 ">
        <div class="header-search">
            <div class="search flex items-center justify-between">
                <input type="text" id="keyword" class="w-100 search-auto" placeholder="Nhập từ khóa"
                    onkeypress="doEnter(event,'keyword');">
                <p class="mb-0 flex items-center gap-2  " onclick="onSearch('keyword');">
                    <span>
                        Tìm kiếm
                    </span>
                    <img src="assets/images/TempImages/ico-search.png" alt="">
                </p>
            </div>
        </div>
        <div class="header-logo  text-center">
            <a href="" class="text-decoration-none">
                @component('component.tool.image', [
                    'folder' => 'photo',
                    'type' => 'logo',
                    'item' => $logoPhoto,
                    'effect' => 'none-eff',
                    'class' => 'none-clss',
                    'aspect' => 'noAspect',
                ])
                @endcomponent

            </a>
        </div>
        <div class="header-login">
            <div class="user-header flex items-center justify-end gap-2">

                @if ($usernamelogin == 'nologin')
                    <a class=" spec" href="{{ url('member.registration') }}">
                        <img src="assets/images/TempImages/ico-not.png" alt="">
                        <span>Đăng ký</span>
                    </a>

                    <a class="" href="{{ url('member.login') }}">
                        <img src="assets/images/TempImages/ico-logout.png" alt="">
                        <span>Đăng nhập</span>
                    </a>
                @else
                    <a class="relative" href="{{ url('member.man') }}">
                        <i class="fa-light fa-user"></i>
                        <span>Hi, {{ $usernamelogin }}</span>
                        @if ($newsChapterUpdate->isnotempty())
                            <span class="noti-dot animate__pulse">
                            </span>
                        @endif
                    </a>
                    <a href="{{ url('member.logout') }}">
                        <span>Đăng xuất</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="wrap-menu">
    @include('layout.menu')
    @include('layout.mmenu')
</div>
