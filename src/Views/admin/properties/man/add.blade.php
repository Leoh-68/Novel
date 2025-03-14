@extends('layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y container-fluid">
    <div class="app-ecommerce">
        <form class="validation-form" novalidate method="post" action="{{ url('admin', ['com' => $com, 'act' => 'save', 'type' => $type],['page'=>$page]) }}" enctype="multipart/form-data">
            @component('component.buttonAdd')
            @endcomponent


            {!! Flash::getMessages('admin') !!}
            <div class="row">
                <div class="col-12 col-lg-8">
                    @if (!empty($configMan->slug))
                    @php
                    $slugchange = $act == 'edit' ? 1 : 0;
                    $item = !empty($item) ? $item : [];
                    $id = !empty($id) ? $id : 0;
                    @endphp
                    @component('component.slug', ['slugchange' => $slugchange, 'item' => $item, 'id' => $id])
                    @endcomponent
                    @endif
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin {{ $configMan->title_main }}
                            </h3>
                        </div>
                        <div class="card-body card-article">
                            @component('component.content',['name'=>$configMan->name??false,'desc'=>$configMan->desc??false,'desc_cke'=>$configMan->desc_cke??false,'content'=>$configMan->content??false,'content_cke'=>$configMan->content_cke??false,'item'=>$item]) @endcomponent
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card mb-4 form-group-category">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danh mục thuộc tính</h5>
                        </div>
                        <div class="card-body">
                            @if (!empty($configMan->categories->list))
                            <div class="form-group last:!mb-0">
                                <label class="form-label" for="id_list">Danh mục cấp 1:</label>
                                <?= Func::getAjaxCategory('properties_list', 'properties_cat', 'list', $type, 'Danh mục cấp 1') ?>
                            </div>
                            @endif

                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Tình trạng
                                {{ $configMan->title_main }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group last:!mb-0">
                                @php $status_array = !empty($item['status']) ? explode(',', $item['status']) : []; @endphp
                                @if (!empty($configMan->status))
                                @foreach ($configMan->status as $key => $value)
                                <div class="form-group d-inline-block last:!mb-0 mb-2 me-5">
                                    <label for="{{ $key }}-checkbox" class="d-inline-block align-middle mb-0 mr-2"><?= $value ?>:</label>
                                    <label class="switch switch-success">
                                        <input type="checkbox" name="status[{{ $key }}]" class="switch-input custom-control-input show-checkbox" id="{{ $key }}-checkbox" {{ (empty($status_array) && empty($item['id']) ? 'checked' : in_array($key, $status_array)) ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="ti ti-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="ti ti-x"></i>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="form-group last:!mb-0">
                                <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                                <input type="number" class="form-control form-control-mini w-25 text-left d-inline-block align-middle text-sm" min="0" name="data[numb]" id="numb" placeholder="Số thứ tự" value="{{ !empty($item['numb']) ? $item['numb'] : 1 }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= !empty($item['id']) && $item['id'] > 0 ? $item['id'] : '' ?>">
            <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">

            @component('component.buttonAdd')
            @endcomponent

        </form>
    </div>
</div>
@endsection