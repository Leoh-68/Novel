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

use Carbon\Carbon;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\NewsModel;
use NINA\Models\ProductModel;
use NINA\Models\ProductListModel;
use NINA\Models\SettingModel;
use NINA\Models\CommentModel;
use DB;
use NINA\Models\StaticModel;
use NINA\Models\MemberModel;
use NINA\Models\TagsModel;
use NINA\Core\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $photos = PhotoModel::select('namevi', 'photo', 'link', 'type', 'status')
            ->whereIn('type', [ 'slide', 'banner-home' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $bannerHome = $photos
            ->where('type', 'banner-home')
            ->values();



        $slider = $photos
            ->where('type', 'slide')
            ->values();


        $newsCtrl = NewsModel::select('namevi', 'descvi', 'photo', 'slugvi', 'id', 'contentvi', 'status', 'type', 'member_list')
            ->whereIn('type', [ 'chinh-sach', 'feedback', 'tin-tuc', 'tieu-chi' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $feedbackHome = $newsCtrl
            ->where('type', 'feedback');

        $criteriaHome = $newsCtrl
            ->where('type', 'tieu-chi');

        $newsHome = $newsCtrl
            ->where('type', 'tin-tuc')
            ->filter(function ($newsCtrl) {
                return in_array('noibat', explode(',', $newsCtrl->status));
            })
            ->values();

        $aboutUs = StaticModel::select('*')
            ->where('type', 'gioi-thieu')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('id', 'desc')
            ->first();

        $membersMostChapter = MemberModel::withCount('product')
            ->having('product_count', '>', 0)
            ->orderBy('product_count', 'desc')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->get();

        $memberNB = MemberModel::select('fullname', 'avatar')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $regularAuthor = MemberModel::select('fullname', 'avatar')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();


        $productNB = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'id_member', 'sale_price', 'discount', 'id', 'view', 'created_at')
            ->with('tags')
            ->with('getAuthor')
            ->where('type', 'truyen')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'noibat' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $productDS = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'dacsan' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $productListHome = ProductListModel::select('namevi', 'photo', 'id', 'slugvi')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'noibat' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $commentHome = CommentModel::select('*')
            ->with('getVariant')
            ->with('getUser')
            ->where('type', 'truyen')
            ->where('star', '>', 0)
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('created_at', 'desc')
            ->get();


        $tagsHome = TagsModel::select('id', 'namevi', 'slugvi', 'type')
            ->where('type', 'truyen')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'noibat' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $arrAttr = get_defined_vars();

        $arrAttr = array_map(function ($key) {
            return is_string($key) ? ltrim($key, '$') : $key;
        }, array_keys(get_defined_vars()));

        unset($arrAttr['request']);
        /* SEO */
        $titleMain = SettingModel::pluck('namevi')->first();
        $this->seoPage($titleMain);
        return View::share('com', 'trang-chu')->view('home.index', compact($arrAttr));
    }

    // public function ajaxProduct(Request $request)
    // {
    //     $id = $request->get('id') ?? 0;
    //     $type = $request->get('type') ?? 0;

    //     $query = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
    //         ->where('type', 'san-pham')
    //         ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
    //         ->whereRaw("FIND_IN_SET(?,status)", [ 'noibat' ]);

    //     if (!empty($type) && $type == 'cat') {
    //         $query->where('id_cat', $id);
    //         $productAjax = $query->orderBy('id', 'desc')->get();
    //     }

    //     if (!empty($type) && $type == 'goi-y-hom-nay') {
    //         $rows = TagsModel::select('namevi', 'descvi', 'type', 'id')
    //             ->where('id', $id)
    //             ->first();
    //         $productAjax = $rows->products()->get();
    //     }

    //     return view('ajax.homeProduct', [ 'productAjax' => $productAjax ]);
    // }
    public function ajaxProductTags(Request $request)
    {
        $idTags = $request->get('id') ?? 0;

        $productTags = ProductModel::select('*')
            ->with('tags')
            ->whereHas('tags', function ($query) use ($idTags) {
                $query->where('product_tags.id_tags', $idTags);
            })
            ->get();



        return view('ajax.homeProductTags', [ 'productTags' => $productTags ]);
    }
}
