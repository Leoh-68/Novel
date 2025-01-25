<div class="chapter-item cursor-pointer">
    @php
        $checkOrder = !empty(Auth::guard('member')->user()->id)
            ? Func::checkOrderNovel(Auth::guard('member')->user()->id, $item->id)
            : false;

    @endphp

    @if (in_array('tinhphi', explode(',', $item->status)))

        @if (!$checkOrder)
            <a class="text-decoration-none buynovel" data-idProduct="{{ $item->id }}"
                data-idMember="{{ Auth::guard('member')->user()->id }}"
                data-userCoin="{{ Auth::guard('member')->user()->coin }}" data-novelPrice="{{ $item->novel_price }}">
                @if (!empty($item->novel_price))
                    <span class="novel-price">
                        {{ $item->novel_price }}Xu
                    </span>
                @endif
                <span>
                    Chương {{ $item->numb }}: {{ $item->namevi }}
                </span>
            </a>
        @else
            <a href="{{ $item->slugvi }}" class="text-decoration-none">
                @if (!empty($item->novel_price))
                    <span class="novel-price">
                        {{ $item->novel_price }}Xu
                    </span>
                @endif
                <span>
                    Chương {{ $item->numb }}: {{ $item->namevi }}
                </span>
            </a>
        @endif
    @else
        <a href="{{ $item->slugvi }}" class="text-decoration-none">
            <span>
                Chương {{ $item->numb }}: {{ $item->namevi }}
            </span>
        </a>
    @endif
</div>
