@extends('layout')
@section('content')
    <section x-data>
        <div class="wrap-content padding-main">
            <div class="title-main py-6">
                <h1 class="text-center capitalize  block">{{ $rowDetail['namevi'] }}</h1>
            </div>

            @if ($rowDetailPhoto->isNotEmpty())
                <div class="row album-gallery">
                    @foreach ($rowDetailPhoto as $v)
                        <div class="col-6 col-lg-3 mb-3">
                            <a data-fancybox="gallery" href="{{ assets_photo('product', '', $v['photo']) }}"
                                class="thumb-pro-detail border-[1px] inline-block overflow-hidden rounded-[8px]"
                                title="{{ $v['namevi'] }}"
                                data-image="{{ assets_photo('product', '530x530x1', $v['photo'], 'thumbs') }}"><img
                                    class=" !mb-0 !pb-0 !border-0"
                                    onerror="this.src='{{ thumbs('thumbs/530x530x1/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('product', '530x530x1', $v['photo'], 'thumbs') }}"
                                    alt="{{ $v['namevi'] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-warning w-100" role="alert">
                        <strong>Không tìm thấy kết quả</strong>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
