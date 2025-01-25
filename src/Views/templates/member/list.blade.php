@extends('member.layoutExtendAdm')
@section('content')
    <div class="wrap-content padding-main">
        <div class="container-xxl flex-grow-1 container-p-y container-fluid">
            <h4>
                <span>Quản lý sản phẩm</span>
            </h4>
            @component('component.buttonMan')
            @endcomponent

            <div class="card pd-15 bg-main mb-3">
                <div class="col-md-3">
                    @component('component.inputSearch', ['title' => 'Tìm kiếm danh mục'])
                    @endcomponent
                </div>
            </div>
            @if (!empty($configMan->categories))
                <form action="">
                    <div class="card pd-15 bg-main mb-3">
                        <div class="row">

                            @if (!empty($configMan->categories->list))
                                <div class="form-group col-md-3 last:!mb-0 md:!mb-0">
                                    {!! Func::getLinkCategory('product_list', 'list', $type, 'Danh mục cấp 1') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            @endif
            <div class="card">
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
                                <th width="20%">Tiêu đề</th>
                                <th>Hình ảnh</th>
                                @if (empty($configMan->isChapter))
                                    <th>Công cụ</th>
                                @endif
                                @foreach ($configMan->status ?? [] as $key => $value)
                                    <th class="text-lg-center text-center">{{ $value }}</th>
                                @endforeach
                                <th class="text-lg-center text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $k => $v)
                                <tr>
                                    <td class="align-middle">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input" id="select-checkbox1"
                                                value="{{ $v['id'] }}">
                                        </div>
                                    </td>
                                    <td class="align-middle w-[70px] !pl-0">
                                        @component('component.inputNumb', ['numb' => $v['numb'], 'idtbl' => $v['id'], 'table' => 'product'])
                                        @endcomponent
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-dark text-break">{{ $v['namevi'] }}</a>
                                        <div class="tool-action mt-2 w-clear">
                                            @component('component.buttonAction', [
                                                'slug' => $v['slugvi'],
                                                'params' => [
                                                    'id' => $v['id'],
                                                    'id_list' => $v['id_list'],
                                                    'id_cat' => $v['id_cat'],
                                                    'id_item' => $v['id_item'],
                                                    'id_sub' => $v['id_sub'],
                                                    'id_brand' => $v['id_brand'],
                                                ],
                                            ])
                                                @if (!empty($configMan->properties) && !empty(Func::checkPhotoProperties($v['list_properties'])))
                                                    <a
                                                        href="{{ url('admin', ['com' => 'product-photo', 'act' => 'man', 'type' => $type], ['id_product' => $v['id']]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-photo-circle-plus"
                                                            width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M15 8h.01" />
                                                            <path
                                                                d="M20.964 12.806a9 9 0 0 0 -8.964 -9.806a9 9 0 0 0 -9 9a9 9 0 0 0 9.397 8.991" />
                                                            <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l4 4" />
                                                            <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" />
                                                            <path d="M16 19.33h6" />
                                                            <path d="M19 16.33v6" />
                                                        </svg>
                                                        Thêm ảnh
                                                    </a>
                                                @endif
                                            @endcomponent
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <img class="img-preview" onerror=this.src="@asset('assets/images/noimage.png')";
                                            src="{{ assets_photo('product', '70x70x1', $v['photo'], 'thumbs') }}"
                                            alt="{{ $v['namevi'] }}" title="{{ $v['namevi'] }}" />
                                    </td>
                                    @if (empty($configMan->isChapter))
                                        <td class="align-middle">
                                            <a href="{{ url('memberHome.upload', ['com' => 'product', 'act' => 'add', 'type' => 'chuong-truyen'], ['id_novel' => $v['id']]) }}"
                                                class=" text-decoration-none ">
                                                <button class="btn btn-primary">
                                                    Thêm chap
                                                </button>
                                            </a>

                                            <a href="{{ url('memberHome.list', ['com' => 'product', 'act' => 'list', 'type' => 'chuong-truyen'], ['id_novel' => $v['id']]) }}"
                                                class=" text-decoration-none ">
                                                <button class="btn btn-primary">
                                                    Danh mục chap
                                                </button>
                                            </a>

                                        </td>
                                    @endif
                                    @foreach ($configMan->status ?? [] as $key => $value)
                                        @php $status_array = (!empty($v['status'])) ? explode(',', $v['status']) : array(); @endphp
                                        <td class="align-middle text-center">
                                            <label class="switch switch-success">
                                                @component('component.switchButton', [
                                                    'keyC' => $key,
                                                    'idC' => $v['id'],
                                                    'tableC' => 'product',
                                                    'status_arrayC' => $status_array,
                                                ])
                                                @endcomponent
                                            </label>
                                        </td>
                                    @endforeach

                                    <td class="align-middle text-center">
                                        @component('component.buttonList', [
                                            'params' => [
                                                'id' => $v['id'],
                                                'id_list' => $v['id_list'],
                                                'id_cat' => $v['id_cat'],
                                                'id_item' => $v['id_item'],
                                                'id_sub' => $v['id_sub'],
                                                'id_brand' => $v['id_brand'],
                                            ],
                                        ])
                                        @endcomponent
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {!! $items->appends(request()->query())->links() !!}
        </div>
    </div>
@endsection
