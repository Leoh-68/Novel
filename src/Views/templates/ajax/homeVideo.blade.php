@if (!empty($video))
    <iframe width="100%" height="100%" src="//www.youtube.com/embed/{{ Func::getYoutube($video['link_video']) }}"
        frameborder="0" allowfullscreen></iframe>
@endif
