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

    'gioi-thieu' => [
        'title_main' => "Giới thiệu",
        'website' => [
            'type' => 'object',
            'title' => 'gioithieu'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            'photo' => [
                'title' =>  'Hình ảnh',
                'width' => '300',
                'height' => '300',
                'thumb' => '300x300x1'
            ]
        ],
        'name' => true,
        'desc' => true,
        'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'isRouter' => true,
    ],

    'slogan' => [
        'title_main' => "Slogan",
        'website' => [
            'type' => 'object',
            'title' => 'slogan'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'name' => true,
        'title' => true,
        'seo' => true,
    ],

    'slogan-footer' => [
        'title_main' => "Slogan footer",
        'website' => [
            'type' => 'object',
            'title' => 'slogan footer'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'name' => true,
        'desc' => true,
        'title' => true,
        'seo' => true,
    ],

    'lienhe' => [
        'title_main' => "Liên hệ",
        'website' => [
            'title' => 'lienhe'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            // 'photo' => [
            //     'title' =>  'Hình ảnh',
            //     'width' => '300',
            //     'height' => '300',
            //     'thumb' => '300x300x1'
            // ]
        ],
        'name' => false,
        'content' => true,
        'content_cke' => true,
    ],
    'footer' => [
        'title_main' => "Footer",
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            // 'photo' => [
            //     'title' =>  'Hình ảnh',
            //     'width' => '300',
            //     'height' => '300',
            //     'thumb' => '300x300x1'
            // ]
        ],
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
    ]
        // 'chuong-trinh-theo-tuan' => [
    //     'title_main' => "Chương trình theo tuần",
    //     'status' => [
    //         "hienthi" => 'Hiển thị'
    //     ],
    //     'images' => [
    //         // 'photo' => [
    //         //     'title' =>  'Hình ảnh',
    //         //     'width' => '300',
    //         //     'height' => '300',
    //         //     'thumb' => '300x300x1'
    //         // ]
    //     ],
    //     'gallery' => [
    //         'chuong-trinh-theo-tuan' => [
    //             "title_main_photo" => "Hình ảnh sản phẩm",
    //             "status_photo" => ["hienthi" => "Hiển thị"],
    //             "number_photo" => 3,
    //             "images_photo" => true,
    //             "name_photo" => true,
    //             "width_photo" => 500,
    //             "height_photo" => 340,
    //             "thumb_photo" => '500x340x1'
    //         ],
    //     ],
    //     'slug' => true,
    //     'name' => true,
    //     'desc' => false,
    //     'desc_cke' => false,
    //     'content' => false,
    //     'content_cke' => false,
    //     'seo' => false,
    // ],
];
