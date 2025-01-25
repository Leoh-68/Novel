<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Middlewares;

use NINA\Core\Support\Facades\Auth;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class LoginMember implements IMiddleware
{
    public function handle(Request $request): void
    {

     
        if (!Auth::guard('member')->check()) {
            transfer('Vui lòng đăng nhập.', false, url('home'));
            exit;
        }


        // if chưa đăng nhập thì vào form đăng nhập

        // if (!Auth::guard('member')->check() && $request->getUrl()->getPath() != substr(config('app.site_path'), 0, -1) . '/member/login' && (Auth::guard('member')->checkRemember() == false)) {
        //     response()->redirect(url('member.login'));
        // }

        //     // chưa đăng nhập
        //     if(!Auth::guard('member')->check()) {
        //         response()->redirect(url('home'));
        //     }
        //    dd(Auth::guard('member')->check());
        //    dd(substr(config('app.site_path'), 0, -1));
        //    dd($request->getUrl()->getPath());
        //    if(Auth::guard('member')->check()==false) response()->redirect(url('member.login'));
    }
}