@push('styles')
    <link rel="stylesheet" href="@asset('assets/css/member.css')?{{ time() }}">
    <link rel="stylesheet" href="@asset('assets/admin/css/main.css')?{{ time() }}">
    <link rel="stylesheet" href="@asset('assets/admin/cropper/cropper.min.css')?{{ time() }}">
    <link rel="stylesheet" href="@asset('assets/admin/vendor/fonts/tabler-icons.css')?{{ time() }}">
@endpush
@extends('layout')
@section('content')
    <section>
        @php
            $message = Flash::get('message');
            $messType = '';
            $messInfo = '';
            if ($message) {
                $messType = $message['status'] ?? 'danger';
                $messInfo = $message['messages'] ?? [];
            }
        @endphp

        <div class="max-width py-3">
            @if ($messInfo)
                @foreach ($messInfo as $v)
                    <div class="alert alert-{{ $messType }}">{{ $v }}</div>
                @endforeach
            @endif
            @if ($thongbao != '')
                <div class="alert alert-success my-3">{{ $thongbao }}</div>
            @endif
            <div class="box_info">
                <div class="container_load_info load1 mo">
                    <div class="title-user">
                        <span>{{ __('web.thongtincanhan') }}</span>
                    </div>
                    <form class="form-user validation-member" novalidate method="post" action="{{ url('member.info') }}"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label>{{ __('web.taikhoan') }}</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control text-sm" id="username" name="username"
                                        placeholder="{{ __('web.nhaptaikhoan') }}" value="<?= $rowDetail['username'] ?>"
                                        readonly required>
                                    @error('username')
                                        <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>{{ __('web.matkhaumoi') }}</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control text-sm" id="new-password"
                                        name="new-password" placeholder="{{ __('web.nhapmatkhaumoi') }}">
                                    @error('new-password')
                                        <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>{{ __('web.nhaplaimatkhaumoi') }}</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control text-sm" id="new-password-confirm"
                                        name="new-password-confirm" placeholder="{{ __('web.nhaplaimatkhaumoi') }}">
                                    @error('new-password-confirm')
                                        <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>Email</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                    </div>
                                    <input type="email" class="form-control text-sm" id="email" name="email"
                                        placeholder="{{ __('web.nhapemail') }}" value="<?= $rowDetail['email'] ?>"
                                        required>
                                    <div class="invalid-feedback">{{ __('web.vuilongnhapdiachiemail') }}</div>
                                    @error('email')
                                        <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>{{ __('web.dienthoai') }}</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-phone-square"></i></div>
                                    </div>
                                    <input type="number" class="form-control text-sm" id="phone" name="phone"
                                        placeholder="{{ __('web.nhapdienthoai') }}" value="<?= $rowDetail['phone'] ?>"
                                        required>
                                    <div class="invalid-feedback">{{ __('web.vuilongnhapsodienthoai') }}</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label>{{ __('web.hoten') }}</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control text-sm" id="fullname" name="fullname"
                                        placeholder="{{ __('web.nhaphoten') }}" value="<?= $rowDetail['fullname'] ?>"
                                        required>
                                    <div class="invalid-feedback">{{ __('web.vuilongnhaphoten') }}</div>

                                </div>
                            </div>

                            <div class="col-12 ">
                                <label>{{ __('web.diachi') }}</label>
                                <div class="input-group input-user">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-map"></i></div>
                                    </div>
                                    <input type="text" class="form-control text-sm" id="address" name="address"
                                        placeholder="{{ __('web.nhapdiachi') }}" value="<?= $rowDetail['address'] ?>"
                                        required>
                                    <div class="invalid-feedback">{{ __('web.vuilongnhapdiachi') }}</div>
                                </div>
                            </div>
                            {{-- loadImage('assets/images/user.jpg','file-zone-avatar') --}}
                            
                            <div class="col-12 col-lg-6">
                                <div class="cover-img-member">


                                    <label for="file-avatar">Ảnh đại diện</label>
                                    @php
                                        /* Photo detail */
                                        $photoDetail = [];
                                        $photoAction = 'photo';
                                        $photoDetail['upload'] = 'user';
                                        $photoDetail['image'] = !empty($rowDetail['avatar'])
                                            ? $rowDetail['avatar']
                                            : '';
                                        $photoDetail['dimension'] =
                                            'Width: 1200 px - Height: 300 px (' . config('type.type_img') . ')';
                                    @endphp
                                    <div class="photoUpload-zone">
                                        <div class="crop-view-popup d-block  mx-auto">
                                            <div class="setting-crop">
                                                <input type="" name="additionalData" id="additionalData"
                                                    value="someAdditionalData">
                                                <ul class="mb-3 hide-crop ">
                                                    <li>
                                                        <button id="cropButton-avatar" type="button"
                                                            class="cropButton btn-primary btn-crop-img"><i
                                                                class="ti ti-crop"></i> Cắt ảnh</button>
                                                    </li>
                                                </ul>
                                                <div class="actions mb-3 mt-2" id="actions-avatar">
                                                    <div class="docs-buttons">
                                                        <!-- <h3>Toolbar:</h3> -->
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary"
                                                                data-method="rotate" data-option="-45"
                                                                title="Rotate Left">
                                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                                    title="cropper.rotate(-45)">
                                                                    <i class="ti ti-rotate-2"></i>
                                                                </span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-method="rotate" data-option="45"
                                                                title="Rotate Right">
                                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                                    title="cropper.rotate(45)">
                                                                    <i class="ti ti-rotate-clockwise-2"></i>
                                                                </span>
                                                            </button>
                                                        </div>

                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary"
                                                                data-method="zoom" data-option="0.1" title="Zoom In">
                                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                                    title="cropper.zoom(0.1)">
                                                                    <i class="ti ti-zoom-in"></i>
                                                                </span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-method="zoom" data-option="-0.1" title="Zoom Out">
                                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                                    title="cropper.zoom(-0.1)">
                                                                    <i class="ti ti-zoom-out"></i>
                                                                </span>
                                                            </button>
                                                        </div>

                                                        <div class="docs-data px-2">
                                                            <div class="input-group  my-2">
                                                                <input type="number" class="form-control cropWidth"
                                                                    id="cropWidth-avatar" placeholder="width">
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text">px</span>
                                                                </span>
                                                            </div>
                                                            <div class="input-group  my-2">
                                                                <input type="number" class="form-control cropHeight"
                                                                    id="cropHeight-avatar" placeholder="height">
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text">px</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="btn-group px-2 w-100">
                                                            <button type="button" class="btn btn-primary crop-reset"
                                                                id="crop-reset-avatar" data-method="reset"
                                                                title="Reset">
                                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                                    title="cropper.reset()">
                                                                    <i class="ti ti-refresh"></i> Làm lại
                                                                </span>
                                                            </button>
                                                        </div>

                                                        <!-- Show the cropped image in modal -->
                                                    </div><!-- /.docs-buttons -->
                                                </div>
                                                <ul>
                                                    <li>
                                                        <button id="saveButton-avatar" type="button"
                                                            class="saveButton  btn-primary btn-crop-img"><i
                                                                class="ti ti-circle-plus"></i> Áp dụng</button>
                                                    </li>
                                                </ul>
                                                <div class="view-size">{{ $photoDetail['dimension'] }}</div>
                                            </div>




                                            <div class="view-cropper">
                                                <div class="photoUpload-detail" id="photoUpload-preview-avatar">
                                                    @if (!empty($photoDetail['image']))
                                                        <a class="img-container">
                                                            <img class="rounded"
                                                                onerror="this.src='./assets/images/noimage.png';"
                                                                data-src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}"
                                                                src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}"
                                                                alt="Alt photo" title="Alt photo" />
                                                        </a>
                                                    @else
                                                        <img class="rounded"
                                                            onerror="this.src='./assets/images/noimage.png';"
                                                            src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}"
                                                            alt="Alt photo" title="Alt photo" />
                                                    @endif

                                                    <button type="button" hidden
                                                        class="crop-popup btn-primary btn-crop-img mt-3 "
                                                        id="crop-popup-avatar">Chỉnh sửa ảnh</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-photo">
                                            <label class="photoUpload-file" id="photo-zone-avatar"
                                                for="file-zone-avatar">
                                                <input type="file" class="file-zone-avatar" name="file-avatar"
                                                    id="file-zone-avatar">
                                                <input type="hidden" class="cropFile" name="cropFile-avatar"
                                                    id="cropFile-avatar">
                                                <i class="ti ti-cloud-upload"></i>
                                                <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                                <p class="photoUpload-or">Hoặc</p>
                                                <p class="photoUpload-choose btn btn-sm">Chọn hình</p>
                                            </label>
                                            <div class="photoUpload-dimension">{{ $photoDetail['dimension'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="cover-img-member">
                                    <label for="file-banner">Banner</label>
                                    @php
                                        /* Photo detail */
                                        $photoDetail = [];
                                        $photoAction = 'photo';
                                        $photoDetail['upload'] = 'user';
                                        $photoDetail['image'] = !empty($rowDetail['banner'])
                                            ? $rowDetail['banner']
                                            : '';
                                        $photoDetail['dimension'] =
                                            'Width: 600 px - Height: 200 px (' . config('type.type_img') . ')';
                                    @endphp
                                    @component('component.image', ['photoDetail' => $photoDetail, 'photoAction' => 'photo', 'key' => 'banner'])
                                    @endcomponent
                                </div>
                            </div>
                        </div>

                        <div class="button-user">
                            <input type="hidden" name="id" value="{{ $rowDetail['id'] }}">
                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-primary btn-login" name="info-user"
                                value="{{ __('web.capnhat') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="@asset('assets/admin/vendor/libs/flatpickr/flatpickr.css')?{{ time() }}" />
@endpush
@push('scripts')
    <script>
        var TYPE_IMG = "jpg|gif|png|jpeg|gif|webp|WEBP";
    </script>
    <script src="@asset('assets/admin/js/cropper.js')?{{ time() }}"></script>
    <script src="@asset('assets/admin/js/main_crop.js')?{{ time() }}"></script>
    <script src="@asset('assets/admin/vendor/libs/flatpickr/flatpickr.js')?{{ time() }}"></script>
    <script>
        const flatpickrDateTime = document.querySelector('#flatpickr-datetime');
        if (flatpickrDateTime) {
            flatpickrDateTime.flatpickr({
                enableTime: false,
                lang: 'vi',
                dateFormat: 'd/m/Y',
                maxDate: new Date()
            });
        }
    </script>
@endpush
