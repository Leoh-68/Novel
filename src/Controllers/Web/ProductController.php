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

use Illuminate\Http\Request;
use NINA\Core\Support\Facades\View;
use NINA\Core\Support\Facades\BreadCrumbs;
use NINA\Core\Support\Facades\Auth;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\ProductModel;
use NINA\Models\ProductListModel;
use NINA\Models\ProductCatModel;
use NINA\Models\ProductItemModel;
use NINA\Models\ProductSubModel;
use NINA\Models\PropertiesListModel;
use NINA\Models\MemberModel;
use NINA\Models\FollowModel;
use NINA\Models\OrderNovelModel;
use NINA\Core\Support\Facades\Func;
use NINA\Models\NewsModel;

class ProductController extends Controller
{
    public function indexProfile($id, Request $request)
    {
        $memberDetail = MemberModel::find($id);
        $product = Func::getProductMember($id)->paginate(12);
        $titleMain = 'Sản phẩm của ' . $memberDetail->fullname;
        BreadCrumbs::setBreadcrumb(type: 'product', title: $titleMain);
        // Seo::seoPage($titleMain, 'product');
        return view('product.product', compact('product', 'titleMain'));
    }
    public function index(Request $request)
    {
        $product = $this->productItem('', $request, $this->type);
        $titleMain = $this->infoSeo('product', $this->type, 'title');
        // $titleMain = __('web.' . $titleMain);
        BreadCrumbs::setBreadcrumb(type: $this->type, title: $titleMain);
        $this->seoPage($titleMain, $this->infoSeo('product', $this->type, 'type', 'index'));
        return View::share([ 'com' => $this->type ])->view('product.product', compact('product', 'titleMain'));
    }
    public function indexByStatus(Request $request)
    {

        $product = $this->productItem('', $request, 'truyen');
        $titleMain = $request->get('status') == 'hoan-thanh' ? 'Truyện hoàn thành' : 'Truyện đang tiến hành';
        // $titleMain = __('web.' . $titleMain);
        BreadCrumbs::setBreadcrumb(type: 'truyen', title: $titleMain);
        $this->seoPage($titleMain, $this->infoSeo('product', 'truyen', 'type', 'index'));
        return View::share([ 'com' => $request->get('status') ])->view('product.product', compact('product', 'titleMain'));
    }

    public function list($slug, Request $request)
    {
        $itemList = ProductListModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();

        $listProperties = $this->searchListProperties($itemList['id']);

        $this->type = $itemList->type;
        $titleMain = $itemList['name' . $this->lang];
        BreadCrumbs::setBreadcrumb(list: $itemList);
        $product = $this->productItem($itemList, $request);
        $seoPage = $itemList->getSeo('product-list', 'save')->first();
        $seoPage['type'] = $this->infoSeo('product', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'product', 'seo');
        return View::share([ 'idList' => $itemList['id'], 'com' => $this->type ])->view('product.product', compact('product', 'titleMain', 'listProperties'));
    }

    public function cat($slug, Request $request)
    {
        $itemCat = ProductCatModel::select('id', 'id_list', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();
        $listProperties = $this->searchListProperties($itemCat['id_list']);
        $this->type = $itemCat->type;
        $titleMain = $itemCat['name' . $this->lang];
        $itemList = $itemCat->getCategoryList;
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat);
        $product = $this->productItem($itemCat, $request);
        $seoPage = $itemCat->getSeo('product-cat', 'save')->first();
        $seoPage['type'] = $this->infoSeo('product', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'product', 'seo');
        return View::share([ 'com' => $this->type ])->view('product.product', compact('product', 'titleMain', 'listProperties'));
    }

