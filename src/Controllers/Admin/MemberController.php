<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Controllers\Admin;

use Illuminate\Http\Request;
use NINA\Core\Support\Facades\Auth;
use NINA\Core\Support\Facades\File;
use NINA\Core\Support\Facades\Hash;
use NINA\Core\Support\Facades\Validator;
use NINA\Core\Support\JsonResponse;
use NINA\Models\MemberModel;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Flash;
use NINA\Traits\TraitSave;

class MemberController
{
    use JsonResponse, TraitSave;
    protected $loginpage;
    public function __construct()
    {
        $this->loginpage = config('auth.loginpage') ?? 'cover';
    }
    public function index()
    {
        $items = MemberModel::where('id', '<>', 0)->paginate(10);
        $count = MemberModel::where('id', '<>', 0)->count();
        return view('member.index', compact('items', 'count'));
    }
    public function add()
    {
        $item = [];
        $roles = [];
        return view('member.update', compact('item', 'roles'));
    }
    public function edit(Request $request)
    {
        $id = $request->get('id') ?? 0;
        $item = MemberModel::find($id);
        $roles = [];
        return view('member.update', compact('item', 'roles'));
    }
    public function save(Request $request): void
    {
        if ($request->input('id'))
            $this->editUser($request);
        else
            $this->saveUser($request);
    }
    public function delete(Request $request)
    {
        if (!empty($request->id)) {
            $id = $request->id;

            $row = MemberModel::select('id')
                ->where('id', $id)
                ->first();
            if (!empty($row)) {
                MemberModel::where('id', $id)->delete();
            }
        } elseif (!empty($request->listid)) {
            $listid = explode(",", $request->listid);

            for ($i = 0; $i < count($listid); $i++) {
                $id = htmlspecialchars($listid[$i]);
                $row = MemberModel::select('id')
                    ->where('id', $id)
                    ->first();
                if (!empty($row)) {
                    MemberModel::where('id', $id)->delete();
                }
            }
        }
        transfer('Xóa khoản tài khoản thành công', 1, url('member'));
    }
    protected function saveUser($request)
    {
        $validator = Validator::makeValidate($request, [
            'username' => 'unique:user,username;' . $request->input('username'),
            'fullname' => 'required',
            're-password' => 'same:password'
        ], [
            'username.unique' => '*Username đã tồn tại',
            'fullname.required' => '* Vui lòng nhập họ tên',
            're-password.same' => '*Nhập lại mật khẩu không chính xác'
        ]);

        if ($validator->isFailed()) {
            foreach ($request->all() as $k => $v)
                Flash::set($k, $v);
            Flash::set('message', $validator->errors());
            response()->redirect(url('member.add'));
        }
        $role = [];
        if (!empty($request->input('birthday'))) {
            $birthday = $request->input('birthday');
            $data['birthday'] = strtotime(str_replace("/", "-", $birthday));
        }
        $data['gender'] = $request->input('gender');
        $data['username'] = $request->input('username');
        $data['fullname'] = $request->input('fullname');
        $data['address'] = $request->input('address');
        $data['phone'] = $request->input('phone');
        $data['coin'] = $request->input('coin');
        $data['email'] = $request->input('email');
        $data['status'] = 'hienthi';
        $data['numb'] = 1;
        $user = MemberModel::create($data);
        MemberModel::where('id', $user->id)->update([ 'password' => Hash::make($request->input('password')) ]);
        transfer('Tạo tài khoản khách hàng thành công', 1, url('member'));
    }
    protected function editUser($request)
    {
        $id = $request->input('id');
        $user = MemberModel::find($id);
        if (empty($user))
            transfer('Tạo tài khoản khách hàng không tồn tại', 0, url('member'));
        $validator = Validator::makeValidate($request, [
            'fullname' => 'required',
        ], [
            'fullname.required' => '* Vui lòng nhập họ tên',
        ]);
        if ($validator->isFailed()) {
            foreach ($request->all() as $k => $v)
                Flash::set($k, $v);
            Flash::set('message', $validator->errors());
            response()->redirect(url('member.add'));
        }
        if (!empty($request->input('password'))) {
            $validator = Validator::makeValidate($request, [
                're-password' => 'same:password'
            ], [
                're-password.same' => '*Nhập lại mật khẩu không chính xác'
            ]);
            if ($validator->isFailed()) {
                foreach ($request->all() as $k => $v)
                    Flash::set($k, $v);
                Flash::set('message', $validator->errors());
                response()->redirect(url('member.add'));
            }
            $password = Hash::make($request->input('password'));
        }
        if (!empty($request->input('birthday'))) {
            $birthday = $request->input('birthday');
            $data['birthday'] = strtotime(str_replace("/", "-", $birthday));
        }
        $data['gender'] = $request->input('gender');
        $data['fullname'] = $request->input('fullname');
        $data['address'] = $request->input('address');
        $data['phone'] = $request->input('phone');
        $data['code'] = $request->input('code');
        $data['email'] = $request->input('email');
        $data['status'] = 'hienthi';
        $data['numb'] = 1;
        MemberModel::where('id', $user->id)->update($data);
        if (!empty($password))
            MemberModel::where('id', $user->id)->update([ 'password' => $password ]);
        transfer('Cập nhật tài khoản khách hàng thành công', 1, url('member'));
    }
}
