@php

    if (!empty($thumb)) {
   
    } else {
        if ($folder == 'product' || $folder == 'news' || $folder == 'static') {
            $thumb = $configType[$folder][$type]['images']['photo']['thumb'] ?? '500x500x1';
        } else {
            $thumb = $configType[$folder][$type]['thumb'];
        }
    }

    $arrThumb = explode('x', $thumb);
    $class = $class ?? 'w-100';
    $effect = $effect ?? 'hover-img scale-img';
    $var = $var ?? 'photo';
    $aspect = $aspect ?? $arrThumb[0] . '/' . $arrThumb[1];
@endphp
<div class="image-wrapper aspect-ratio {{ $effect }} " style="aspect-ratio: {{ $aspect }}">
    <img class="{{ $class }}"
        onerror="this.src='{{ thumbs('thumbs/' . $thumb . '/assets/images/noimage.png.webp') }}';"
        src="{{ assets_photo($folder, $thumb, $item[$var], 'thumbs') }}" alt="{{ $item['namevi'] }}">
</div>
