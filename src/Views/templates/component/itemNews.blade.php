
    <div class="item news-home">
        <div class="news-item hover-box">
            <div class="news-home-img">
                <a href="{{ $news->slugvi }}" class="text-decoration-none ">
                    @component('component.tool.image', [
                        'folder' => 'news',
                        'type' => $news->type,
                        'item' => $news,
                        'class' => 'w-100',
                    ])
                    @endcomponent
                </a>
            </div>
            <div class="news-home-info hover-info">
                <a href="{{ $news->slugvi }}" class="text-decoration-none ">
                    <div class="date">
                        <span class="day">
                            {{ \Carbon\Carbon::parse($news->created_at)->format('d') }}
                        </span>
                        <span>
                            Tháng
                            {{ \Carbon\Carbon::parse($news->created_at)->format('m/Y') }}
                        </span>
                    </div>
                    <div class="name hover-name">
                        <span class="line-clamp-2">
                            {{ $news->namevi }}
                        </span>
                    </div>
                    <div class="news-wm flex items-center gap-2">
                        <span>
                            Xem thêm
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
