@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3 mt-4">
            @if (!empty($rowDetail))
                <div class="title-detail">
                    <h1><?= $rowDetail->namevi ?></h1>
                </div>
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                <div class="content-main baonoidung w-clear" id="toc-content"> {!! Func::decodeHtmlChars($rowDetail['contentvi']) !!}</div>
                <div class="share">
                    <b>Chia sẻ:</b>
                    <div class="social-plugin w-clear">
                        @component('component.share')
                        @endcomponent
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Đang cập nhật dữ liệu</strong>
                </div>
            @endif
        </div>
    </section>
    <section>
        <div class="max-width py-3">
            <div class="title-main">
                <span>Bài viết liên quan</span>
            </div>
            @if (!empty($news))
                <div class="grid-product">
                    @foreach ($news as $v)
                        @component('component.itemNews', ['news' => $v])
                        @endcomponent
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
@pushOnce('scripts')
    <script src="@asset('assets/toc/toc.js')"></script>
    <script>
        if (isExist($('.toc-list'))) {
            $('.toc-list').toc({
                content: 'div#toc-content',
                headings: 'h2,h3,h4'
            });
            if (!$('.toc-list li').length) $('.meta-toc').hide();
            if (!$('.toc-list li').length) $('.meta-toc .mucluc-dropdown-list_button').hide();
            $('.toc-list')
                .find('a')
                .click(function () {
                    var x = $(this).attr('data-rel');
                    goToByScroll(x);
                });
            $('body').on('click', '.mucluc-dropdown-list_button', function () {
                $('.box-readmore').slideToggle(200);
            });
            $(document).scroll(function () {
                var y = $(this).scrollTop();
                if (y > 300) {
                    $('.meta-toc').addClass('fiedx');
                } else {
                    $('.meta-toc').removeClass('fiedx');
                }
            });
        }
    </script>
@endPushOnce