<form class="mt-3" id="form-reply" action="" method="post" enctype="multipart/form-data">
    <div class="response-reply"></div>
    <div class="form-group mb-2">
        <textarea class="form-control text-sm" placeholder="Viết câu trả lời của bạn" name="dataReview[content]" id="reply-content"
            data-name="@{{ $params['fullname'] }}:" rows="5"></textarea>
    </div>
    <div class="form-group">
        <div class="row row-10">
            <div class="col-4 mg-col-10 hidden">
                <input type="text" class="form-control text-sm" name="dataReview[id_user]" id="review-id_user"
                    placeholder="Số điện thoại *" value="{{ Auth::guard('member')->user()->id }}">
            </div>
            <div class="col-4 mg-col-10">
                <input type="text" class="form-control text-sm" name="dataReview[fullname]" id="review-fullname"
                    placeholder="Họ tên *" value="{{ Auth::guard('member')->user()->fullname }}">
            </div>
            <div class="col-4 mg-col-10">
                <input type="text" class="form-control text-sm" name="dataReview[phone]" id="review-phone"
                    placeholder="Số điện thoại *" value="{{ Auth::guard('member')->user()->phone }}">
            </div>
            <div class="col-4 mg-col-10">
                <input type="text" class="form-control text-sm" name="dataReview[email]" id="review-email"
                    placeholder="Email *" value="{{ Auth::guard('member')->user()->email }}">
            </div>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-sm btn-warning me-2 py-2 px-3">Gửi trả lời</button>
        <button type="button" class="btn btn-sm btn-secondary btn-cancel-reply py-2 px-3">Hủy bỏ</button>
    </div>
    <input type="hidden" name="dataReview[id_parent]" value="{{ $params['id'] }}">
    <input type="hidden" name="dataReview[id_variant]" value="{{ $params['id_variant'] }}">
    <input type="hidden" name="dataReview[type]" value="{{ $params['type'] }}">
    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
</form>
