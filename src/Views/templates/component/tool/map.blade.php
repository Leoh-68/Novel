<div class="footer-map">
    {!! Func::decodeHtmlChars($optSetting['coords_iframe'] ?? '') !!}
</div>
<style>
    .footer-map iframe {
        width: 100%;
        height: 300px;
    }
</style>
