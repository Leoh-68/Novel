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
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\File;
use NINA\Core\Support\Facades\Auth;
use DB;
use NINA\Models\UserActionHistory;
use NINA\Models\MemberModel;
use NINA\Models\NewslettersModel;
use NINA\Models\SlugModel;
use NINA\Models\ProductModel;
use NINA\Models\LinkModel;
use NINA\Traits\TraitSave;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Core\Container;
class ApiController
{
    public function token(Request $request)
    {
        $token = csrf_token();
        echo $token;
    }

    public function status(Request $request)
    {
        $table = (!empty($request->table)) ? htmlspecialchars($request->table) : '';
        $id = (!empty($request->id)) ? htmlspecialchars($request->id) : 0;
        $attr = (!empty($request->attr)) ? htmlspecialchars($request->attr) : '';
        if ($id) {
            $status_detail = DB::table($table)->select('status')->where('id', $id)->first();
            $status_array = (!empty($status_detail->status)) ? explode(',', $status_detail->status) : array();
            if (array_search($attr, $status_array) !== false) {
                $key = array_search($attr, $status_array);
                unset($status_array[$key]);
            } else {
                array_push($status_array, $attr);
            }
            DB::table($table)->where('id', $id)->update([ 'status' => implode(',', $status_array) ]);
        }
    }
    public function numb(Request $request)
    {

        $table = (!empty($request->table)) ? htmlspecialchars($request->table) : '';
        $id = (!empty($request->id)) ? htmlspecialchars($request->id) : 0;
        $value = (!empty($request->value)) ? htmlspecialchars($request->value) : '';
        if ($id) {
            $data['numb'] = $value;
 
            DB::table($table)->where('id', $id)->update($data);
        }
    }
    public function donate(Request $request)
    {

        $idMember = (!empty($request->id_member)) ? htmlspecialchars($request->id_member) : '';
        $idAuthor = (!empty($request->id_author)) ? htmlspecialchars($request->id_author) : '';
        $numberFlower = (!empty($request->number_flower)) ? htmlspecialchars($request->number_flower) : '';

        // Updtae coin of member
        $member = MemberModel::where('id', $idMember)->first();
        if ($member) {
            $member->coin = $member->coin - $numberFlower;
            $member->save();
        }

        // Update coin of author
        $author = MemberModel::where('id', $idAuthor)->first();
        if ($author) {
            $author->coin = $author->coin + $numberFlower;
            $author->save();
        }

        // Save log
        $data['id_member'] = $idMember;
        $data['id_user'] = $idAuthor;
        $data['number_coin'] = $numberFlower;
        $data['contentvi'] = $member->fullname . ' đã đóng góp ' . $numberFlower . ' hoa cho' . $author->fullname;
        $data['type'] = 'donate';
        $data['created_at'] = date('Y-m-d H:i:s');
        UserActionHistory::create($data);
        Auth::guard('member')->user()->refresh();
        transfer('Đóng góp thành công.', true, linkReferer());
    }


    public function filer(Request $request)
    {
        $cmd = (!empty($request->cmd)) ? trim(htmlspecialchars($request->cmd)) : '';
        $id = (!empty($request->id)) ? trim(htmlspecialchars($request->id)) : 0;
        $com = (!empty($request->com)) ? trim(htmlspecialchars($request->com)) : '';
        $type = (!empty($request->type)) ? trim(htmlspecialchars($request->type)) : '';
        $id_parent = (!empty($request->id_parent)) ? trim(htmlspecialchars($request->id_parent)) : 0;
        $folder = (!empty($request->folder)) ? trim(htmlspecialchars($request->folder)) : '';
        $info = (!empty($request->info)) ? trim(htmlspecialchars($request->info)) : '';
        $value = (!empty($request->value)) ? trim(htmlspecialchars($request->value)) : '';
        $listid = (!empty($request->listid)) ? $request->listid : array();
        if ($cmd == 'delete' && $id > 0) {
            $row = GalleryModel::select('photo')->where('id', $id)->first();
            if (!empty($row)) {
                if (File::exists(upload($folder, $row['photo'], true))) {
                    File::delete(upload($folder, $row['photo'], true));
                }
            }
            GalleryModel::where('id', $id)->delete();
        } else if ($cmd == 'edit' && $id > 0) {
            $gallery = array();
            $gallery[$info] = $value;
            GalleryModel::where('id', $id)->update($gallery);
        } else if ($cmd == 'delete-all' && $listid != '') {
            $listid = explode(",", $listid);
            for ($i = 0; $i < count($listid); $i++) {
                $row = GalleryModel::select('id', 'photo')->where('id', $listid[$i])->first();
                if (!empty($row)) {
                    if (File::exists(upload($folder, $row['photo'], true))) {
                        File::delete(upload($folder, $row['photo'], true));
                    }
                    GalleryModel::where('id', $row['id'])->delete();
                }
            }
        } else if ($cmd == 'updateNumb') {
            if ($id_parent) {
                $row = GalleryModel::select('id', 'numb')
                    ->where('id_parent', $id_parent)
                    ->where('com', $com)
                    ->where('type', $type)
                    ->where('type_parent', $type)
                    ->orderBy('numb', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();
            }
            if ($listid) {
                for ($i = 0; $i < count($listid); $i++) {
                    $arrId[] = $listid[$i];
                    $arrNumb[] = $row[$i]['numb'];
                    $data['numb'] = $row[$i]['numb'];
                    GalleryModel::where('id', $listid[$i])->update($data);
                }
                $data = array( 'id' => $arrId, 'numb' => $arrNumb );
                echo json_encode($data);
            }
        }
    }
}