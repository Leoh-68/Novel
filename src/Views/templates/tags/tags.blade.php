@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3">
            <div class="title-detail title-main !text-center">
                <h1>{{ $titleMain }}</h1>
            </div>
            @if ($itemTags->isNotEmpty())
                <div class="flex items-center flex-wrap gap-2">
                    @foreach ($itemTags as $k => $v)
                        <div class="tags-detail" style="--tag-color: {{ $v->color }}">
                            <a href="{{ $v->slugvi }}" class=" text-decoration-none ">
                                {{ $v->namevi }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Không tìm thấy kết quả</strong>
                </div>
            @endif
        </div>
    </section>
@endsection
