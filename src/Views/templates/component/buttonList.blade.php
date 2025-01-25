@php
    $kind = !empty($kind) ? '.' . $kind : '';
    $params['page'] = 1;
@endphp

{!! $slot !!}

<a class="text-primary mr-2" href="{{url('memberHome.edit', ['com' => $com, 'act' => 'edit', 'type' => $type], $params ?? []) }}""><i
        class="ti ti-edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
        title="Chỉnh sửa"></i></a>

<a class="text-danger cursor-pointer" id="delete-item"
    data-url="{{ url('memberHome.delete', ['com' => $com, 'act' => 'edit', 'type' => $type], $params ?? []) }}""><i class="ti ti-trash"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Xóa"></i></a>
