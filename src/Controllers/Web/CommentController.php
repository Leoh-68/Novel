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
use NINA\Core\Support\Facades\Auth;
use NINA\Controllers\Controller;
use NINA\Models\CommentModel;
use NINA\Models\GalleryModel;
use NINA\Core\Support\Facades\Func;
use NINA\Models\ProductModel;
use NINA\Core\Support\Facades\File;
use NINA\Traits\TraitSave;
use View;

class CommentController extends Controller
{
    private $errors = [], $result = [], $response = [];
    private $upload;
    use TraitSave;

    public function handle($action, Request $request): void
    {
        match ($action) {
            'add-comment' => $this->addComment($request),
            'reply-comment' => $this->replyComment($request),
            'load-comment' => $this->loadComment($request),
            default => 'unknown',
        };
    }
    public function addComment(Request $request)
    {
        $data = (!empty($request->dataReview)) ? $request->dataReview : null;
        $dataPhoto = Func::listsGallery('review-file-photo');

        if (!empty($data)) {
            foreach ($data as $column => $value) {
                $data[$column] = htmlspecialchars(Func::sanitize($value));
            }

            /* Valid data */
            if (isset($data['star']) && empty($data['star'])) {
                $this->errors[] = 'Chưa chọn đánh giá sao';
            }

            if (isset($data['star']) && !empty($data['star']) && !Func::isNumber($data['star'])) {
                $this->errors[] = 'Đánh giá sao không hợp lệ';
            }

            if (isset($data['title']) && empty($data['title'])) {
                $this->errors[] = 'Chưa nhập tiêu đề đánh giá';
            }

            if (!empty($dataPhoto) && count($dataPhoto) > 3) {
                $this->errors[] = 'Hình ảnh không được vượt quá 3 hình';
            }

            if (empty($this->errors)) {

                if (!empty($data['poster']) && $data['poster'] == 'author') {
                    $data['status'] = 'hienthi';
                }
                $data['date_posted'] = time();
                $itemSave = CommentModel::create($data);
                if (!empty($itemSave)) {
                    $id = $itemSave->id;

                    /* IMAGE */
                    if (!empty($dataPhoto)) {
                        $files = (!empty($request->file('review-file-photo'))) ? $request->file('review-file-photo') : null;
                        $this->insertImges(GalleryModel::class, $request, $files, $id, 'comment', $data['type'], $data['type'], 'photo');
                    }
                }
            }
        } else {
            $this->errors[] = 'Dữ liệu không hợp lệ';
        }

        echo $this->response();
    }

    public function replyComment(Request $request)
    {
        $data = (!empty($request->dataReview)) ? $request->dataReview : null;
        if (!empty($data)) {
            foreach ($data as $column => $value) {
                $data[$column] = htmlspecialchars(Func::sanitize($value));
            }
            /* Valid data */
            if (isset($data['title']) && empty($data['title'])) {
                $this->errors[] = 'Chưa nhập tiêu đề đánh giá';
            }
            if (empty($this->errors)) {
                if (!empty($data['poster']) && $data['poster'] == 'author') {
                    $data['status'] = 'hienthi';
                }
                $data['date_posted'] = time();

                CommentModel::create($data);
            }
        } else {
            $this->errors[] = 'Dữ liệu không hợp lệ';
        }
        echo $this->response();
    }

    public function loadComment(Request $request)
    {
        $data = (!empty($request->dataLoad)) ? $request->dataLoad : null;
        if (!empty($data)) {
            $rowDetail = ProductModel::find($data['id']);
            $rowComment = CommentModel::select('*')
                ->where('type', $data['type'])
                ->where('id_parent', 0)
                ->where('id_variant', $data['id'])
                ->skip($data['limit'])->take(2)
                ->get();

            if (($data['limit'] + 2) >= $data['count']) {
                $limit = $data['count'];
                $this->result['pageout'] = true;
            } else {
                $limit = $data['limit'] + 2;
            }
            $this->result['limit'] = $limit;
            $this->result['view'] = View::render('component.comment.loadcomment', [ 'list' => $rowComment, 'rowDetail' => $rowDetail ]);
        } else {
            $this->errors[] = 'Dữ liệu không hợp lệ';
        }
        echo $this->response();
    }

    private function response()
    {
        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        } else if (!empty($this->result)) {
            $response['result'] = $this->result;
        } else {
            $response['success'] = true;
        }

