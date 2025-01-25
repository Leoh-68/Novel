@php
    $rowComment = $rowDetail->getComment()->skip(0)->take(2)->get();
    $countComment = $rowDetail->getComment()->count();
@endphp
<div class="wrap-content">
    <div class="comment-page">


        <!-- Write comment -->
        <div class="comment-write comment-show mb-4" id="comment-write">
            <div class="">
                <div class=" flex items-center gap-2">
                    <img src="assets/images/TempImages/ico-comment.png" alt="">
                    <span> Nhận xét về <strong> {{ $rowDetail['name' . $lang] }}</strong></span>
                </div>

                <form id="form-comment" action="" method="post" enctype="multipart/form-data">
                    <div class="response-review"></div>
                    <div class="row">
                        <div class="col-12 col-lg-12">

                            <div class="form-group mb-2 mt-4">
                                <textarea class="form-control text-sm" name="dataReview[content]" id="review-content" placeholder="Nhận xét của bạn *" rows="11">
                                </textarea>
                            </div>

                            <div class="form-group mb-2 hidden">
                                <div class="row row-10">
                                    <div class="col-4 mg-col-10">
                                        <input type="text" class="form-control text-sm" name="dataReview[id_user]"
                                            id="review-id_user" placeholder="Số điện thoại *"
                                            value="{{ Auth::guard('member')->user()->id }}">
                                    </div>
                                    <div class="col-4 mg-col-10">
                                        <input type="text" class="form-control text-sm" name="dataReview[fullname]"
                                            id="review-fullname" placeholder="Họ tên *"
                                            value="{{ Auth::guard('member')->user()->fullname }}">
                                    </div>
                                    <div class="col-4 mg-col-10">
                                        <input type="text" class="form-control text-sm" name="dataReview[phone]"
                                            id="review-phone" placeholder="Số điện thoại *"
                                            value="{{ Auth::guard('member')->user()->phone }}">
                                    </div>
                                    <div class="col-4 mg-col-10">
                                        <input type="text" class="form-control text-sm" name="dataReview[email]"
                                            id="review-email" placeholder="Email *"
                                            value="{{ Auth::guard('member')->user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-comment btn-success  text-capitalize py-2 px-3">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>
                                Gửi bình luận
                            </span>
                        </div>
                    </button>

                    <input type="hidden" name="dataReview[id_variant]" value="{{ $rowDetail['id'] }}">
                    <input type="hidden" name="dataReview[type]" value="{{ $rowDetail['type'] }}">
                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>

        <!-- Lists comment -->

        @if ($rowComment->isNotEmpty())
            <div class="comment-lists">
                <div class="card">
                    <div class="card-header text-uppercase"><strong>Các bình luận khác</strong></div>
                    <div class="card-body pt-5 pb-3">
                        <div class="comment-load">
                            @foreach ($rowComment as $v_lists)
                                @php $v_lists['name'] = $rowDetail['namevi']; @endphp
                                @component('component.comment.lists', ['params' => $v_lists])
                                @endcomponent
                            @endforeach
                        </div>
                        @if ($countComment > 2)
                            <div class="comment-load-more-control text-center mt-4">
                                <form id="form-load-comment" action="" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="dataLoad[limit]" id="load-comment-limit" value="2">
                                    <input type="hidden" name="dataLoad[id]" value="{{ $rowDetail['id'] }}">
                                    <input type="hidden" name="dataLoad[type]" value="{{ $rowDetail['type'] }}">
                                    <input type="hidden" name="dataLoad[count]" id="load-comment-count"
                                        value="{{ $countComment }}">
                                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                    <button type="submit"
                                        class="comment-more btn btn-sm btn-primary rounded-0 w-100 font-weight-bold py-2 px-3"
                                        title="Tải thêm bình luận">Tải thêm bình luận</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
    <link href="assets/css/comment.css" rel="stylesheet">
    <link href="assets/fileuploader/font-fileuploader.css" rel="stylesheet">
    <link href="assets/fileuploader/jquery.fileuploader.min.css" rel="stylesheet">
    <link href="assets/fileuploader/jquery.fileuploader-theme-dragdrop.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="assets/js/comment.js"></script>
    <script src="assets/fileuploader/jquery.fileuploader.min.js"></script>
@endpush
