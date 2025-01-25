<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
namespace NINA\Controllers\Web;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Auth;
use NINA\Core\Support\Facades\File;
use NINA\Core\Support\Facades\Hash;
use NINA\Core\Support\Facades\Validator;
use NINA\Core\Support\JsonResponse;
use NINA\Models\MemberModel;
use NINA\Models\ProductTagsModel;
use NINA\Models\ProductModel;
use NINA\Models\DistrictModel;
use NINA\Models\SlugModel;
use NINA\Models\SeoModel;
use NINA\Models\WardModel;
use Illuminate\Support\Str;
use NINA\Core\Support\Facades\Email;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Flash;
use NINA\Traits\TraitSave;
use Carbon\Carbon;
use NINA\Models\GalleryModel;
use NINA\Models\FollowModel;
use NINA\Models\ProductPropertiesModel;
use NINA\Models\PropertiesListModel;
class MemberController
{
    use JsonResponse, TraitSave;
    protected $loginpage, $configType;
    public function __construct()
    {
        $this->loginpage = config('auth.loginpage') ?? 'cover';
        $this->configType = json_decode(json_encode(config('type')))->product;
    }

    // Man view trang chủ member
    public function manMember()
    {
        if (!Auth::guard('member')->check()) {
            transfer('Vui lòng đăng nhập.', false, url('home'));
            exit;
        }
        $rowDetail = MemberModel::select('*')
            ->where('id', '=', Auth::guard('member')->user()->id)
            ->first();
        // $slugCheck = ProductModel::select('*')
        //     ->where('id', 405)
        //     ->orderBy('id', 'desc')
        //     ->first();
        // dd($slugCheck);
        return view('member.man', [ 'rowDetail' => $rowDetail ]);
    }

