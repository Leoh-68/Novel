@if ($productAjax->isNotEmpty())
    <div class="product__list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-3">
        @foreach ($productAjax as $v)
            @component('component.itemProduct', ['product' => $v])
            @endcomponent
        @endforeach
    </div>
    <div class="pagination-product-home">
        {{ $productAjax->appends(request()->query())->links() }}
    </div>
@else
    <div class="alert alert-warning w-100 mt-3 mb-0" role="alert">
        <strong>Không tìm thấy kết quả</strong>
    </div>
@endif 