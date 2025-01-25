@php

    $rowReplies = $params->getReplies()->get();
    $album = Comment::photo($params['id'], $params['type']);
@endphp

<div class="comment-item ">
    <div class="comment-item-poster">
        @if (!empty($params['id_user']))
            <div class="comment-item-avatar text-center">
                <div class="inline-block rounded-full overflow-hidden">
                    <img src="{{ assets_photo('user', '65x65x1', $params->getUser()->first()->avatar, 'thumbs') }}"
                        alt="">
                </div>

            </div>
        @else
            <div class="comment-item-letter">{{ Comment::subName($params['fullname']) }}</div>
        @endif

    </div>

    <div class="comment-item-information">
        <div class="comment-cover-info flex items-center gap-2">
            <div class="comment-item-name">{{ $params['fullname'] }}</div>
            |
            <div class="comment-item-posttime">{{ Comment::timeAgo($params['date_posted']) }}</div>
        </div>

        <div class="comment-item-content mb-2">{{ nl2br(Func::decodeHtmlChars($params['content'])) }}
        </div>

        <a class="btn-reply-comment d-inline-block align-top text-decoration-none text-primary mb-2"
            href="javascript:void(0)" data-name="{{ $params['fullname'] }}">Trả lời</a>

        @if (!empty($params['photo']) || !empty($params['video']) || !empty($album))
            @component('component.comment.media', ['params' => $params, 'album' => $album])
            @endcomponent
        @endif

        @if ($rowReplies->isNotEmpty())
            <!-- Replies -->
            <div class="comment-replies mt-3">
                @component('component.comment.replies', ['params' => $rowReplies])
                @endcomponent

            </div>
        @endif
        @component('component.comment.reply', ['params' => $params])
        @endcomponent
    </div>
</div>
