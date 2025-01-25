@push('styles')
    <link rel="stylesheet" href="@asset('assets/css/member.css')">
@endpush
@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3" x-data="{ show: true }">
            <div class="wrap-user">
                <div class="title-user">
                    <span>Đăng nhập</span>
                    <a href="{{ url('member.forgotpass') }}"
                        title="Quên mật khẩu">Quên mật khẩu</a>
                </div>
                <form class="form-user validation-member" novalidate method="post" action="{{ url('member.login') }}"
                    enctype="multipart/form-data">
                    @if (!empty($mess))
                        <div class="thongbao-form">{{ $mess }}</div>
                    @endif
                    <div class="input-group input-user">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                        </div>
                        <input type="text" class="form-control text-sm" id="username" name="username"
                            placeholder="{{ __('web.taikhoan') }}" autocomplete="off" required>
                        <div class="invalid-feedback">{{ __('web.vuilongnhaptaikhoan') }}</div>
                    </div>
                    <div class="input-group input-user form-password-toggle">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-lock"></i></div>
                        </div>
                        <input :type="show ? 'password' : 'text'" autocomplete="off" class="form-control text-sm"
                            id="password" name="password" placeholder="{{ __('web.matkhau') }}" required>
                        <span class="show-pass cursor-pointer"><i class="fa-light fa-eye-slash" @click="show = !show"
                                :class="{ 'fa-light fa-eye': !show, 'fa-light fa-eye-slash': show }"></i></span>
                        <div class="invalid-feedback">{{ __('web.vuilongnhapmatkhau') }}</div>
                    </div>
                    <div class="button-user center-botton-user">
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-primary btn-login" name="login-user"
                            value="{{ __('web.dangnhap') }}">
                        <div class="checkbox-user custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember-user" id="remember-user"
                                value="1">
                            <label class="custom-control-label" for="remember-user">{{ __('web.nhomatkhau') }}</label>
                        </div>
                    </div>
                    <div class="note-user">
                        <span>{{ __('web.banchuacotaikhoan') }} ! </span>
                        <a href="{{ url('member.registration') }}"
                            title="{{ __('web.dangkytaiday') }}">{{ __('web.dangkytaiday') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
