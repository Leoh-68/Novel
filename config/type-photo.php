<?php

/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.0 
 * Date 14-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

return [
    'logo' => [
        'title_main' => "Logo",
        'kind' => 'static',
        'title' => true,
        'link' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => true,
        'width' => 128,
        'height' => 92,
        'thumb' => '128x92x1',
    ],
    'map-home' => [
        'title_main' => "Bản đồ",
        'kind' => 'static',
        'title' => true,
        'link' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => true,
        'width' => 920,
        'height' => 800,
        'thumb' => '920x800x1',
    ],
    'banner-home' => [
        'title_main' => "Banner",
        'kind' => 'album',
        'number' => 4,
        'title' => true,
        'link' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => true,
        'width' => 585,
        'height' => 230,
        'thumb' => '585x230x1',
    ],
    'favicon' => [
        'title_main' => "Favicon",
        'kind' => 'static',
        'title' => true,
        'desc' => true,
        'desc_cke' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => true,
        'width' => 48,
        'height' => 48,
        'thumb' => '48x48x1',
    ],

    'slide' => [
        'title_main' => "Slideshow",
        'kind' => 'album',
        'status' => ["hienthi" => "Hiển thị"],
        'number' => 5,
        'images' => true,
        'show_images' => true,
        'gallery' => true,
        'link' => true,
        'name' => true,
        'desc' => false,
        'width' => 1366,
        'height' => 580,
        'thumb' => '1366x580x1',
    ],

    'social' => [
        'title_main' => "Mạng xã hội",
        'kind' => 'album',
        'status' => ["hienthi" => "Hiển thị"],
        'number' => 4,
        'show_images' => true,
        'images' => true,
        'avatar' => true,
        'link' => true,
        'name' => true,
        'desc' => false,
        'width' => 37,
        'height' => 37,
        'thumb' => '37x37x2',
    ],
    'phuogn-thuc-thanh-toan' => [
        'title_main' => "Phương thức thanh toán",
        'kind' => 'album',
        'status' => ["hienthi" => "Hiển thị"],
        'number' => 4,
        'show_images' => true,
        'images' => true,
        'avatar' => true,
        'link' => true,
        'name' => true,
        'desc' => false,
        'width' => 80,
        'height' => 50,
        'thumb' => '80x50x1',
    ],
    'anh-co-san' => [
        'title_main' => "Ảnh Avatar có sẵn",
        'kind' => 'album',
        'status' => ["hienthi" => "Hiển thị"],
        'number' => 4,
        'show_images' => true,
        'images' => true,
        'avatar' => true,
        'link' => false,
        'name' => false,
        'desc' => false,
        'width' => 200,
        'height' => 200,
        'thumb' => '200x200x1',
    ],

    'tool' => [
        'title_main' => "Tiện ích",
        'kind' => 'album',
        'status' => ["hienthi" => "Hiển thị"],
        'number' => 4,
        'show_images' => true,
        'images' => true,
        'avatar' => true,
        'link' => true,
        'name' => true,
        'desc' => false,
        'width' => 37,
        'height' => 37,
        'thumb' => '37x37x2',
    ],

    'video' => [
        'title_main' => "Video",
        'kind' => 'album',
        'status' => ["hienthi" => "Hiển thị"],
        'number' => 4,
        'show_images' => true,
        'images' => true,
        'avatar' => true,
        'link' => true,
        'name' => true,
        'desc' => false,
        'width' => 300,
        'height' => 430,
        'thumb' => '300x430x1',
    ],

    'fanpage' => [
        'title_main' => "Fanpage",
        'kind' => 'static',
        'title' => true,
        'link' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => true,
        'width' => 360,
        'height' => 300,
        'thumb' => '360x300x1',
    ],
    'watermark_product' => [
        'title_main' => "Con dấu sản phẩm",
        'kind' => 'static',
        'watermark' => true,
        'desc' => false,
        'title' => false,
        'desc_cke' => false,
        'link' => false,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => true,
        'width' => 70,
        'height' => 70,
        'thumb' => '70x70x1',
    ]
];