    public function item($slug, Request $request)
    {
        $itemItem = ProductItemModel::select('id', 'id_list', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'id_cat', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();
        $listProperties = $this->searchListProperties($itemItem['id_list']);
        $this->type = $itemItem->type;
        $titleMain = $itemItem['name' . $this->lang];
        $itemList = $itemItem->getCategoryList;
        $itemCat = $itemItem->getCategoryCat;
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat, item: $itemItem);
        $product = $this->productItem($itemItem, $request);
        $seoPage = $itemItem->getSeo('product-item', 'save')->first();
        $seoPage['type'] = $this->infoSeo('product', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'product', 'seo');
        return View::share([ 'com' => $this->type ])->view('product.product', compact('product', 'titleMain', 'listProperties'));
    }
    public function sub($slug, Request $request)
    {
        $itemSub = ProductSubModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'id_cat', 'id_item', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();

        $this->type = $itemSub->type;
        $titleMain = $itemSub['name' . $this->lang];
        $itemList = $itemSub->getCategoryList;
        $itemCat = $itemSub->getCategoryCat;
        $itemItem = $itemSub->getCategoryItem;
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat, item: $itemItem, sub: $itemSub);
        $product = $this->productItem($itemSub, $request);
        $seoPage = $itemSub->getSeo('product-sub', 'save')->first();
        $seoPage['type'] = $this->infoSeo('product', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'product', 'seo');
        return View::share([ 'com' => $this->type ])->view('product.product', compact('product', 'titleMain'));
    }
    public function detail($slug)
    {

        $rowDetail = ProductModel::select('*')->where(function ($query) use ($slug) {
            $query->where("slugvi", $slug)->orwhere("slugen", $slug);
        })->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])->first();

        // Validate order
        if (in_array('tinhphi', explode(',', $rowDetail->status))) {
            // Check login
            if (!Auth::guard('member')->check()) {
                return transfer('Vui lòng đăng nhập để mua truyện', 0, linkReferer());
            }

            if (!Func::checkOrderNovel(Auth::guard('member')->user()->id, $rowDetail->id)) {
                return transfer('Vui lòng mua truyện để đọc', 0, linkReferer());
            }
        }

        if (!empty($rowDetail))
            $rowDetail->increment('view');

        $query = PropertiesListModel::select('type', 'id', 'namevi')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'cart' ]);
        $listProperties = [];
        // if (!empty(config('type.categoriesProperties')))
        //     $query->whereRaw("FIND_IN_SET(?,id_list)", [ $rowDetail['id_list'] ]);
        // $listProperties = $query->orderBy('numb', 'asc')->get()->map(fn($v) => [ $v, $v->getProperties()->whereIn('id', explode(',', $rowDetail['properties']))->get() ]);

        $this->type = $rowDetail->type;

        $seoPage = $rowDetail->getSeo('product', 'save')->first();
        $seoPage['type'] = $this->infoSeo('product', $this->type, 'type', 'detail');
        Seo::setSeoData($seoPage, 'product', 'seo');

        $tags = $rowDetail->tags ?? [];
        $authorInfo = $rowDetail->getAuthor;

        $archievement = NewsModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'id_cat', 'id_item', 'type')
            ->where('type', 'danh-hieu')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();

        $rowChapter = $rowDetail->getChapter()->get();
        $rowChapterNew = $rowChapter->sortByDesc('id')->take(10);
        $rowChapter = $rowChapter->sortBy('id');

        BreadCrumbs::setBreadcrumb(detail: $rowDetail, list: $rowDetail->getCategoryList, cat: $rowDetail->getCategoryCat, item: $rowDetail->getCategoryItem, sub: $rowDetail->getCategorySub);

        $query = ProductModel::select('id', 'namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'discount', 'sale_price')->where('type', 'san-pham');
        if (!empty($rowDetail['id_list']))
            $query->whereRaw("CONCAT(',',id_list, ',') REGEXP ',(" . str_replace(',', '|', $rowDetail['id_list']) . "),'");
        if (!empty($rowDetail['id_cat']))
            $query->whereRaw("CONCAT(',',id_cat, ',') REGEXP ',(" . str_replace(',', '|', $rowDetail['id_cat']) . "),'");
        $query->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])->limit(10);
        $product = $query->get();
        $view = 'product.detail';

        if ($this->type == 'chuong-truyen') {
            // Handle remove chapter from followedNovel
            if (Auth::guard('member')->check()) {
                $followedNovel = Func::getFollowedChapterUpdate(Auth::guard('member')->user()->id, $rowDetail->id_novel, 'follow');
                if (!empty($followedNovel->chapter_update)) {
                    $oldData = json_decode($followedNovel->chapter_update, true);
                    $newData = array_diff($oldData, [ $rowDetail->id ]);

                    $followedNovel->chapter_update = json_encode($newData);
                    $followedNovel->save();
                }
            }
            $view = 'product.detail_chapter';
        }


        return View::share([ 'idList' => $rowDetail['id_list'], 'com' => $this->type ])->view($view, compact('rowDetail', 'product', 'tags', 'rowChapter', 'rowChapterNew', 'authorInfo', 'archievement'));
    }

    public function searchProduct(Request $request)
    {
        $keyword = $request->query('keyword');
        $product = ProductModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'regular_price', 'sale_price', 'discount')
            ->where(function ($query) use ($keyword) {
                $query->where('namevi', 'like', '%' . $keyword . '%')
                    ->orwhere('slugvi', 'like', '%' . $keyword . '%');
            })
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        $titleMain = 'Tìm kiếm sản phẩm';
        BreadCrumbs::setBreadcrumb(type: $this->type, title: $titleMain);
        $this->seoPage($titleMain, $this->infoSeo('product', $this->type, 'type', 'index'));
        return View::share([ 'com' => $this->type ])->view('product.product', compact('product', 'titleMain'));
    }

    public function suggestProduct(Request $request)
    {
        $keyword = $request->query('keyword');
        $product = ProductModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'regular_price', 'sale_price', 'discount')
            ->search($keyword)
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->orderBy('numb', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('ajax.itemSearch', [ 'productAjax' => $product ?? [] ]);
    }

    protected function checkListProperties($properties = [])
    {
        foreach ($properties as $k => $v)
            if (empty($v['data']))
                unset($properties[$k]);
        return $properties;
    }

    private function searchListProperties($idl)
    {
        $querySearch = PropertiesListModel::select('type', 'id', 'namevi', 'slugvi')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,id_list)", [ $idl ])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'search' ]);
        return $querySearch->orderBy('numb', 'asc')->get()->map(fn($v) => [ $v, $v->getProperties()->get() ]);
    }

    private function productItem($array = null, $request = null, $slug = '')
    {
        // Mặc định sắp xếp
        $defaultOrderBy = [ 'numb' => 'asc', 'id' => 'desc' ];
        $propaties = $request->getQueryString() ?? '';
        $status = $request->get('status') ?? '';

        // Lấy thông tin sản phẩm cần truy vấn

        if (!empty($array)) {
            $query = $array->getItems([
                'id',
                'namevi',
                'nameen',
                'descvi',
                'descen',
                'numb',
                'slugvi',
                'slugen',
                'photo',
                'regular_price',
                'sale_price',
                'discount',
                'id_member'
            ]);
        } else {
            $query = ProductModel::select('id', 'namevi', 'photo', 'descvi', 'slugvi', 'status', 'numb', 'sale_price', 'regular_price', 'id_member')
                ->where('type', $slug)
                ->with('tags')
                ->with('getAuthor');
        }

        // Nếu có tham số lọc từ query string
        if (!empty($propaties)) {
            parse_str($propaties, $result);
            unset($result['zarsrc']);
            unset($result['utm_source']);
            unset($result['utm_medium']);
            unset($result['utm_campaign']);
            unset($result['page']);
            $query->where(function ($query) use ($result, &$defaultOrderBy) {
                foreach ($result as $key => $propertyGroup) {
                    $items = explode(',', $propertyGroup);

                    // Điều chỉnh sắp xếp khi đến nhóm thuộc tính cuối cùng
                    if ($key == array_key_last($result)) {
                        $defaultOrderBy = match ($items[0]) {
                            "1" => [ 'id' => 'asc' ],
                            "2" => [ 'id' => 'desc' ],
                            "3" => [ 'sale_price' => 'desc', 'regular_price' => 'desc' ],
                            "4" => [ 'sale_price' => 'asc', 'regular_price' => 'asc' ],
                            default => [ 'numb' => 'asc', 'id' => 'desc' ],
                        };
                    } else {
                        // Thêm điều kiện lọc thuộc tính
                        $query->where(function ($subQuery) use ($items) {
                            foreach ($items as $item) {
                                $subQuery->orWhereRaw('FIND_IN_SET(?, properties)', [ $item ]);
                            }
                        });
                    }
                }
            });
        }

        if (!empty($status)) {
            switch ($status) {
                case 'dang-tien-hanh':
                    $query->whereRaw("NOT FIND_IN_SET(?,status)", [ 'hoanthanh' ]);
                    break;
                case 'hoan-thanh':
                    $query->whereRaw("FIND_IN_SET(?,status)", [ 'hoanthanh' ]);
                    break;
                default:
                    break;
            }
        }

        // Áp dụng sắp xếp dựa trên thứ tự mặc định hoặc từ bộ lọc
        foreach ($defaultOrderBy as $column => $direction) {
            // Kiểm tra nếu regular_sale > 0 thì ưu tiên sắp xếp theo regular_sale
            if ($column === 'sale_price') {
                $query->orderByRaw('CASE WHEN sale_price > 0 THEN sale_price ELSE regular_price END ' . $direction);
            } else {
                $query->orderBy($column, $direction);
            }
        }

        $product = $query->paginate(10);
        return $product;
    }

    public function subscribeNovel(Request $request)
    {
        $novelId = $request->input('novelId');
        $idMember = $request->input('idMember');
        $type = $request->input('type');

        if (empty($idMember)) {
            return response()->json([ 'status' => 'error', 'message' => 'Bạn chưa đăng nhập' ]);
        }
        $getNovel = ProductModel::find($novelId);
        if (empty($getNovel)) {
            return response()->json([ 'status' => 'error', 'message' => 'Truyện không tồn tại' ]);
        }

        $checkFollow = FollowModel::where('id_member', $idMember)->where('id_product', $novelId)->where('type', $type)->first();

        if (empty($checkFollow)) {
            FollowModel::create([ 'id_member' => $idMember, 'id_product' => $novelId, 'type' => $type ]);
            return response()->json([ 'status' => 'success', 'message' => 'Thêm vào giá sách thành công' ]);
        } else {
            $checkFollow->delete();
            return response()->json([ 'status' => 'error', 'message' => 'Đã bỏ khỏi giá sách' ]);
        }
    }
    public function getNovel(Request $request)
    {
        $novelId = $request->input('novelId');
        $idUser = $request->input('idMember');
        // $type = $request->input('type');
        $getUser = MemberModel::find($idUser);
        if (empty($getUser)) {
            return response()->json([ 'status' => 'error', 'message' => 'Bạn chưa đăng nhập' ]);
        }
        $getNovel = ProductModel::find($novelId);
        if (empty($getNovel)) {
            return response()->json([ 'status' => 'error', 'message' => 'Truyện không tồn tại' ]);
        }

        $newsOrder = OrderNovelModel::create([ 'id_user' => $idUser, 'id_product' => $novelId, 'numb_coin' => $getNovel->novel_price ]);

        if (!empty($newsOrder)) {
            $getUser->coin = $getUser->coin - $getNovel->novel_price;
            $getUser->save();
            return response()->json([ 'status' => 'success', 'message' => 'Mua truyện thành công' ]);
        } else {
            return response()->json([ 'status' => 'error', 'message' => 'Mua truyện thất bại' ]);
        }
    }
}
