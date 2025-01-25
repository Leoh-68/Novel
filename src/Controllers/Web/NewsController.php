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
use NINA\Core\Support\Facades\Seo;
use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Core\Support\Facades\Func;
use NINA\Models\NewsCatModel;
use NINA\Models\NewsItemModel;
use NINA\Models\NewsListModel;
use NINA\Models\NewsModel;
use NINA\Core\Support\Facades\BreadCrumbs;
use NINA\Models\NewsSubModel;

class NewsController extends Controller
{


    public function index()
    {
        $news = NewsModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo')
            ->where('type', $this->type)
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->datePublish()
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        $titleMain = $this->infoSeo('news', $this->type, 'title');
        BreadCrumbs::setBreadcrumb(type: $this->type, title: $titleMain);
        $this->seoPage($titleMain, $this->infoSeo('news', $this->type, 'type', 'index'));
        return View::share([ 'com' => $this->type ])->view('news.news', compact('news', 'titleMain'));
    }

    public function list($slug)
    {
        $itemList = NewsListModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();
        if ($this->infoSeo('news', $itemList->type, 'type', 'index'))
            BreadCrumbs::set(url('slugweb', [ 'slug' => $itemList->type ]), $this->infoSeo('news', $itemList->type, 'title'));
        $this->type = $itemList->type;
        $titleMain = $itemList['name' . $this->lang];
        BreadCrumbs::setBreadcrumb(list: $itemList);
        $news = $itemList->getItems([ 'id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo' ])->paginate(10);
        $seoPage = $itemList->getSeo('news-list', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        return View::share([ 'com' => $this->type ])->view('news.news', compact('news', 'titleMain'));
    }

    public function cat($slug)
    {
        $itemCat = NewsCatModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();
        $this->type = $itemCat->type;
        $titleMain = $itemCat['name' . $this->lang];
        $itemList = $itemCat->getCategoryList;
        if ($this->infoSeo('news', $itemCat->type, 'type', 'index'))
            BreadCrumbs::set(url('slugweb', [ 'slug' => $itemCat->type ]), $this->infoSeo('news', $itemCat->type, 'title'));
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat);
        $news = $itemCat->getItems([ 'id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo' ])->paginate(10);

        $seoPage = $itemList->getSeo('news-cat', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        return View::share([ 'com' => $this->type ])->view('news.news', compact('news', 'titleMain'));
    }

    public function item($slug)
    {
        $itemItem = NewsItemModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'id_cat', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();
        $this->type = $itemItem->type;
        $titleMain = $itemItem['name' . $this->lang];
        $itemList = $itemItem->getCategoryList;
        $itemCat = $itemItem->getCategoryCat;
        if ($this->infoSeo('news', $itemItem->type, 'type', 'index'))
            BreadCrumbs::set(url('slugweb', [ 'slug' => $itemItem->type ]), $this->infoSeo('news', $itemItem->type, 'title'));
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat, item: $itemItem);
        $news = $itemItem->getItems([ 'id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo' ])->paginate(10);

        $seoPage = $itemList->getSeo('news-item', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        return View::share([ 'com' => $this->type ])->view('news.news', compact('news', 'titleMain'));
    }

    public function sub($slug)
    {
        $itemSub = NewsSubModel::select('id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo', 'id_list', 'id_cat', 'id_item', 'type')
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
        if ($this->infoSeo('news', $itemSub->type, 'type', 'index'))
            BreadCrumbs::set(url('slugweb', [ 'slug' => $itemSub->type ]), $this->infoSeo('news', $itemSub->type, 'title'));
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat, item: $itemItem, sub: $itemSub);
        $news = $itemSub->getItems([ 'id', 'namevi', 'nameen', 'descvi', 'descen', 'slugvi', 'slugen', 'photo' ])->paginate(10);

        $seoPage = $itemList->getSeo('news-sub', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        return View::share([ 'com' => $this->type ])->view('news.news', compact('news', 'titleMain'));
    }

    public function detail($slug)
    {
        $rowDetail = NewsModel::select('*')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->first();
        $seoPage = $rowDetail->getSeo('news', 'save')->first();
        Seo::setSeoData($seoPage, 'news', 'seo');
        $rowDetailPhoto = $rowDetail->getPhotos('news')->get();
        $tags = $rowDetail->tags ?? [];
        $itemList = $rowDetail->getCategoryList;
        $itemCat = $rowDetail->getCategoryCat;
        $itemItem = $rowDetail->getCategoryItem;
        $itemSub = $rowDetail->getCategorySub;
        if ($this->infoSeo('news', $rowDetail->type, 'type', 'index'))
            BreadCrumbs::set(url('slugweb', [ 'slug' => $rowDetail->type ]), $this->infoSeo('news', $rowDetail->type, 'title'));
        BreadCrumbs::setBreadcrumb(detail: $rowDetail, list: $itemList, cat: $itemCat, item: $itemItem, sub: $itemSub);
        $news = NewsModel::select('id', 'namevi', 'photo', 'descvi', 'slugvi')
            ->where([ 'type' => $rowDetail['type'], 'id_list' => $rowDetail->id_list ])
            ->where("id", "!=", $rowDetail['id'])
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->get();
        if ($rowDetail->type == 'ten-duong' || $rowDetail->type == 'phan-khu') {
            $listPlace = $rowDetail->getMember();
           
            return View::share('com', $rowDetail->type)->view('news.newsMember', compact('rowDetail', 'rowDetailPhoto', 'news', 'tags','listPlace'));
        }
        return View::share('com', $rowDetail->type)->view('news.detail', compact('rowDetail', 'rowDetailPhoto', 'news', 'tags'));
    }
}