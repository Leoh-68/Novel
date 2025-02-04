@foreach ($params as $v_reply)
    <div class="comment-replies-item flex items-center gap-2">
        @if (!empty($v_reply['id_user']))
            <div class="comment-item-avatar text-center">
                <div class="inline-block rounded-full overflow-hidden">
                    <img src="{{ assets_photo('user', '45x45x1', $v_reply->getUser()->first()->avatar, 'thumbs') }}"
                        alt="">
                </div>
            </div>
        @else
            <div class="comment-replies-letter {{ $v_reply['poster'] }}">{{ Comment::subName($v_reply['fullname']) }}
            </div>
        @endif

        <div class="comment-replies-info ">
            <div class="flex items-center gap-2">
                <div class="comment-replies-name ">{{ $v_reply['fullname'] }}
                </div>
                |
                <span
                    class="font-weight-normal small text-muted mx-2">{{ Comment::timeAgo($v_reply['date_posted']) }}</span>
                @if ($v_reply['poster'] == 'admin')
                    <span class="font-weight-normal text-info ml-2">(Phản hồi bởi Quản trị viên)</span>
                @elseif ($v_reply['poster'] == 'author')
                    <span class="font-weight-normal text-info ml-2">(Phản hồi bởi tác giả)</span>
                @endif

            </div>

            <div class="comment-replies-content">{{ nl2br(Func::decodeHtmlChars($v_reply['content'])) }}</div>
        </div>
    </div>
@endforeach
@if (count($params) > 1)
    <p class="view-more-replies">&#10551; Xem tất cả {{ count($params) }} bình luận</p>
@endif
