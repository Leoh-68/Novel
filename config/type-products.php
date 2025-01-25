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
    'truyen' => [
        'title_main' => "Truyện",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Truyện'
        ],
        'id_categories' => true,
        'copy' => true,
        'tags' => true,
        // 'suggest' => true,
        'slug' => true,
        'status' => [ "hoanthanh" => "Hoàn thành", "noibat" => "Nổi bật", "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '260',
                'height' => '370',
                'thumb' => '260x370x1'
            ],
            // 'icon' => [
            //     'title' => 'Icon',
            //     'width' => '950',
            //     'height' => '630',
            //     'thumb' => '950x630x1'
            // ]
        ],
        'show_images' => true,
        'gallery' => [
            'san-pham' => [
                "title_main_photo" => "Hình ảnh sản phẩm",
                "title_sub_photo" => "Hình ảnh",
                "status_photo" => [ "hienthi" => "Hiển thị" ],
                "number_photo" => 3,
                "images_photo" => true,
                "avatar_photo" => true,
                "name_photo" => true,
                "photo_width" => 950,
                "photo_height" => 630,
                "photo_thumb" => '100x100x1'
            ]

            // 'hinh-anh' => [
            //     "title_main_photo" => "Hình ảnh khác",
            //     "title_sub_photo" => "Hình ảnh",
            //     "status_photo" => ["hienthi" => "Hiển thị"],
            //     "number_photo" => 3,
            //     "images_photo" => true,
            //     "avatar_photo" => true,
            //     "name_photo" => true,
            //     "photo_width" => 950,
            //     "photo_height" => 630,
            //     "photo_thumb" => '100x100x1'
            // ],
        ],
        // 'posts' => [
        //     'khuyen-mai-san-pham' => 'Khuyến mãi',
        //     'uu-dai-san-pham' => 'Ưu đãi',
        //     'ho-tro-san-pham' => 'Hỗ trợ',
        // ],
        // 'excel' => [
        //     'import' => [
        //         'title_main_excel' => "Import",
        //     ],
        //     'export' => [
        //         'title_main_excel' => "Export",
        //     ]
        // ],
        'view' => true,
        // 'comment' => true,
        // 'properties' => true,
        'code' => true,
        'novel_price' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'desc_cke' => false,
        'content' => true,
        'content_cke' => true,
        'schema' => true,
        'seo' => true,
        'group' => true,
        'isRouter' => true,
    ],

    'chuong-truyen' => [
        'title_main' => "Chương truyện",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Chương truyện'
        ],
        'id_categories' => true,
        'copy' => true,
        
        // 'suggest' => true,
        'slug' => true,
        'isChapter' => true,
        'status' => [ 'tinhphi' => 'Tính phí', 'hienthi' => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '500',
                'height' => '500',
                'thumb' => '500x500x1'
            ],
        ],
        'show_images' => true,
        'gallery' => [
            'san-pham' => [
                "title_main_photo" => "Hình ảnh sản phẩm",
                "title_sub_photo" => "Hình ảnh",
                "status_photo" => [ "hienthi" => "Hiển thị" ],
                "number_photo" => 3,
                "images_photo" => true,
                "avatar_photo" => true,
                "name_photo" => true,
                "photo_width" => 950,
                "photo_height" => 630,
                "photo_thumb" => '100x100x1'
            ]
        ],
        'view' => true,
        'code' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'novel_price' => true,
        'desc_cke' => false,
        'content' => true,
        'content_cke' => true,
        'schema' => true,
        'seo' => true,
        'group' => true,
    ],
    'album' => [
        'title_main' => "Album",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Album'
        ],
        'copy' => true,
        'slug' => true,
        'status' => [ "noibat" => "Nổi bật", "hienthi" => "Hiển thị" ],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '950',
                'height' => '630',
                'thumb' => '950x630x1'
            ],

        ],
        'show_images' => true,
        'gallery' => [
            'album' => [
                "title_main_photo" => "Hình ảnh album",
                "title_sub_photo" => "Hình ảnh",
                "status_photo" => [ "hienthi" => "Hiển thị" ],
                "number_photo" => 3,
                "images_photo" => true,
                "avatar_photo" => true,
                "name_photo" => true,
                "photo_width" => 950,
                "photo_height" => 630,
                "photo_thumb" => '100x100x1'
            ]
        ],
        'view' => true,
        'name' => true,
        'desc' => true,
        'desc_cke' => false,
        'content' => true,
        'content_cke' => true,
        'schema' => true,
        'seo' => true,
    ]
];
