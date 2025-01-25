<footer>
    <div class="wrap-footer">
        <div class="footer-top padding-main">
            <div class="wrap-content">
                <span class="text-center">
                    {{ $sloganFooter->descvi }}
                </span>
            </div>
        </div>
        <div class="footer-middle padding-main">
            <div class="wrap-content">
                <div class="cover-footer-content flex justify-between flex-wrap">
                    <div class="footer-news w-full lg:w-[35%]">
                        <div class="footer-logo">

                            @component('component.tool.image', [
                                'folder' => 'photo',
                                'type' => 'logo',
                                'item' => $logoPhoto,
                                'thumb' => '185x135x1',
                                'effect' => 'noEffect',
                                'aspect' => 'noAspect',
                                'class' => 'noClass',
                            ])
                            @endcomponent
                        </div>

                        <div class="footer-desc">
                            <p class="line-clamp-4">
                                {{ $footer->descvi }}
                            </p>
                        </div>
                    </div>
                    <div class="footer-news w-full lg:w-[20%]">
                        <div class="footer-title">
                            <span>
                                Hỗ trợ
                            </span>
                        </div>
                        <div class="footer-ul">
                            <ul>
                                @foreach ($policyHome as $item)
                                    <li>
                                        <a href="{{ $item->slugvi }}" class=" text-decoration-none ">
                                            {{ $item->namevi }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="footer-news w-full lg:w-[25%]">
                        <div class="footer-title">
                            <span>
                                Đăng ký nhận thông báo
                            </span>
                        </div>
                        <div class="footer-slogan-form">
                            <span>
                                Vui lòng để lại Email của bạn, chúng tôi sẽ gửi thông báo mới nhất
                            </span>
                        </div>
                        <form id="form-newsletter" class="validation-newsletter check-form flex items-cenrer"
                            method="post" action="dang-ky-nhan-tin-post" enctype="multipart/form-data">
                            <div class="form-group form-col-cus2">
                                <input type="text" name="dataNewsletter[email]" class="form-control"
                                    id="email-newsletter" placeholder="Email" required>
                            </div>
                            <div class="dk-button">
                                <input type="hidden" name="dataNewsletter[type]" value="dang-ky-nhan-tin" />
                                <input type="hidden" name="csrf_tokeqn" value="{{ csrf_token() }}">
                                <input type="hidden" name="loaidata" value="dataNewsletter">
                                <input type="submit" data-type="newsletter" class="check-btn " name="submit-newsletter"
                                    value="Gửi" />
                                <input type="hidden" name="recaptcha_response_newsletter"
                                    id="recaptchaResponseNewsletter">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-connect text-center padding-main">

            <div class="title">
                <span>
                    KẾT NỐI HỒNG CHI CÁC
                </span>
            </div>

            <div class="footer-social">
                <div class="social flex items-center justify-center gap-1">
                    @foreach ($social as $item)
                        <a href="{{ $item['link'] }}" target="_blank">
                            <img onerror="this.src='{{ assets_photo('photo', '45x45x1', 'noimage.png', 'thumbs') }}';"
                                src="{{ assets_photo('photo', '45x45x1', $item->photo, 'thumbs') }}"
                                alt="{{ $item->namevi }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- 
    @if ($tags->isNotEmpty())
        <div class="footer-tags">   
            <div class="wrap-content py-[15px]">
                <p class="title-tags">Từ khóa sản phẩm</p>
                <div class="flex-tags">
                    @foreach ($tags as $v)
                        <a href="{{ $v['slugvi'] }}" title="{{ $v['namevi'] }}">{{ $v['namevi'] }}</a>
                    @endforeach
                </div>
            </div>  
        </div>
    @endif 
    --}}
    <div class="footer-powered bg-[#2C9C35] text-center">
        <div class="wrap-content text-white py-[15px] flex items-center justify-center flex-wrap lg:justify-between">
            <p class="copyright   text-[14px] mb-0">{{ $setting['namevi'] }}
                All rights reserved. Designed by nina.vn
            </p>
            <span class="stat flex items-center justify-center gap-2">
                <span>
                    Đang online : {{ Statistic::getOnline() }}
                </span>
                |
                <span>
                    Hôm nay : {{ Statistic::getTodayRecord() }}
                </span>
                |
                <span>
                    Tuần này : {{ Statistic::getWeekRecord() }}
                </span>
                |
                <span>
                    Tháng này : {{ Statistic::getMonthRecord() }}
                </span>
            </span>
        </div>
    </div>
</footer>
