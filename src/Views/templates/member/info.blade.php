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
                                    @component('component.image', ['photoDetail' => $photoDetail, 'photoAction' => 'photo', 'key' => 'avatar'])
                                    @endcomponent
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



                            <div class="col-12">
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
                        </div>

                        {{-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-[10px]">
                                    <div class="input-cart">
                                        <select class="select-city-cart form-select form-control text-sm" required
                                            id="city" name="dataAddress[city]">
                                            <option value="">Tỉnh thành</option>
                                            @foreach ($city ?? [] as $k => $v)
                                                <option value="{{ $v->id }}"
                                                    @if (!empty($addressPicked['city']) && $v->id == $addressPicked['city']['id']) selected @endif>{{ $v->namevi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn tỉnh thành</div>
                                    </div>
                                    <div class="input-cart">
                                        <select
                                            class="select-district-cart select-district form-select form-control text-sm"
                                            required id="district" name="dataAddress[district]">
                                            @if (!empty($addressPicked['district']))
                                                <option value="{{ $addressPicked['district']['id'] }}" selected>
                                                    {{ $addressPicked['district']['name'] }}</option>
                                            @else
                                                <option value="">Quận huyện</option>
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn quận huyện</div>
                                    </div>
                                    <div class="input-cart">
                                        <select class="select-ward-cart select-ward form-select form-control text-sm"
                                            required id="ward" name="dataAddress[ward]">
                                            @if (!empty($addressPicked['ward']))
                                                <option value="{{ $addressPicked['ward']['id'] }}" selected>
                                                    {{ $addressPicked['ward']['name'] }}</option>
                                            @else
                                                <option value="">Phường xã</option>
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">Vui lòng chọn phường xã</div>
                                    </div>
                                </div> --}}


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

        // document.querySelector('body').addEventListener('change', (e) => {
        //     if (e.target.closest('.select-city-cart')) {
        //         this.getDistrict(e.target.closest('.select-city-cart'));
        //     } else if (e.target.matches('.select-district-cart')) {
        //         this.getWard(e.target.closest('.select-district-cart'));
        //     }
        // });


        // getDistrict(target) {
        //     const selectCity = document.querySelector('.select-city-cart');
        //     const selectDistrict = document.querySelector('.select-district-cart');
        //     const id = selectCity.value;
        //     holdonOpen();
        //     var form_data = new FormData();
        //     form_data.append('id', id);
        //     fetch(this.base_url + 'cart/get-district', {
        //             method: 'POST',
        //             body: form_data
        //         })
        //         .then((response) => response.json())
        //         .then((result) => {
        //             if (result.districts) {
        //                 this.populateSelect(result.districts, selectDistrict);
        //             }
        //             holdonClose();
        //         });
        // }

        // getWard(target) {
        //     const selectCity = document.querySelector('.select-district-cart');
        //     const selectDistrict = document.querySelector('.select-ward-cart');
        //     const id = selectCity.value;
        //     holdonOpen();
        //     var form_data = new FormData();
        //     form_data.append('id', id);
        //     fetch(this.base_url + 'cart/get-ward', {
        //             method: 'POST',
        //             body: form_data
        //         })
        //         .then((response) => response.json())
        //         .then((result) => {
        //             if (result.wards) {
        //                 this.populateSelect(result.wards, selectDistrict);
        //             }
        //             holdonClose();
        //         });
        // }
    </script>
@endpush
