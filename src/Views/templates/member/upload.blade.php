@extends('member.layoutExtendAdm')
@section('content')
    <div class="wrap-content padding-main">
        <div class="container-xxl flex-grow-1 container-p-y container-fluid">
            <div class="app-ecommerce">
                <form class="validation-form" name="form" novalidate method="post"
                    action="{{ url('memberHome.save', ['com' => $com, 'act' => 'save', 'type' => $type], ['id' => $item['id'] ?? 0]) }}"
                    enctype="multipart/form-data">
                    @component('component.buttonAdd')
                    @endcomponent
                    {!! Flash::getMessages('admin') !!}
                    <input type="text" name="data[id_member]" hidden value="{{ Auth::guard('member')->user()->id }}">
                    @php
                        $id_novel = false;
                        //Khi thêm chương mới của 1 truyện
                        if ($act == 'add') {
                            $id_novel = $_GET['id_novel'] ?? false;
                        }
                        //Khi edit chương của 1 truyện
                        elseif ($type == 'chuong-truyen') {
                            $id_novel = $item['id_novel'] ?? false;
                        }
                        //Khi edit 1 truyện
                        else {
                            $id_novel = $item['id'] ?? false;
                        }
                    @endphp
                    @if ($id_novel)
                        <input type="text" name="data[id_novel]" hidden value="{{ $id_novel }}">
                    @endif
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            @if (!empty($configMan->slug))
                                @php
                                    $slugchange = $act == 'edit' ? 1 : 0;
                                @endphp
                                @component('component.slug', ['slugchange' => $slugchange, 'item' => $item ?? []])
                                @endcomponent
                            @endif
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin {{ $configMan->title_main }} </h3>
                                </div>
                                <div class="card-body card-article">
                                    @component('component.content', [
                                        'name' => $configMan->name ?? false,
                                        'desc' => $configMan->desc ?? false,
                                        'desc_cke' => $configMan->desc_cke ?? false,
                                        'content' => $configMan->content ?? false,
                                        'content_cke' => $configMan->content_cke ?? false,
                                        'parameter' => $configMan->parameter ?? false,
                                        'parameter_cke' => $configMan->parameter_cke ?? false,
                                        'promotion' => $configMan->promotion ?? false,
                                        'promotion_cke' => $configMan->promotion_cke ?? false,
                                        'incentives' => $configMan->incentives ?? false,
                                        'incentives_cke' => $configMan->incentives_cke ?? false,
                                        'item' => $item,
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            @php
                                $listChapter = Func::getChapterFromNovel($id_novel)->get();
                            @endphp
                            @if ($listChapter->isNotEmpty())
                                <div class="card mb-4 form-group-category">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Danh mục chương truyện</h5>
                                    </div>

                                    <div class="card-body card-tree-chapter">
                                        @if (!empty($listChapter))
                                            <ul class="list-unstyled mb-0" x-data="{ open: true }">
                                                <li>
                                                    <div @click="open = !open"
                                                        class="flex items-center gap-2 cursor-pointer ">
                                                        <span class=" line-clamp-1">
                                                            {{ Func::getNovel($id_novel)->namevi }}
                                                        </span>
                                                        <i class="shrink-0 transition-all duration-300"
                                                            :class="open ? 'fa-solid fa-chevron-down' :
                                                                'fa-solid fa-chevron-down'"
                                                            :style="open ? '' : 'transform: rotate(-90deg)'"></i>
                                                    </div>
                                                    <ul x-show="open" x-transition>
                                                        @foreach ($listChapter as $v)
                                                            <li class="mt-2">
                                                                <a href="{{ url('memberHome.edit', ['com' => $com, 'act' => 'edit', 'type' => 'chuong-truyen'], ['id' => $v['id']]) }}"
                                                                    class=" text-decoration-none {{ !empty($item) && $item->id == $v->id ? 'active' : '' }} ">
                                                                    {{ $v['namevi'] }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if (!empty($configMan->categories) || !empty($configMan->tags) || !empty($configMan->brand))
                                <div class="card mb-4 form-group-category">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Danh mục sản phẩm</h5>
                                    </div>
                                    <div class="card-body">
                                        @if (!empty($configMan->group))
                                            @if (!empty($configMan->categories->list))
                                                <div class="form-group last:!mb-0">
                                                    <label class="form-label" for="id_list">Danh mục cấp 1:</label>
                                                    {!! Func::getAjaxCategoryGroup('product_list', 'product_cat', 'list', $type, 'Danh mục cấp 1') !!}
                                                </div>
                                            @endif
                                            @if (!empty($configMan->categories->cat))
                                                <div class="form-group last:!mb-0">
                                                    <label class="form-label" for="id_list">Danh mục cấp 2:</label>
                                                    {!! Func::getAjaxCategoryGroup('product_cat', 'product_item', 'cat', $type, 'Danh mục cấp 2') !!}
                                                </div>
                                            @endif
                                            @if (!empty($configMan->categories->item))
                                                <div class="form-group last:!mb-0">
                                                    <label class="form-label" for="id_list">Danh mục cấp 3:</label>
                                                    {!! Func::getAjaxCategoryGroup('product_item', 'product_sub', 'item', $type, 'Danh mục cấp 3') !!}
                                                </div>
                                            @endif
                                            @if (!empty($configMan->tags))
                                                <div class="form-group last:!mb-0">
                                                    <label class="form-label" for="id_tags">Danh mục tags:</label>
                                                    {!! Func::getTags(@$item['id'], 'dataTags', 'product_tags', $type) !!}
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            @endif
                            @if (!empty($configMan->images))
                                @foreach ($configMan->images as $key => $photo)
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">{{ $photo->title }}</h5>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                /* Photo detail */
                                                $photoDetail = [];
                                                $photoAction = 'photo';
                                                $photoDetail['upload'] = 'product';
                                                $photoDetail['image'] = !empty($item) ? $item[$key] : '';
                                                $photoDetail['dimension'] =
                                                    'Width: ' .
                                                    $configMan->images->$key->width .
                                                    ' px - Height: ' .
                                                    $configMan->images->$key->height .
                                                    ' px (' .
                                                    config('type.type_img') .
                                                    ')';
                                            @endphp
                                            @component('component.image', ['photoDetail' => $photoDetail, 'photoAction' => 'photo', 'key' => $key])
                                            @endcomponent
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="card mb-4">
                                @component('component.tinhtrang', ['item' => $item ?? [], 'status' => $configMan->status ?? [], 'stt' => true])
                                @endcomponent
                            </div>


                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin {{ $configMan->title_main }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if (!empty($configMan->code))
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="code">Mã sản phẩm:</label>
                                            <input type="text" class="form-control" name="data[code]" id="code"
                                                placeholder="Mã sản phẩm"
                                                value="{{ !empty(Flash::has('code')) ? Flash::get('code') : @$item['code'] }}">
                                        </div>
                                    @endif
                                    @if (!empty($configMan->novel_price))
                                        <div class="form-group col-md-4 last:!mb-0 md:!mb-0">
                                            <label class="form-label" for="novel_price">Giá:</label>
                                            <div class="input-group">
                                                <input type="text" name="data[novel_price]"
                                                    class="form-control novel_price" placeholder="Giá"
                                                    aria-label="Giá" id="novel_price" aria-describedby="novel_price"
                                                    value="{{ !empty(Flash::has('novel_price')) ? Flash::get('novel_price') : @$item['novel_price'] }}" />
                                                <span class="input-group-text" id="novel_price">Hoa</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">

                                    @if (!empty($configMan->regular_price))
                                        <div class="form-group col-md-4 last:!mb-0 md:!mb-0">
                                            <label class="form-label" for="regular_price">Giá:</label>
                                            <div class="input-group">
                                                <input type="text" name="data[regular_price]"
                                                    class="form-control format-price regular_price" placeholder="Giá"
                                                    aria-label="Giá" id="regular_price" aria-describedby="regular_price"
                                                    value="{{ !empty(Flash::has('regular_price')) ? Flash::get('regular_price') : @$item['regular_price'] }}" />
                                                <span class="input-group-text" id="regular_price">VNĐ</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty($configMan->sale_price))
                                        <div class="form-group col-md-4 last:!mb-0 md:!mb-0">
                                            <label class="form-label" for="regular_price">Giá khuyến mãi:</label>
                                            <div class="input-group">
                                                <input type="text" name="data[sale_price]"
                                                    class="form-control format-price sale_price" placeholder="Giá"
                                                    aria-label="Giá khuyến mãi" id="sale_price"
                                                    aria-describedby="sale_price"
                                                    value="{{ !empty(Flash::has('sale_price')) ? Flash::get('sale_price') : @$item['sale_price'] }}" />
                                                <span class="input-group-text" id="sale_price">VNĐ</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty($configMan->sale_price))
                                        <div class="form-group col-md-4 last:!mb-0 md:!mb-0">
                                            <label class="form-label" for="discount">Chiếc khấu:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control  discount text-sm"
                                                    name="data[discount]" id="discount" aria-label="Chiếc khấu"
                                                    placeholder="Chiếc khấu"
                                                    value="{{ !empty(Flash::has('discount')) ? Flash::get('discount') : @$item['discount'] }}"
                                                    maxlength="3" readonly>
                                                <span class="input-group-text" id="discount">%</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!empty($configMan->gallery))
                        @component('component.filergallery', [
                            'title_main' => $configMan->title_main,
                            'gallery' => $gallery ?? [],
                            'act' => $act,
                            'folder' => 'product',
                        ])
                        @endcomponent
                    @endif
                    {{--                     
                    @if (!empty($configMan->seo))
                        @component('component.seo', ['item' => $item ?? [], 'com' => $com, 'schema' => $configMan->schema])
                        @endcomponent
                    @endif
                    @if (!empty($configMan->schema))
                        @component('component.schema', ['item' => $item ?? []])
                            <input type="hidden" id="schema-type" value="product">
                        @endcomponent
                    @endif --}}
                    <input type="hidden" name="id"
                        value="<?= !empty($item['id']) && $item['id'] > 0 ? $item['id'] : '' ?>">
                    <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">
                    @component('component.buttonAdd')
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
@endsection
