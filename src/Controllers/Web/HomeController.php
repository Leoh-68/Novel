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
            ->whereIn('type', [ 'slide', 'tiktok', 'map-home', 'banner-home' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $bannerHome = $photos
            ->where('type', 'banner-home')
            ->values();

        $mapHome = $photos
            ->where('type', 'map-home')
            ->first();

        $slider = $photos
            ->where('type', 'slide')
            ->values();

        $membersMostChapter = MemberModel::withCount('product')
            ->having('product_count', '>', 0)
            ->orderBy('product_count', 'desc')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->get();

        $tiktokHome = $photos
            ->where('type', 'tiktok')
            ->filter(function ($photo) {
                return in_array('noibat', explode(',', $photo->status));
            })
            ->values();

        $newsCtrl = NewsModel::select('namevi', 'descvi', 'photo', 'slugvi', 'id', 'contentvi', 'status', 'type', 'member_list')
            ->whereIn('type', [ 'chinh-sach', 'feedback', 'tin-tuc', 'cong-trinh', 'tieu-chi', 'phan-khu', 'ten-duong' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $streetHome = $newsCtrl
            ->where('type', 'ten-duong')
            ->values();

        $boothHome = $newsCtrl
            ->where('type', 'phan-khu')
            ->values();

        $feedbackHome = $newsCtrl
            ->where('type', 'feedback');

        $criteriaHome = $newsCtrl
            ->where('type', 'tieu-chi');

        $projectHome = $newsCtrl
            ->where('type', 'cong-trinh');


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

        $productNB = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'id_member', 'sale_price', 'discount', 'id', 'view','created_at')
            ->with('tags')
            ->with('getAuthor')
            ->where('type', 'truyen')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'noibat' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

       

        $regularAuthor = MemberModel::select('fullname', 'avatar')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
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

        $memberNB = MemberModel::select('fullname', 'avatar')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $tags = TagsModel::select('id', 'namevi', 'slugvi', 'type')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
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

    public function ajaxProduct(Request $request)
    {
        $idList = $request->get('idList') ?? 0;
        $idCat = $request->get('idCat') ?? 0;
        $eShow = $request->get('eShow') ?? '';
        $type = $request->get('type') ?? 'san-pham';
        $paginate = $request->get('paginate') ?? 8;

        $query = ProductModel::select('namevi', 'parametervi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
            ->where('type', $type)
            ->whereRaw('FIND_IN_SET(?,status)', [ 'hienthi' ])
            ->whereRaw('FIND_IN_SET(?,status)', [ 'noibat' ]);

        if (!empty($idList)) {
            $query->whereRaw('FIND_IN_SET(?,id_list)', [ $idList ]);
            if (empty($idCat))
                $productAjax = $query->orderBy('numb', 'asc')->orderBy('id', 'desc')->paginate($paginate);
        }

        if (!empty($idCat)) {
            $query->whereRaw('FIND_IN_SET(?,id_cat)', [ $idCat ]);
            $productAjax = $query->orderBy('numb', 'asc')->orderBy('id', 'desc')->paginate($paginate);
        }

        return view('ajax.homeProduct', [ 'productAjax' => $productAjax, 'idList' => $idList, 'idCat' => $idCat, 'eShow' => $eShow ]);
    }
}