    /* Login */
    public function login(Request $request)
    {
        if (Auth::guard('member')->check()) {
            response()->redirect(url('home'));
        }
        if ($request->isMethod('post')) {
            if (!empty($request->csrf_token)) {
                $credentials = [
                    'username' => $request->username,
                    'password' => $request->password,
                ];
                $username = (!empty($request->username)) ? $request->username : '';
                $password = (!empty($request->password)) ? $request->password : '';
                $error = "";
                $success = "";
                $login_failed = false;
                $ip = request()->ip();
                if ($error == '') {
                    if ($username == '' && $password == '') {
                        $error = "Bạn chưa nhập tên đăng nhập và mật khẩu";
                        return view("member.{$this->loginpage}", [ 'mess' => $error ]);
                    } else if ($username == '') {
                        $error = "Bạn chưa nhập tên đăng nhập";
                        return view("member.{$this->loginpage}", [ 'mess' => $error ]);
                    } else if ($password == '') {
                        $error = "Bạn chưa nhập mật khẩu";
                        return view("member.{$this->loginpage}", [ 'mess' => $error ]);
                    } else {
                        if (Auth::guard('member')->attempt($credentials, $request->has('remember'))) {
                            $admin = Auth::guard('member')->user();
                            // $timenow = time();
                            // $id_user = $admin->id;
                            // $ip = request()->ip();
                            // $token = md5(time());
                            // $user_agent = $_SERVER['HTTP_USER_AGENT'];
                            // $device = strtolower(agent()->deviceType());
                            // $sessionhash = md5(sha1($admin->password . $admin->username));
                            //MemberLogModel::create(['id_user' => $id_user, 'ip' => $ip, 'timelog' => $timenow, 'user_agent' => $user_agent,'device'=>$device,'operation'=>'login']);
                            //MemberModel::where('id', $id_user)->update(['login_session' => $sessionhash, 'lastlogin' => $timenow, 'user_token' => $token]);
                            //MemberLogModel::where('id', $id_user)->update(['login_session' => $sessionhash, 'lastlogin' => $timenow]);
                            // $limitlogin = MemberLimitModel::select('*')->where('login_ip', $ip)->first();
                            // if (!empty($limitlogin) == 1) {
                            //     $id_login = $limitlogin->id;
                            //     MemberLimitModel::where('id', $id_login)->update(['login_attempts' => 0, 'locked_time' => 0]);
                            // }
                            session()->get(config('app.token'), true);
                            transfer('Đăng nhập tài khoản thành công', 1, linkReferer());
                            //$secret_key = session()->get($sessionhash);
                            //$admin->where('id', $admin->id)->update(['secret_key' => $secret_key]);
                            //return response()->redirect(url('home'));
                        } else {
                            $login_failed = true;
                        }
                        if ($login_failed) {
                            // $ip = Func::getRealIPAddress();
                            // $row = MemberLimitModel::select('*')
                            //     ->where('login_ip', $ip)
                            //     ->first();
                            // if (!empty($row) == 1) {
                            //     $id_login = $row->id;
                            //     $attempt = $row->login_attempts;
                            //     $noofattmpt = 5;
                            //     if ($attempt < $noofattmpt) {
                            //         $attempt = $attempt + 1;
                            //         MemberLimitModel::where('id', $id_login)->update(['login_attempts' => $attempt]);
                            //         $no_ofattmpt = $noofattmpt + 1;
                            //         $remain_attempt = $no_ofattmpt - $attempt;
                            //         $error = "Sai thông tin còn" . ' ' . $remain_attempt . ' ' . "lần thử";
                            //         return view("component.login.{$this->loginpage}", ['mess' => $error]);
                            //     } else {
                            //         if ($row->locked_time == 0) {
                            //             $attempt = $attempt + 1;
                            //             $timenow = time();
                            //             MemberLimitModel::where('id', $id_login)->update(['login_attempts' => $attempt, 'locked_time' => $timenow]);
                            //         } else {
                            //             $attempt = $attempt + 1;
                            //             MemberLimitModel::where('id', $id_login)->update(['login_attempts' => $attempt]);
                            //         }
                            //         $delay_time = 15;
                            //         $error = "Bạn đã hết số lần thử vui lòng đăng nhập sau" . " " . $delay_time . " " . 'phút';
                            //         return view("component.login.{$this->loginpage}", ['mess' => $error]);
                            //     }
                            // } else {
                            // $timenow = time();
                            //MemberLimitModel::create(['login_ip' => $ip, 'login_attempts' => 1, 'attempt_time' => $timenow, 'locked_time' => 0]);
                            $remain_attempt = 5;
                            $error = '';
                            transfer('Đăng nhập tài khoản thất bại', 0, url('member.login'));
                            //$error = 'Sai thông tin còn' . ' ' . $remain_attempt . ' ' . 'lần thử';
                            //return view("member.{$this->loginpage}", ['mess' => $error]);
                            // }
                        }
                    }
                }
            }
        } else {
            return view("member.{$this->loginpage}", [ 'items' => '', 'mess' => '', 'com' => 'login' ]);
        }
    }
    /* Đăng xuất */
    public function logout()
    {
        if (Auth::guard('member')->check()) {
            Auth::guard('member')->logout();
            transfer('Đăng xuất tài khoản thành công', 1, url('home'));
            //return response()->redirect(url('home'));
        }
    }
    /* Đăng ký [GET/POST] */
    public function registration(Request $request)
    {
        if ($request->isMethod('post')) {
            if (!empty($request->csrf_token)) {
                $this->addMember($request);
            }
        } else {
            return view('member.registration', [ 'mess' => '', 'com' => 'registration' ]);
        }
    }
    protected function addMember($request)
    {
        $validator = Validator::makeValidate($request, [
            'username' => 'unique:user,username;' . $request->input('username'),
            'fullname' => 'required',
            'email' => 'required|email',
            're-password' => 'same:password'
        ], [
            'username.unique' => '*Username đã tồn tại',
            'fullname.required' => '* Vui lòng nhập họ tên',
            're-password.same' => '*Nhập lại mật khẩu không chính xác',
            'email.required' => '* Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
        ]);
        if ($validator->isFailed()) {
            foreach ($request->all() as $k => $v)
                Flash::set($k, $v);
            Flash::set('message', $validator->errors());
            response()->redirect(url('member.registration'));
        }
        $role = [];
        if (!empty($request->input('birthday'))) {
            $birthday = $request->input('birthday');
            $data['birthday'] = strtotime(str_replace("/", "-", $birthday));
        }
        $data['gender'] = $request->input('gender');
        $data['username'] = $request->input('username');
        $data['fullname'] = $request->input('fullname');
        $data['type'] = $request->input('type');
        $data['address'] = $request->input('address');
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['status'] = 'hienthi';
        $data['numb'] = 1;
        $user = MemberModel::create($data);
        $data['code'] = Func::generateRandomString(6) . $user->id;
        MemberModel::where('id', $user->id)->update([ 'password' => Hash::make($request->input('password')), 'code' => $data['code'] ]);
        //if(!empty($role) && config('type.users.permission')) $user->grantRole($role);
        transfer('Tạo tài khoản thành công', 1, url('member.login'));
    }
    /* forgot password */
    public function forgotpass(Request $request)
    {
        if ($request->isMethod('post')) {
            if (!empty($request->csrf_token)) {
                $validator = Validator::makeValidate($request, [
                    'username' => 'required',
                    'email' => 'required|email',
                ], [
                    'username.required' => '* Vui lòng nhập Username',
                    'email.required' => '* Vui lòng nhập email',
                    'email.email' => 'Email không đúng định dạng',
                ]);
                if ($validator->isFailed()) {
                    foreach ($request->all() as $k => $v)
                        Flash::set($k, $v);
                    Flash::set('messageforgot', $validator->errors());
                    response()->redirect(url('member.forgotpass'));
                }
                $username = (!empty($request->username)) ? $request->username : '';
                $email = (!empty($request->email)) ? $request->email : '';
                $checkmember = MemberModel::where('username', '=', $username)->where('email', '=', $email)->first();
                if (!empty($checkmember)) {
                    $Randompassword = Str::password(10, true, true, true, false);
                    $arrayEmail = null;
                    $subject = (!empty($dataContact['subject'])) ? $dataContact['subject'] : 'Thư liên hệ khách hàng';
                    $message = Email::markdown('email_template.member.forgot-password', [ 'username' => $username, 'email' => $email, 'password' => $Randompassword ]);
                    $optCompany = json_decode(Func::setting('options'), true);
                    $company = Func::setting();
                    $file = 'file';
                    if (Email::send("admin", $arrayEmail, $subject, $message, $file, $optCompany, $company)) {
                        $arrayEmail = array(
                            "dataEmail" => array(
                                "name" => $username,
                                "email" => $email
                            )
                        );
                        Email::send("customer", $arrayEmail, $subject, $message, $file, $optCompany, $company);
                        MemberModel::where('username', '=', $username)->where('email', '=', $email)->update([ 'password' => Hash::make($Randompassword) ]);
                        return transfer('Vui lòng kiểm tra email.', true, url('member.login'));
                    } else {
                        return transfer('Thông tin liên hệ được gửi thất bại.', false, url('member.login'));
                    }
                } else {
                    transfer('Lấy lại mật khẩu thất bại, bạn đã nhập sai thông tin .', 1, url('member.forgotpass'));
                }
            }
        } else {
            return view('member.forgotpass', [ 'messageforgot' => '', 'com' => 'forgotpass' ]);
        }
    }
    /*order history */
    public function history()
    {
        $idMember = Auth::guard('member')->user()->id;
        if (empty($idMember))
            return response()->redirect(url('member.login'));
        $itemsHistory = ProductModel::select('*')->get();
        $com = 'history';
        return view('member.history', compact('itemsHistory', 'com'));
    }

