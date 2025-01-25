@extends('layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y container-fluid" x-data="{ showAddCoin: false, idMember: 0 }">
        <h4>
            <span>Quản lý khách hàng </span>
        </h4>
        @component('component.buttonMan', ['linkAddC' => url('member.add')])
        @endcomponent

        <div class="card mb-3">


            <div class="card-datatable table-responsive">
                <table class="datatables-category-list table border-top text-sm">
                    <thead>
                        <tr>
                            <th class="align-middle w-[60px]">
                                <div class="custom-control custom-checkbox my-checkbox">
                                    <input type="checkbox" class="form-check-input" id="selectall-checkbox">
                                </div>
                            </th>
                            <th class="text-center w-[70px] !pl-0">STT</th>
                            <th>Username</th>
                            <th>Họ tên</th>
                            <th>Loại thành viên</th>
                            <th>Công cụ</th>
                            <th>Số hoa</th>
                            <th class="text-lg-center text-center">Kích hoạt</th>
                            <th class="text-lg-center text-center">Thao tác</th>
                        </tr>
                    </thead>
                    @if (empty($count))
                        <tbody>
                            <tr>
                                <td colspan="100" class="text-center">Không có dữ liệu thành viên</td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            @foreach ($items ?? [] as $k => $v)
                                <tr>
                                    <td class="align-middle">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input" id="select-checkbox1"
                                                value="{{ $v['id'] }}">
                                        </div>
                                    </td>
                                    <td class="align-middle w-[70px] !pl-0">
                                        @component('component.inputNumb', ['numb' => $v['numb'], 'idtbl' => $v['id'], 'table' => 'member'])
                                        @endcomponent
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" class="text-dark text-break">{{ $v['username'] }}</a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" class="text-dark text-break">{{ $v['fullname'] }}</a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)"
                                            class="text-dark text-break">{{ Func::getTypeMember($v['type']) }}</a>
                                    </td>
                                    <td class="align-middle">

                                        <button class="btn btn-sm btn-primary"
                                            @click="showAddCoin = true;idMember = {{ $v['id'] }}">
                                            +
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-clover">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 10l-3.397 -3.44a2.104 2.104 0 0 1 0 -2.95a2.04 2.04 0 0 1 2.912 0l.485 .39l.485 -.39a2.04 2.04 0 0 1 2.912 0a2.104 2.104 0 0 1 0 2.95l-3.397 3.44z" />
                                                <path
                                                    d="M12 14l-3.397 3.44a2.104 2.104 0 0 0 0 2.95a2.04 2.04 0 0 0 2.912 0l.485 -.39l.485 .39a2.04 2.04 0 0 0 2.912 0a2.104 2.104 0 0 0 0 -2.95l-3.397 -3.44z" />
                                                <path
                                                    d="M14 12l3.44 -3.397a2.104 2.104 0 0 1 2.95 0a2.04 2.04 0 0 1 0 2.912l-.39 .485l.39 .485a2.04 2.04 0 0 1 0 2.912a2.104 2.104 0 0 1 -2.95 0l-3.44 -3.397z" />
                                                <path
                                                    d="M10 12l-3.44 -3.397a2.104 2.104 0 0 0 -2.95 0a2.04 2.04 0 0 0 0 2.912l.39 .485l-.39 .485a2.04 2.04 0 0 0 0 2.912a2.104 2.104 0 0 0 2.95 0l3.44 -3.397z" />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="align-middle">
                                        <a id="coin-{{ $v['id'] }}" href="javascript:void(0)"
                                            class="text-dark text-break">{{ $v['coin'] }} </a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-clover">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 10l-3.397 -3.44a2.104 2.104 0 0 1 0 -2.95a2.04 2.04 0 0 1 2.912 0l.485 .39l.485 -.39a2.04 2.04 0 0 1 2.912 0a2.104 2.104 0 0 1 0 2.95l-3.397 3.44z" />
                                            <path
                                                d="M12 14l-3.397 3.44a2.104 2.104 0 0 0 0 2.95a2.04 2.04 0 0 0 2.912 0l.485 -.39l.485 .39a2.04 2.04 0 0 0 2.912 0a2.104 2.104 0 0 0 0 -2.95l-3.397 -3.44z" />
                                            <path
                                                d="M14 12l3.44 -3.397a2.104 2.104 0 0 1 2.95 0a2.04 2.04 0 0 1 0 2.912l-.39 .485l.39 .485a2.04 2.04 0 0 1 0 2.912a2.104 2.104 0 0 1 -2.95 0l-3.44 -3.397z" />
                                            <path
                                                d="M10 12l-3.44 -3.397a2.104 2.104 0 0 0 -2.95 0a2.04 2.04 0 0 0 0 2.912l.39 .485l-.39 .485a2.04 2.04 0 0 0 0 2.912a2.104 2.104 0 0 0 2.95 0l3.44 -3.397z" />
                                        </svg>
                                    </td>

                                    @php $status_array = (!empty($v['status'])) ? explode(',', $v['status']) : []; @endphp
                                    <td class="align-middle text-center">
                                        <label class="switch switch-primary">
                                            <input type="checkbox" class="switch-input custom-control-input show-checkbox"
                                                id="show-checkbox-hienthi-{{ $v['id'] }}" data-table="member"
                                                data-id="{{ $v['id'] }}" data-attr="hienthi"
                                                data-url="{{ url('status') }}"
                                                {{ in_array('hienthi', $status_array) ? 'checked' : '' }}>
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"> <i class="ti ti-check"></i> </span>
                                                <span class="switch-off"> <i class="ti ti-x"></i> </span>
                                            </span>
                                        </label>
                                    </td>

                                    <td class="align-middle text-center">

                                        @component('component.buttonList', [
                                            'params' => [
                                                'id' => $v['id'],
                                            ],
                                        ])
                                            <a class="text-primary mr-2"
                                                href="{{ url('member.edit', null, ['action' => 'changepass', 'id' => $v['id']]) }}"><i
                                                    class="ti ti-lock-open" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                    data-bs-placement="top" title="Cập nhật mật khẩu"></i></a>
                                        @endcomponent
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>

        <div class="wrap-add-coin" id="wrap-add-coin" @click="showAddCoin = false" style="display: none;"
            x-show="showAddCoin" x-transition>
            <div class="wrap-add-coin-content" @click.stop>
                <div class="close-add-coin" @click="showAddCoin = false">
                    <i class="ti ti-x"></i>
                </div>
                <form method="post" enctype ="multipart/form-data" @submit.prevent="addCoin($event.target)">
                    <div class="title-form">Thêm Hoa</div>
                    <input type="hidden" name="id" :value="idMember">
                    <input type="hidden" name="id_user" value="{{ \Auth::guard('admin')->user()->id }}">
                    <div class="flex items-center">
                        <input type="number" min="1" name="coin" class="form-control"
                            placeholder="Nhập số hoa">
                        <button @click="showAddCoin = false" type="submit" class="btn btn-primary">Thêm</button>
                    </div>

                </form>
            </div>
        </div>

        {!! $items->appends(request()->query())->links() !!}

        @component('component.buttonMan', ['linkAddC' => url('member.add')])
        @endcomponent

    </div>

@endsection
