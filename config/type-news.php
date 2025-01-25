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

    'feedback' => [
        'title_main' => "Feedback",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Feedback'
        ],
        'view' => true,
        'copy' => true,
        'slug' => true,
        'status' => [ "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '150',
                'height' => '150',
                'thumb' => '150x150x1'
            ]
        ],
        'show_images' => true,
        'name' => true,
        'desc' => true,
        
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'danh-hieu' => [
        'title_main' => "Danh hiệu",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Danh hiệu'
        ],
        'view' => true,
        'copy' => true,
        'member' => true,
        'status' => [ "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '500',
                'height' => '500',
                'thumb' => '500x500x1'
            ]
        ],
        'show_images' => true,
        'name' => true,
        'desc' => true,'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
       
    ],
    'ten-duong' => [
        'title_main' => "Tên đường",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Tên đường'
        ],
        'view' => true,
        'copy' => true,
        'member' => true,
        'slug' => true,
        'status' => [ "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '150',
                'height' => '150',
                'thumb' => '150x150x1'
            ]
        ],
        'show_images' => true,
        'name' => true,
        'desc' => true,'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'tieu-chi' => [
        'title_main' => "Tiêu chí",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Tiêu chí'
        ],
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => [ "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '40',
                'height' => '40',
                'thumb' => '40x40x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'chinh-sach' => [
        'title_main' => "Chính sách",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Chính sách'
        ],


        'view' => true,
        'copy' => true,
        'slug' => true,
        'status' => [ "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '610',
                'height' => '330',
                'thumb' => '610x330x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
        'isRouter' => true,
    ],

    'tin-tuc' => [
        'title_main' => " Tin tức",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Tin tức'
        ],

        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => [ "noibat" => "Nổi bật", "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '390',
                'height' => '390',
                'thumb' => '390x390x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
        'isRouter' => true
    ],
    'dich-vu' => [
        'title_main' => " Dịch vụ",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Dịch vụ'
        ],

        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => [ "noibat" => "Nổi bật", "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '390',
                'height' => '390',
                'thumb' => '390x390x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
        'isRouter' => true
    ]

    // 'hinh-thuc-thanh-toan' => [
    //     'title_main' => "Hình thức thanh toán",
    //     'dropdown' => false,
    //     'list' => false,
    //     'tags' => false,
    //     'view' => false,
    //     'copy' => false,
    //     'datePublish' => false,
    //     'copy_image' => false,
    //     'comment' => false,
    //     'slug' => false,
    //     'status' => ["hienthi" => "Hiển thị"],
    //     'images' => false,
    //     'icon' => false,
    //     'show_images' => false,
    //     'name' => true,
    //     'desc' => true,
    //     'content' => false,
    //     'content_cke' => false,
    //     'seo' => false,
    //     'schema' => false,
    //     'width' => 420,
    //     'height' => 288,
    //     'thumb' => '100x100x1',
    //     'width_icon' => 30,
    //     'height_icon' => 30,
    //     'thumb_icon' => '100x100x1',
    // ]
];