    // upload ( thêm truyện/chương mới )
    public function upload($com, $act, $type, Request $request)
    {
        $id = $request->query('id') ?? '';
        $item = [];
        $gallery = [];
        $propertieslist = [];
        $propertiescard = [];


        $configMan = $this->configType->$type;

        if (!empty($id)) {
            $item = ProductModel::select('*')->where('id', $id)->orderBy('numb', 'asc')->first();
        }
        if (!empty($this->configType->$type->gallery) && $item) {
            $gallery = $item->getPhotos('product')->orderBy('numb', 'asc')->get();
        }
        if (!empty($this->configType->$type->properties)) {
            $query = PropertiesListModel::select('*')->where('type', $type);
            if (!empty(config('type.categoriesProperties')) && !empty($item['id_list']))
                $query->whereRaw("FIND_IN_SET(?,id_list)", [ $item['id_list'] ]);
            $propertieslist = $query->orderBy('numb', 'asc')->get();
            $propertiescard = ProductPropertiesModel::select('*')->where('id_parent', $id)->orderBy('id', 'asc')->get();
        }
        return view('member.upload', compact('item', 'gallery', 'propertieslist', 'propertiescard', 'id', 'type', 'com', 'act', 'configMan'));
    }

    // Danh sách truyện theo dõi ( kệ sách )
    public function manBookShelf($com, $act, $type, Request $request)
    {
        if ($request->isMethod('get') && !empty($request->keyword)) {
            $keyword = $request->keyword;
        }
        if ($request->isMethod('get') && !empty($request->id_novel)) {
            $id_novel = $request->id_novel;
        }
        if ($request->isMethod('get') && !empty($request->id_list)) {
            $id_list = $request->id_list;
        }
        if ($request->isMethod('get') && !empty($request->id_cat)) {
            $id_cat = $request->id_cat;
        }
        if ($request->isMethod('get') && !empty($request->id_item)) {
            $id_item = $request->id_item;
        }
        if ($request->isMethod('get') && !empty($request->id_sub)) {
            $id_sub = $request->id_sub;
        }
        $query = ProductModel::select('product.*', 'follow.id as id_follow')
            ->join('follow', 'product.id', '=', 'follow.id_product')
            ->where("follow.id_member", Auth::guard('member')->user()->id)
            ->where('product.type', $type);

        if (!empty($keyword))
            $query->where('namevi', 'like', '%' . $keyword . '%');

        if (!empty($id_novel))
            $query->where('id_novel', $id_novel);

        if (!empty($id_list))
            $query->whereRaw("CONCAT(',',id_list, ',') REGEXP ',(" . str_replace(',', '|', $id_list) . "),'");
        if (!empty($id_cat))
            $query->whereRaw("CONCAT(',',id_cat, ',') REGEXP ',(" . str_replace(',', '|', $id_cat) . "),'");
        if (!empty($id_item))
            $query->whereRaw("CONCAT(',',id_item, ',') REGEXP ',(" . str_replace(',', '|', $id_item) . "),'");
        if (!empty($id_sub))
            $query->whereRaw("CONCAT(',',id_sub, ',') REGEXP ',(" . str_replace(',', '|', $id_sub) . "),'");
        $items = $query
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('member.booksheft', [ 'items' => $items, 'configMan' => $this->configType->$type, 'com' => $com, 'act' => $act, 'type' => $type ]);
    }

