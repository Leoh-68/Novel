@push('styles')
    <link rel="stylesheet" href="@asset('assets/css/member.css?v=' . time())">
@endpush
@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3" x-data="{ show: true, showrepass: true }">
            <div class="wrap-user">
                <div class="title-user title-user-center">
                    <span class="text-center title-form d-block">
                        <h1>
                            Đăng ký thành viên
                        </h1>
                    </span>
                </div>
                <form class="form-user validation-member" method="post" action="{{ url('member.registration') }}"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <div class="input-group input-user">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control text-sm" id="fullname" name="fullname"
                                placeholder="Nhập họ và tên" value="" required>
                            <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                            @error('fullname')
                                <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group input-user">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                            </div>
                            <input type="email" class="form-control text-sm" id="email" name="email"
                                placeholder="Nhập email" value="" required>
                            <div class="invalid-feedback">Vui lòng nhập email</div>
                            @error('email')
                                <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tên tài khoản</label>
                        <div class="input-group input-user ">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control text-sm" id="username" name="username"
                                placeholder="Nhập tên tài khoản" value="" required>
                            <div class="invalid-feedback">Vui lòng nhập tên tài khoản</div>
                            @error('username')
                                <div class=" w-100 text-danger text-sm mt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu (*)</label>
                        <div class="input-group input-user">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                            </div>
                            <input :type="show ? 'password' : 'text'" autocomplete="off" class="form-control text-sm"
                                id="password" name="password" placeholder="Nhập mật khẩu" required>
                            <span class="show-pass cursor-pointer"><i class="fa-light fa-eye-slash" @click="show = !show"
                                    :class="{ 'fa-light fa-eye': !show, 'fa-light fa-eye-slash': show }"></i></span>
                            <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                            @error('password')
                                <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu (*)</label>
                        <div class="input-group input-user">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                            </div>
                            <input :type="showrepass ? 'password' : 'text'" autocomplete="off" class="form-control text-sm"
                                id="re-password" name="re-password" placeholder="Nhập lại mật khẩu" required>
                            <span class="show-pass cursor-pointer"><i class="fa-light fa-eye-slash"
                                    @click="showrepass = !showrepass"
                                    :class="{ 'fa-light fa-eye': !showrepass, 'fa-light fa-eye-slash': showrepass }"></i></span>
                            <div class="invalid-feedback">Vui lòng nhập lại mật khẩu</div>
                            @error('re-password')
                                <div class="text-danger w-100 text-sm mt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Loại tài khoản</label>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="reader" checked
                                    value="reader">
                                <label class="form-check-label" for="reader">
                                    Đọc giả
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="author"
                                    value="author">
                                <label class="form-check-label" for="author">
                                    Tác giả
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="button-user">
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-primary btn-block btn-login" name="registration-user"
                            value="Đăng ký">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
