<div class="product hover-box">
    <a class="text-split text-decoration-none" href="{{ url('slugweb', ['slug' => $product['slugvi']]) }}"
        title="{{ $product['namevi'] }}">
        <div class="pic-product">
            @component('component.tool.image', [
                'folder' => 'product',
                'type' => 'san-pham',
                'item' => $product,
                'class' => '',
            ])
            @endcomponent
        </div>
        <div class="product-info hover-info text-start">
            @php
                $member = Func::getMember($product['id_member']);
            @endphp
            @if (!empty($member))
                <div class="member-product">
                    <span>
                        {{ $member->fullname }}
                    </span>
                </div>
            @endif

            <h3 class="name-product hover-name">
                {{ $product['namevi'] }}
            </h3>
            <p class="price-product flex items-center justify-center gap-2">
                @if (empty($product->regular_price))
                    <span class="price-new price-ct ">Liên hệ</span>
                @else
                    <span class="price-new">{{ Func::formatMoney($product->regular_price) }}</span>
                    -
                    <span class="price-old">{{ Func::formatMoney($product->sale_price) }}</span>
                @endif
            </p>
        </div>
    </a>
</div>