        return json_encode($response);
    }

    public function man(Request $request)
    {

        $configMan = json_decode(json_encode(config('type')), true);
        $configMan = $configMan['comment']['binh-luan'];
        $configMan = json_decode(json_encode($configMan));
        $keyword = $request->keyword;
        $status = $request->status;
        $userLogin = !empty(Auth::guard('member')->user()) ? Auth::guard('member')->user()->id : null;
        $query = CommentModel::select('comment.*')
            ->where('id_parent', 0)
            ->join('product', 'comment.id_variant', '=', 'product.id')
            ->where('product.id_member', $userLogin);
        if (!empty($keyword))
            $query->where('fullname', 'like', '%' . $keyword . '%');
        if (!empty($status))
            $query->where('status', '');
        $items = $query->orderBy('id', 'desc')
            ->paginate(10);

        return view('member.comment.man', [ 'items' => $items, 'com' => 'comment', 'act' => 'man', 'type' => 'comment', 'configMan' => $configMan ]);
    }

    public function edit($com, $act, $type, Request $request)
    {
        $id = $request->id;
        $item = [];

        $configMan = json_decode(json_encode(config('type')), true);
        $configMan = $configMan['comment']['binh-luan'];
        $configMan = json_decode(json_encode($configMan));
        if (!empty($id)) {
            $item = CommentModel::select('*')
                ->where('id', $id)
                ->first();
        }

        return view('member.comment.add', [ 'item' => $item, 'com' => 'comment', 'act' => 'edit', 'type' => 'comment', 'configMan' => $configMan ]);
    }

    public function save($com, $act, $type, Request $request)
    {
        if (!empty($request->csrf_token)) {
            /* Post dữ liệu */

            $user = Auth::guard('member')->user();

            $data = (!empty($request->data)) ? $request->data : null;
            $id = (!empty($data['id_parent'])) ? htmlspecialchars($data['id_parent']) : 0;
            if ($data) {
                foreach ($data as $column => $value) {
                    if (strpos($column, 'content') !== false || strpos($column, 'desc') !== false) {
                        $data[$column] = htmlspecialchars(Func::sanitize($value, 'iframe'));
                    } else {
                        $data[$column] = htmlspecialchars(Func::sanitize($value));
                    }
                }
                $data['status'] = 'hienthi';
                $data['poster'] = 'author';
                $data['fullname'] = $user->fullname;
                $data['id_user'] = $user->id;
                $data['date_posted'] = time();
            }
            if ($id) {
                $itemSave = CommentModel::create($data);
                if (!empty($itemSave)) {
                    return transfer('Cập nhật dữ liệu thành công.', true, url('admin', [ 'com' => $com, 'act' => 'man', 'type' => $type ]));
                } else {
                    return transfer('Cập nhật dữ liệu thất bại.', true, linkReferer());
                }
            }
        }
    }

    public function delete($com, $act, $type, Request $request)
    {
        if (!empty($request->id)) {
            $id = $request->id;
            $row = CommentModel::select('id', 'photo')
                ->where('id', $id)
                ->first();
            $rowGallery = GalleryModel::select('id', 'photo')->where('id_parent', $id)->where('com', $com)->where('type', $type)->get();
            if (!empty($row)) {
                if (File::exists(upload('photo', $row['photo']))) {
                    File::delete(upload('photo', $row['photo']));
                }
                CommentModel::where('id', $id)->delete();
                CommentModel::where('id_parent', $id)->delete();
            }
            if (!empty($rowGallery)) {
                foreach ($rowGallery as $v) {
                    if (File::exists(upload('photo', $v['photo']))) {
                        File::delete(upload('photo', $v['photo']));
                    }
                }
                GalleryModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
            }
        } elseif (!empty($request->listid)) {
            $listid = explode(",", $request->listid);

            for ($i = 0; $i < count($listid); $i++) {
                $id = htmlspecialchars($listid[$i]);
                $row = CommentModel::select('id', 'photo')
                    ->where('id', $id)
                    ->first();
                $rowGallery = GalleryModel::select('id', 'photo')->where('id_parent', $id)->where('com', $com)->where('type', $type)->get();
                if (!empty($row)) {
                    if (File::exists(upload('photo', $row['photo']))) {
                        File::delete(upload('photo', $row['photo']));
                    }
                    CommentModel::where('id', $id)->delete();
                    CommentModel::where('id_parent', $id)->delete();
                }
                if (!empty($rowGallery)) {
                    foreach ($rowGallery as $v) {
                        if (File::exists(upload('photo', $v['photo']))) {
                            File::delete(upload('photo', $v['photo']));
                        }
                    }
                    GalleryModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->delete();
                }
            }
        }
        response()->redirect(url('admin', [ 'com' => $com, 'act' => 'man', 'type' => $type ]));
    }
}
