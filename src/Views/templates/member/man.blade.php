 @push('styles')
     <link rel="stylesheet" href="@asset('assets/css/member.css')">
 @endpush
 @extends('layout')
 @section('content')
     <div class="wrap-member-man padding-main">
         <div class="wrap-content">
             <div class="row" style="--bs-gutter-x: 15px;">
                 <div class="col-12 col-lg-3 sticky top-[50px]">
                     <div class="member-man-left">
                         <div class="cover-item">
                             <a href="{{ url('member.info') }}" class="text-decoration-none text-black">
                                 <div class="info-place flex items-center gap-3">
                                     <div class="avt shrink-0 w-[100px] h-[100px] rounded-full overflow-hidden">
                                         <img onerror="this.src='{{ thumbs('thumbs/100x100x1/assets/images/noimage.png.webp') }}';"
                                             src="{{ assets_photo('user', '100x100x1', $rowDetail['avatar'], 'thumbs') }}"
                                             alt="{{ $rowDetail['fullname'] }}">
                                     </div>
                                     <div class="info">
                                         <div class="name">
                                             <span>{{ $rowDetail['fullname'] }}</span>
                                         </div>
                                         <div class="email">
                                             <span>{{ $rowDetail['email'] }}</span>
                                         </div>
                                         <div class="phone">
                                             <span>{{ $rowDetail['phone'] }}</span>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="cover-item-tab">
                             <div class="title">
                                 <span>
                                     QUẢN LÝ
                                 </span>
                             </div>

                             <div class="item-tab">
                                 <div class="item">
                                     <a href="{{ url('member.info') }}"
                                         class=" text-decoration-none flex items-center gap-2 ">
                                         <div class="ico">
                                             <i class="fa fa-user"></i>
                                         </div>

                                         <span>Thông tin cá nhân</span>
                                     </a>
                                 </div>
                                 @if ($rowDetail['type'] != 'reader')
                                     <div class="item">
                                         <a href="{{ url('memberHome.list', ['com' => 'product', 'act' => 'list', 'type' => 'truyen']) }}"
                                             class=" text-decoration-none flex items-center gap-2 ">
                                             <div class="ico">
                                                 <i class="fa-solid fa-store"></i>
                                             </div>

                                             <span>Truyện đã đăng</span>
                                         </a>
                                     </div>
                                     <div class="item">
                                         <a href="{{ url('memberHome.upload', ['com' => 'product', 'act' => 'add', 'type' => 'truyen']) }}"
                                             class=" text-decoration-none flex items-center gap-2 ">
                                             <div class="ico">
                                                 <i class="fa-solid fa-upload"></i>
                                             </div>
                                             <span>Thêm truyện mới</span>
                                         </a>
                                     </div>
                                 @endif
                                 <div class="item">
                                     <a href="{{ url('memberHome.book-shelf', ['com' => 'product', 'act' => 'list', 'type' => 'truyen']) }}"
                                         class="relative text-decoration-none flex items-center gap-2 ">
                                         <div class="ico">
                                             <i class="fa-solid fa-store"></i>
                                         </div>
                                         <span>Kệ sách</span>
                                         @if ($newsChapterUpdate->isnotempty())
                                             <span class="noti-dot animate__pulse">

                                             </span>
                                         @endif
                                     </a>
                                 </div>
                                 @if ($rowDetail['type'] != 'reader')
                                     <div class="item">
                                         <a href="{{ url('memberHome.comment', ['com' => 'comment', 'act' => 'list', 'type' => 'comment']) }}"
                                             class="relative text-decoration-none flex items-center gap-2 ">
                                             <div class="ico">
                                                 <i class="fa-solid fa-comment"></i>
                                             </div>
                                             <span>
                                                 Quản lý bình luận
                                             </span>

                                             @if (!empty(Comment::countReplyByUser(Auth::guard('member')->user()->id)))
                                                 <span class="noti-dot animate__pulse">

                                                 </span>
                                             @endif
                                         </a>
                                     </div>
                                 @endif
                             </div>
                             @if ($rowDetail['type'] != 'reader')
                                 <div class="cover-tag-info">
                                     <div class="row  items-stretch" style="--bs-gutter-x: 15px;">
                                         <div class="col-12 mt-3">
                                             <div class="info-tag h-full">
                                                 <div class="title">
                                                     <span>
                                                         Số truyện đã đăng
                                                     </span>
                                                 </div>
                                                 <div class="info">
                                                     <span>
                                                         {{ Func::counterProductMember(Auth::guard('member')->user()->id) ?? 0 }}
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-lg-9">
                     <div class="member-man-right">
                         <div class="banner mb-3">

                             <img onerror="this.src='{{ thumbs('thumbs/1200x300x1/assets/images/noimage.png.webp') }}';"
                                 src="{{ assets_photo('user', '1200x300x1', $rowDetail['banner'], 'thumbs') }}"
                                 alt="">
                         </div>
                         <div class="title">
                             <span>
                                 Truyện đã đăng
                             </span>
                         </div>
                         @php
                             $productUploaded = Func::getProductMember(Auth::guard('member')->user()->id)
                                 ->limit(8)
                                 ->get();
                         @endphp
                         @if (!empty($productUploaded))
                             <div class="cover-list-product">
                                 <div class="grid grid-cols-4 gap-[20px]">
                                     @foreach ($productUploaded as $v)
                                         @component('component.itemProduct', ['product' => $v])
                                         @endcomponent
                                     @endforeach
                                 </div>
                             </div>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
