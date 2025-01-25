<h5 class="card-title mb-2">{{ $title }}</h5>
<form action="">
    <div class="input-group input-group-sm">

        {{-- <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm"
            aria-label="Tìm kiếm" value="{{ isset($_GET['keyword']) ? $_GET['keyword'] : '' }}"
            onkeypress="doEnter22(event,'keyword','member/list/product/man/san-pham')"> --}}
        <input class="form-control form-control-navbar text-sm" type="input" name="keyword" id="keyword"
            placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ isset($_GET['keyword']) ? $_GET['keyword'] : '' }}">

        <div class="input-group-append bg-primary rounded-right">
            <button class="btn btn-navbar text-white" type="submit">
                <i class="ti ti-search"></i>
            </button>
        </div>
    </div>
</form>
