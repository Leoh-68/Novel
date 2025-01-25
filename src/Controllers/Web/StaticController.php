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
use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\StaticModel;
use NINA\Core\Support\Facades\BreadCrumbs;

class StaticController extends Controller
{
    public function index(Request $request)
    {
        $rowDetail = StaticModel::select('namevi', 'photo', 'descvi', 'contentvi','type','id')
            ->where('type', $this->type)
            ->first();
        $seoPage = $rowDetail->getSeo('static','save')->first();
        $seoPage['type'] = 'article';
        BreadCrumbs::setBreadcrumb(type:$this->type,title: 'Giới thiệu');
        Seo::setSeoData($seoPage,'news');
        return View::share('com', $this->type)->view('static.static', ['static' => $rowDetail]);
    }
}
