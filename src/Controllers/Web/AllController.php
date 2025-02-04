<?php

/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.0 
 * Date 14-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Web;

use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Models\ProductCatModel;
use NINA\Models\FollowModel;
use NINA\Models\ProductModel;
use NINA\Core\Support\Facades\Auth;
use NINA\Core\Container;

class AllController extends Controller
{
    function composer($view): void
    {

        if ($_SESSION['detect_allcontroller']) {
            return;
        }

        $_SESSION['detect_allcontroller'] = true;

        $userLogin = !empty(Auth::guard('member')->user()) ? Auth::guard('member')->user() : null;

        if (!empty($userLogin)) {
            $userLogin->refresh();
            $newsChapterUpdate = FollowModel::where('id_member', $userLogin->id)
                ->where('type', 'follow')
                ->where('chapter_update', '!=', '')
                ->where('chapter_update', '!=', '[]')
                ->limit(1)
                ->get();
        }
        $userLoginCheck = Auth::guard('member')->check();
        $newsUserUpdated = $userLogin->fullname ?? 'nologin';
        $usernamelogin = $newsUserUpdated;
        $configType = json_decode(json_encode(config('type')));

        $productMostView = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'id_member', 'sale_price', 'discount', 'id', 'view')
            ->with('getAuthor')
            ->where('type', 'truyen')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('view', 'desc')
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();


        $extHotline = '';
        $photos = PhotoModel::select('photo', 'namevi', 'link', 'type')
            ->whereIn('type', ['logo', 'banner-1', 'favicon', 'social',  'fanpage', 'tool', 'phuong-thuc-thanh-toan'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();

        $payment = $photos->where('type', 'phuong-thuc-thanh-toan')
            ->values();

        $logoPhoto = $photos->where('type', 'logo')->first();
        $banner = $photos->where('type', 'banner-1')->first();
        $favicon = $photos->where('type', 'favicon')->first();
        $fanpageCom = $photos->where('type', 'fanpage')->first();
        $social = $photos->where('type', 'social');
        $tool = $photos->where('type', 'tool');
        $logoPhotoFooter = $photos->where('type', 'logoft')->first();

        // Static

        $statics = StaticModel::select('namevi', 'contentvi', 'descvi', 'slugvi', 'status', 'type')
            ->whereIn('type', ['slogan', 'footer', 'slogan-footer'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();

        $slogan = $statics->where('type', 'slogan')->first();

        $sloganFooter = $statics->where('type', 'slogan-footer')->first();

        $footer = $statics->where('type', 'footer')->first();

        // News
        $newsCtrl = NewsModel::select('namevi', 'descvi', 'photo', 'slugvi', 'id', 'contentvi', 'status', 'type')
            ->whereIn('type', ['chinh-sach', 'tin-tuc'])
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $newsAll = $newsCtrl->where('type', 'tin-tuc')->values();

        $policyHome = $newsCtrl
            ->where('type', 'chinh-sach')
            ->values();

        $listProductMenu = ProductListModel::select('namevi', 'photo', 'slugvi', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $catProductMenu = ProductCatModel::select('namevi', 'photo', 'slugvi', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['menu'])
            ->orderBy('numb', 'asc')
            ->get();

        $ext = ExtensionsModel::select('*')
            ->whereIn('type', ['hotline', 'social', 'popup'])
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->get();

        $extHotline = $ext->where('type', 'hotline')->first();

        $extSocial = $ext->where('type', 'social')->first();

        $extPopup = $ext->where('type', 'popup')->first();

        $setting = SettingModel::first();
        $optSetting = json_decode($setting['options'], true);
        $configType = json_decode(json_encode(config('type')), true);
        $fanpage = $optSetting['fanpage'];
        $lang = session()->get('locale');
        $arrAttr = get_defined_vars();

        $arrAttr = array_map(function ($key) {
            return is_string($key) ? ltrim($key, '$') : $key;
        }, array_keys(get_defined_vars()));

        unset($arrAttr['request']);
        $view->share(compact(
            $arrAttr
        ));
    }
}
