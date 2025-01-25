<div class="com-fanpage">
    <div class="hidden lg:block">
        <div class="fb-page" data-href="{{ $fanpage }}" data-tabs="timeline" data-width="300" data-height="200"
        data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="{{ $fanpage }}" class="fb-xfbml-parse-ignore">
            <a href="{{ $fanpage }}">Facebook</a>
            </blockquote>
        </div>
    </div>
    <div class="block lg:hidden">
        <a href="{{ $fanpageCom->link }}" class=" text-decoration-none ">
            <img onerror="this.src='{{ thumbs('thumbs/300x200x1/assets/images/noimage.png') }}';"
            src="{{ assets_photo('photo', '300x200x1', $fanpageCom['photo'], 'thumbs') }}"
            alt="{{ $fanpageCom['namevi'] }}">
        </a>
    </div>
</div>