    // Xóa truyện từ kệ sách
    public function deleteBookShelf($com, $act, $type, Request $request)
    {

        $idMember = Auth::guard('member')->user()->id;
        if (!empty($request->id)) {
            $id = $request->id;
            $row = FollowModel::select('id', 'photo')
                ->where('id_product', $id)
                ->where('id_member', $idMember)
                ->delete();

        } elseif (!empty($request->listid)) {
            $listid = explode(",", $request->listid);
            for ($i = 0; $i < count($listid); $i++) {
                $id = htmlspecialchars($listid[$i]);
                $row = FollowModel::select('id')
                    ->where('id_product', $id)
                    ->where('id_member', $idMember)
                    ->delete();
            }
        }
        response()->redirect(linkReferer());
    }

    // Handle product
    public function man($com, $act, $type, Request $request)
    {
        if ($request->isMethod('get') && !empty($request->keyword)) {
            $keyword = $request->keyword;
        }
        if ($request->isMethod('get') && !empty($request->id_novel)) {
            $id_novel = $request->id_novel;
        }
        if ($request->isMethod('get') && !empty($request->id_list)) {
            $id_list = $request->id_list;
        }
        if ($request->isMethod('get') && !empty($request->id_cat)) {
            $id_cat = $request->id_cat;
        }
        if ($request->isMethod('get') && !empty($request->id_item)) {
            $id_item = $request->id_item;
        }
        if ($request->isMethod('get') && !empty($request->id_sub)) {
            $id_sub = $request->id_sub;
        }
        $query = ProductModel::select('id', 'id_list', 'id_cat', 'id_item', 'id_sub', 'id_brand', 'namevi', 'photo', 'descvi', 'slugvi', 'status', 'numb', 'properties', 'list_properties')
            ->where('type', $type)
            ->where("id_member", Auth::guard('member')->user()->id);
        if (!empty($keyword))
            $query->where('namevi', 'like', '%' . $keyword . '%');

        if (!empty($id_novel))
            $query->where('id_novel', $id_novel);

        if (!empty($id_list))
            $query->whereRaw("CONCAT(',',id_list, ',') REGEXP ',(" . str_replace(',', '|', $id_list) . "),'");
        if (!empty($id_cat))
            $query->whereRaw("CONCAT(',',id_cat, ',') REGEXP ',(" . str_replace(',', '|', $id_cat) . "),'");
        if (!empty($id_item))
            $query->whereRaw("CONCAT(',',id_item, ',') REGEXP ',(" . str_replace(',', '|', $id_item) . "),'");
        if (!empty($id_sub))
            $query->whereRaw("CONCAT(',',id_sub, ',') REGEXP ',(" . str_replace(',', '|', $id_sub) . "),'");


        if (!empty($type) && $type == 'chuong-truyen') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('numb', 'asc');
        }
        $items = $query

            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('member.list', [ 'items' => $items, 'configMan' => $this->configType->$type, 'com' => $com, 'act' => $act, 'type' => $type ]);
    }
    public function edit($com, $act, $type, Request $request)
    {
        $id = $request->query('id') ?? '';
        $item = [];
        $gallery = [];
        $propertieslist = [];
        $propertiescard = [];
        $configMan = $this->configType->$type;
        if (!empty($id)) {
            $item = ProductModel::select('*')->where('id', $id)->orderBy('numb', 'asc')->first();
        }
        if (!empty($this->configType->$type->gallery) && $item) {
            $gallery = $item->getPhotos('product')->orderBy('numb', 'asc')->get();
        }
        if (!empty($this->configType->$type->properties)) {
            $query = PropertiesListModel::select('*')->where('type', $type);
            if (!empty(config('type.categoriesProperties')) && !empty($item['id_list']))
                $query->whereRaw("FIND_IN_SET(?,id_list)", [ $item['id_list'] ]);
            $propertieslist = $query->orderBy('numb', 'asc')->get();
            $propertiescard = ProductPropertiesModel::select('*')->where('id_parent', $id)->orderBy('id', 'asc')->get();
        }
        return view('member.upload', compact('item', 'gallery', 'propertieslist', 'propertiescard', 'id', 'com', 'act', 'type', 'configMan'));
    }
    public function save($com, $act, $type, Request $request)
    {
        if (!empty($request->csrf_token)) {
            /* Post dữ liệu */

            $message = '';
            $response = array();
            $id = (!empty($request->id)) ? htmlspecialchars($request->id) : 0;
            $data = (!empty($request->data)) ? $request->data : null;
            $dataTags = (!empty($request->input('dataTags'))) ? $request->input('dataTags') : null;
            if ($data) {
                foreach ($data as $column => $value) {
                    if (strpos($column, 'content') !== false || strpos($column, 'desc') !== false) {
                        $data[$column] = htmlspecialchars(Func::sanitize($value, 'iframe'));
                    } else {
                        $data[$column] = $value;
                    }
                }
                if (!empty($this->configType->$type->group)) {
                    $data['id_list'] = !empty($data['id_list']) ? implode(",", $data['id_list']) : '';
                    $data['id_cat'] = !empty($data['id_cat']) ? implode(",", $data['id_cat']) : '';
                    $data['id_item'] = !empty($data['id_item']) ? implode(",", $data['id_item']) : '';
                    $data['id_sub'] = !empty($data['id_sub']) ? implode(",", $data['id_sub']) : '';
                }

                $data['date_publish'] = (!empty($data['date_publish'])) ? Carbon::createFromFormat('d/m/Y H:i', $data['date_publish'])->toDateTimeString() : Carbon::now()->toDateTimeString();
              
                if (!empty($request->status)) {
                    $status = '';
                    foreach ($request->status as $attr_column => $attr_value)
                        if ($attr_value != "")
                            $status .= $attr_column . ',';
                    $data['status'] = (!empty($status)) ? rtrim($status, ",") : "";
                } else {
                    $data['status'] = "";
                }
              
                if (!empty($this->configType->$type->slug)) {
                    if (!empty($request->slugvi))
                        $data['slugvi'] = Func::changeTitle(htmlspecialchars($request->slugvi));
                    else
                        $data['slugvi'] = (!empty($data['namevi'])) ? Func::changeTitle($data['namevi']) : '';
                    if (!empty($request->slugen))
                        $data['slugen'] = Func::changeTitle(htmlspecialchars($request->slugen));
                    else
                        $data['slugen'] = (!empty($data['nameen'])) ? Func::changeTitle($data['nameen']) : '';
                }

                $data['regular_price'] = (!empty($data['regular_price']) && $data['regular_price'] != '') ? str_replace(",", "", $data['regular_price']) : 0;

                $data['sale_price'] = (!empty($data['sale_price']) && $data['sale_price'] != '') ? str_replace(",", "", $data['sale_price']) : 0;

                $data['discount'] = (!empty($data['discount']) && $data['discount'] != '') ? $data['discount'] : 0;

                $data['type'] = $type;
            }

            if (!empty($this->configType->$type->slug)) {
                foreach (config('app.slugs') as $k => $v) {
                    $dataSlug = array();
                    $dataSlug['slug'] = $data['slug' . $k];
                    $dataSlug['id'] = $id;
                    $dataSlug['copy'] = false;

                    $checkSlug = Func::checkSlug($dataSlug);
                    if ($checkSlug == 'exist' && $type != 'chuong-truyen') {
                        $response['messages'][] = 'Đường dẫn đã tồn tại';
                    } else if ($checkSlug == 'empty') {
                        $response['messages'][] = 'Đường dẫn không được trống';
                    }
                    unset($dataSlug);
                }
            }
            if (!empty($response)) {
                /* Flash data */
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        if (!empty($v)) {
                            Flash::set($k, $v);
                        }
                    }
                }
                /* Errors */
                $response['status'] = 'danger';
                $message = base64_encode(json_encode($response));
                Flash::set('message', $message);
                response()->redirect(linkReferer());
            }
            $data['status'] = "hienthi";
            $urlReturn = url('memberHome.list', [ 'com' => 'product', 'act' => 'list', 'type' => $type ], !empty($data['id_novel']) ? [ 'id_novel' => $data['id_novel'] ] : []);
            if ($id) {
                $data['date_updated'] = time();
    
                if (ProductModel::where('id', $id)->where('type', $type)->update($data)) {
                    if (!empty($this->configType->$type->tags)) {
                        $this->insertTags(ProductTagsModel::class, $request, $dataTags, $id, $type);
                    }
                    /* IMAGE */
                    if (!empty($this->configType->$type->images)) {
                        foreach ($this->configType->$type->images as $key => $photo) {
                            $file = $request->file('file-' . $key);
                            $cropFile = $request->{"cropFile-$key"};
                            if (!empty($cropFile)) {
                                $this->insertImgeCrop(ProductModel::class, $request, $file, $cropFile, $id, 'product', $key);
                            } else {
                                $this->insertImge(ProductModel::class, $request, $file, $id, 'product', $key);
                            }
                        }
                    }
                    /* ALBUM */
                    if (!empty($this->configType->$type->gallery)) {
                        $files = (!empty($request->file('files'))) ? $request->file('files') : null;
                        $this->insertImges(GalleryModel::class, $request, $files, $id, $com, $type, $type, 'product');
                    }
                    /* SLUG */
                    if (!empty($this->configType->$type->slug)) {
                        foreach (config('app.slugs') as $k => $v) {
                            $dataSlug['slug' . $k] = $data['slug' . $k];
                            $dataSlug['name' . $k] = $data['name' . $k];
                        }
                        $this->insertSlug($com, $act, $type, $id, $dataSlug, '\NINA\Controllers\Web\ProductController');
                    }
                    return transfer('Cập nhật dữ liệu thành công.', true, $urlReturn);
                } else {
                    return transfer('Cập nhật dữ liệu thất bại.', true, $urlReturn);
                }
            } else {
                $data['date_created'] = time();

                if ($type == 'chuong-truyen') {
                    $getMaxNumb = ProductModel::where('id_novel', $data['id_novel'])->max('numb');
                    $data['numb'] = !empty($getMaxNumb) ? $getMaxNumb + 1 : 1;
                }
                // $data['status'] = 'hienthi';

                $itemSave = ProductModel::create($data);

                if (!empty($itemSave)) {
                    $id_insert = $itemSave->id;

                    // Handle push notification to follower
                    if ($itemSave->type == 'chuong-truyen') {
                        $listFollow = FollowModel::where('id_product', $itemSave->id_novel)->where('type', 'follow')->get();

                        foreach ($listFollow as $follow) {
                            $oldData = !empty($follow->chapter_update) ? json_decode($follow->chapter_update, true) : [];
                            if (!in_array($itemSave->id, $oldData)) {
                                $newData = array_merge($oldData, [ $itemSave->id ]);
                                $follow->chapter_update = json_encode($newData);
                                $follow->save();
                            }
                        }

                        $dataSlugChapter = [];
                        foreach (config('app.slugs') as $k => $v) {
                            $dataSlugChapter['slug' . $k] = $data['slug' . $k] . '-' . $id_insert;
                        }
                        $itemSave->update($dataSlugChapter);
                        $itemSave->save();

                    }

                    if (!empty($this->configType->$type->tags)) {
                        $this->insertTags(ProductTagsModel::class, $request, $dataTags, $id_insert, $type);
                    }

                    /* IMAGE */
                    if (!empty($this->configType->$type->images)) {
                        foreach ($this->configType->$type->images as $key => $photo) {
                            $file = $request->file('file-' . $key);
                            $cropFile = $request->{"cropFile-$key"};
                            if (!empty($cropFile)) {
                                $this->insertImgeCrop(ProductModel::class, $request, $file, $cropFile, $id_insert, 'product', $key);
                            } else {
                                $this->insertImge(ProductModel::class, $request, $file, $id_insert, 'product', $key);
                            }
                        }
                    }

                    /* ALBUM */
                    if (!empty($this->configType->$type->gallery)) {
                        $files = (!empty($request->file('files'))) ? $request->file('files') : null;
                        $this->insertImges(GalleryModel::class, $request, $files, $id_insert, $com, $type, $type, 'product');
                    }

                    /* SLUG */
                    if (!empty($this->configType->$type->slug)) {
                        foreach (config('app.slugs') as $k => $v) {
                            $dataSlug['slug' . $k] = $data['slug' . $k] . '-' . $id_insert;
                            $dataSlug['name' . $k] = $data['name' . $k];
                        }
                        $this->insertSlug($com, $act, $type, $id_insert, $dataSlug, '\NINA\Controllers\Web\ProductController');
                    }

                    response()->redirect($urlReturn);
                } else {
                    response()->redirect($urlReturn);
                }
            }
        }
    }
    public function delete($com, $act, $type, Request $request)
    {
        if (!empty($request->id)) {
            $id = $request->id;
            $row = ProductModel::select('id', 'photo')
                ->where('id', $id)
                ->first();
            $rowGallery = GalleryModel::select('id', 'photo')->where('id_parent', $id)->where('com', $com)->where('type', $type)->get();
            if (!empty($row)) {
                if (File::exists(upload('product', $row['photo'], true))) {
                    File::delete(upload('product', $row['photo'], true));
                }
                ProductModel::where('id', $id)->delete();
            }
            if (!empty($rowGallery)) {
                foreach ($rowGallery as $v) {
                    if (File::exists(upload('product', $v['photo'], true))) {
                        File::delete(upload('product', $v['photo'], true));
                    }
                }
                GalleryModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
            }
            SlugModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
            SeoModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
        } elseif (!empty($request->listid)) {
            $listid = explode(",", $request->listid);
            for ($i = 0; $i < count($listid); $i++) {
                $id = htmlspecialchars($listid[$i]);
                $row = ProductModel::select('id', 'photo')
                    ->where('id', $id)
                    ->first();
                $rowGallery = GalleryModel::select('id', 'photo')->where('id_parent', $id)->where('com', $com)->where('type', $type)->get();
                if (!empty($row)) {
                    if (File::exists(upload('product', $row['photo'], true))) {
                        File::delete(upload('product', $row['photo'], true));
                    }
                    ProductModel::where('id', $id)->delete();
                }
                if (!empty($rowGallery)) {
                    foreach ($rowGallery as $v) {
                        if (File::exists(upload('product', $v['photo'], true))) {
                            File::delete(upload('product', $v['photo'], true));
                        }
                    }
                    GalleryModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
                }
                SlugModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
                SeoModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
            }
        }
        response()->redirect(linkReferer());
    }

    protected function getDistrict($request): void
    {
        $districts = DistrictModel::select([ 'id', 'namevi' ])->where('id_city', $request->id)->get()->toArray();
        response()->json([ 'districts' => $districts ]);
    }
    protected function getWard($request): void
    {
        $wards = WardModel::select([ 'id', 'namevi' ])->where('id_district', $request->id)->get()->toArray();
        response()->json([ 'wards' => $wards ]);
    }
}