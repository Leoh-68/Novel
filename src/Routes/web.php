<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.0 
 * Date 14-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

use NINA\Core\Routing\NINARouter;

NINARouter::group([ 'namespace' => 'Web', 'prefix' => config('app.web_prefix'), 'middleware' => [ \NINA\Middlewares\LangRequest::class, \NINA\Middlewares\CheckRedirect::class] ], function ($language = 'vi') {

    $type = json_decode(json_encode(config('type')));

    NINARouter::get('/change-lang/{lang}', function ($lang) {
        if (\Illuminate\Support\Arr::has(config('app.langs'), $lang)) {
            session()->set('locale', $lang);
            app()->make('config')->set('app.seo_default', $lang);
            response()->redirect(url('home', [ 'language' => $lang ]));
        }
    });

    NINARouter::get('/', 'HomeController@index')->name('home');
    NINARouter::get('/index', 'HomeController@index')->name('index');
    NINARouter::post('/load-product/{action}', 'HomeController@ajaxProduct')->name('load-product');
    NINARouter::get('/load-token', 'ApiController@token')->name('token');
    NINARouter::get('/the-loai', 'TagsController@index')->name('the-loai');
    NINARouter::post('/lien-he-post', 'ContactController@submit')->name('lien-he-post');
    NINARouter::get('/lien-he', 'ContactController@index')->name('lien-he');
    NINARouter::post('/filer', 'ApiController@filer')->name('filer');

    NINARouter::get('/profile/{id}', 'ProductController@indexProfile')->name('profile');


    // NINARouter::group(['type' => 'tin-tuc'], function () {
    //     NINARouter::get('/news', 'NewsController@index')->name('about.en');
    //     NINARouter::get('/tin-tuc', 'NewsController@index')->name('about.vi');
    //     NINARouter::get('/丁图克', 'NewsController@index')->name('about.cn');
    // });

    NINARouter::get('/tim-kiem', 'ProductController@searchProduct')->name('tim-kiem');
    NINARouter::get('/tim-kiem-goi-y', 'ProductController@suggestProduct')->name('tim-kiem-goi-y');
    // NINARouter::post('/cart/{action}', 'CartController@handle')->name('cart');
    // NINARouter::get('/gio-hang', 'CartController@showcart')->name('giohang');
    NINARouter::post('/comment/{action}', 'CommentController@handle')->name('comment');
    NINARouter::get('/load-product', 'HomeController@ajaxProduct')->name('load-product');
    NINARouter::get('/dang-ky-nhan-tin', 'ContactController@index')->name('dang-ky-nhan-tin');
    NINARouter::post('/dang-ky-nhan-tin-post', 'ContactController@submitNewsletter')->name('dang-ky-nhan-tin-post');
    NINARouter::post('/subscribeNovel', 'ProductController@subscribeNovel')->name('subscribeNovel');

    // Router News
    if ($type->news) {
        foreach ($type->news as $key => $value) {

            if (!empty($value->isRouter) && $value->isRouter) {
                NINARouter::get('/' . $key, 'NewsController@index')->name($key);
            }
        }
    }

    // Router Product
    if ($type->product) {
        foreach ($type->product as $key => $value) {
            if (!empty($value->isRouter) && $value->isRouter) {
                NINARouter::get('/' . $key, 'ProductController@index')->name($key);
            }
        }
    }

    // Router Static
    if ($type->static) {
        foreach ($type->static as $key => $value) {
            if (!empty($value->isRouter) && $value->isRouter) {
                NINARouter::get('/' . $key, 'StaticController@index')->name($key);
            }
        }
    }



    /* member */
    NINARouter::match([ 'get', 'post' ], '/member/login', 'MemberController@login')->name('member.login');

    NINARouter::match([ 'get', 'post' ], '/member/registration', 'MemberController@registration')->name('member.registration');

    NINARouter::match([ 'get', 'post' ], '/member/forgotpass', 'MemberController@forgotpass')->name('member.forgotpass');

    NINARouter::group([ 'middleware' => [ \NINA\Middlewares\LoginMember::class] ], function () {
        NINARouter::get('/numb', 'ApiController@numb')->name('numb');

        NINARouter::post('/donate', 'ApiController@donate')->name('donate');

        NINARouter::match([ 'get', 'post' ], '/member/man', 'MemberController@manMember')->name('member.man');

        NINARouter::match([ 'get', 'post' ], '/member/info', 'MemberController@infoMember')->name('member.info');

        NINARouter::match([ 'get', 'post' ], '/member/history', 'MemberController@history')->name('member.history');

        NINARouter::match([ 'get', 'post' ], '/member/upload/{com}/{act}/{type}', 'MemberController@upload')->name('memberHome.upload');

        NINARouter::match([ 'get', 'post' ], '/member/edit/{com}/{act}/{type}', 'MemberController@edit')->name('memberHome.edit');

        NINARouter::match([ 'get', 'post' ], '/member/save/{com}/{act}/{type}', 'MemberController@save')->name('memberHome.save');

        NINARouter::match([ 'get', 'post' ], '/member/delete/{com}/{act}/{type}', 'MemberController@delete')->name('memberHome.delete');

        NINARouter::match([ 'get', 'post' ], '/member/man/{com}/{act}/{type}', 'MemberController@man')->name('memberHome.man');

        NINARouter::match([ 'get', 'post' ], '/member/list/{com}/{act}/{type}', 'MemberController@man')->name('memberHome.list');

        // Kệ sách
        NINARouter::match([ 'get', 'post' ], '/member/book-shelf/{com}/{act}/{type}', 'MemberController@manBookShelf')->name('memberHome.book-shelf');
        NINARouter::match([ 'get', 'post' ], '/member/delete-book-shelf/{com}/{act}/{type}', 'MemberController@deleteBookShelf')->name('memberHome.deleteBookShelf');
        //Mua sách
        NINARouter::post('/getNovel', 'ProductController@getNovel')->name('getNovel');

        NINARouter::get('/member/logout', 'MemberController@logout')->name('member.logout');
    });

    NINARouter::get('/album', 'AlbumController@index')->name('album');

    NINARouter::get('/{slug}', 'SlugController@handle')->name('slugweb');

});