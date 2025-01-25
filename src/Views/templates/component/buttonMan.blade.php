@php
    $kind = !empty($kind) ? '.' . $kind : '';
    $com = !empty($com) ? $com : '';
    $type = !empty($type) ? $type : '';
    $id_novel = $_GET['id_novel'] ?? null;
    !empty($id_novel) ? $params['id_novel'] = $id_novel : '';
@endphp

<div class="card pd-15 bg-main mb-3 navbar-detached">
    <div class="d-flex gap-2">
        <a class="btn btn-primary text-white"
            href="{{ url('memberHome.upload', ['com' => $com, 'act' => 'add', 'type' => $type], $params ?? []) }}"
            title="Thêm mới"><i class="ti ti-plus mr-2"></i>Thêm mới</a>

        <a class="btn btn-secondary text-white"
            id="delete-all"
            data-url="{{ url('memberHome.delete', ['com' => $com, 'act' => 'delete', 'type' => $type], $params ?? []) }}"
            title="Xóa tất cả"><i class="ti ti-trash mr-2"></i>Xóa tất cả</a>
    </div>
</div>
