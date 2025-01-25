@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3">
            <div class="title-detail title-main !text-center">
                <h1>{{ $titleMain }}</h1>
            </div>
            @if ($news->isNotEmpty())
                <div class="row">
                    @foreach ($news as $k => $v)
                        <div class="col-12 col-lg-4 col-md-4 col-sm-6 mb-3">
                            @component('component.itemNews', ['news' => $v])
                                <div class="desc-news line-clamp-3 mt-1">{{ $v->descvi }}</div>
                            @endcomponent
                        </div>
                    @endforeach
                </div>
                {!! $news->links() !!}
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Không tìm thấy kết quả</strong>
                </div>
            @endif
        </div>
    </section>
@endsection