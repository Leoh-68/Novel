@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3">
            <div class="title-detail title-main !text-center">
                <h1>{{ $titleMain }}</h1>
                {{-- <div class="filter"><i class="fa-solid fa-filter"></i>&nbsp; Lọc </div> --}}
            </div>
            <div class="right-product {{ !empty($listProperties) ? '' : 'w-100' }}">
                @if (!empty($product))
                    <div class="grid-product">
                        @foreach ($product as $v)
                            @component('component.itemProduct', ['product' => $v])
                            @endcomponent
                        @endforeach
                    </div>
                @endif
             {!! $product->appends(request()->query())->onEachSide(3)->links() !!}
            </div>
        </div>
    </section>
@endsection
