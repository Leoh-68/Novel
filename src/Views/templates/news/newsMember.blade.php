@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3 mt-4">
            @if (!empty($rowDetail))
                <div class="title-detail text-center">
                    <h1>Danh sách thành viên của {{ ($com ?? '') == 'phan-khu' ? 'Phân khu' : 'Đường' }}
                        {{ $rowDetail->namevi }}</h1>
                </div>

                @if (!empty($listPlace))
                    <div class="row">
                        @foreach ($listPlace as $v)
                            <div class="col-6 col-lg-3">
                                <div class="member_load">
                                    <div class="member_load_item">
                                        <a href="profile/{{ $v->id }}" class=" text-decoration-none ">
                                            <div class="member_load_item_img">
                                                <img onerror="this.src='{{ thumbs('thumbs/500x500x1/assets/images/noimage.png.webp') }}';"
                                                    src="{{ assets_photo('user', '500x500x1', $v->avatar, 'thumbs') }}"
                                                    alt="">
                                            </div>
                                            <div class="member_load_item_name text-center">
                                                {{ $v->fullname }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Đang cập nhật dữ liệu</strong>
                </div>
            @endif
        </div>
    </section>
@endsection
