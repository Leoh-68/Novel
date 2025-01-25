@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3">
            <div class="title-main">
                <span>{{ $titleMain }}</span>
                {{-- <div class="filter"><i class="fa-solid fa-filter"></i>&nbsp; Lọc </div> --}}
            </div>
            <div class="flex-product-main">
            @if (!empty($listProperties) && $listProperties->isNotEmpty())
                <div class="left-product">
                        @foreach ($listProperties as $list)
                            <div class="wr-search p-0">
                                <p class="text-split transition">{{ $list[0]['namevi'] }}</p>
                                <ul class="p-0">
                                    @foreach ($list[1] as $key => $value)
                                        @php
                                            $listP = $list[0]['slugvi'];
                                            $arrayC = !empty(Request()->$listP) ? explode(',', Request()->$listP) : [];
                                        @endphp
                                        <li class="item-search mb-2">
                                            <input {{ in_array($value['id'], $arrayC) ? 'checked' : '' }}
                                                class="ip-search mx-2" id="{{ $list[0]['slugvi'] }}-{{ $list[0]['id'] }}"
                                                type="checkbox" data-list="{{ $list[0]['slugvi'] }}" name="ip-search"
                                                value="{{ $value['id'] }}">
                                            <label for="{{ $list[0]['id'] }}">{{ $value['namevi'] }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    <input type="hidden" name="url" class="url-search" value="{{ Request()->url() }}" />
                </div>
            @endif
                <div class="right-product {{!empty($listProperties)? '':'w-100'}}">
                    @if (!empty($product))
                        <div class="grid-product">
                            @foreach ($product as $v)
                                @component('component.itemProduct', ['product' => $v,'diffHome'=>true])
                                @endcomponent
                            @endforeach
                        </div>
                    @endif
                    {!! $product->appends(request()->query())->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection