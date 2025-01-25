@extends('member.layoutExtendAdm')
@section('content')
    <div class="wrap-content padding-main">
        <div class="container-xxl flex-grow-1 container-p-y container-fluid">
            <h4>
                <span>Kệ sách của bạn</span>
            </h4>
            @php
                $kind = !empty($kind) ? '.' . $kind : '';
                $com = !empty($com) ? $com : '';
                $type = !empty($type) ? $type : '';
                $id_novel = $_GET['id_novel'] ?? null;
                !empty($id_novel) ? ($params['id_novel'] = $id_novel) : '';
            @endphp

            <div class="card pd-15 bg-main mb-3 navbar-detached">
                <div class="d-flex gap-2">

                    <a class="btn btn-secondary text-white" id="delete-all"
                        data-url="{{ url('memberHome.deleteBookShelf', ['com' => $com, 'act' => 'delete', 'type' => $type], $params ?? []) }}"
                        title="Xóa tất cả"><i class="ti ti-trash mr-2"></i>Xóa tất cả</a>
                </div>
            </div>


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
                                <th>Chương mới</th>
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
                                            <a class="text-primary mr-3" href="{{ url('slugweb', ['slug' => $v['slugvi']]) }}"
                                                target="_blank">
                                                <i class="ti ti-eye-check mr-1"></i>
                                                View</a>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <img class="img-preview" onerror=this.src="@asset('assets/images/noimage.png')";
                                            src="{{ assets_photo('product', '70x70x1', $v['photo'], 'thumbs') }}"
                                            alt="{{ $v['namevi'] }}" title="{{ $v['namevi'] }}" />
                                    </td>
                                    <td class="align-middle">
                                        @php
                                            $followedNovel = Func::getFollowedChapterUpdate(
                                                Auth::guard('member')->user()->id,
                                                $v['id'],
                                            );
                                        @endphp
                                        @if (!empty($followedNovel->chapter_update) && count(json_decode($followedNovel->chapter_update, true)) > 0)
                                            <span
                                                class="badge bg-success">{{ count(json_decode($followedNovel->chapter_update, true)) }} Chương mới cập nhật</span>
                                        @else
                                            <span class="badge bg-danger">Chưa có chương mới</span>
                                        @endif
                                    </td>


                                    <td class="align-middle text-center">
                                        <a class="text-danger cursor-pointer" id="delete-item"
                                            data-url="{{ url('memberHome.deleteBookShelf', ['com' => $com, 'act' => 'delete', 'type' => $type], $params ?? []) }}"">
                                            <i class="ti ti-trash" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top" title="Xóa">
                                            </i>
                                        </a>
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
