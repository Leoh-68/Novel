@push('styles')
    <link rel="stylesheet" href="@asset('assets/css/member.css')">
@endpush
@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3">
            <div class="wrap-user">
                <div class="title-user">
                    <span>{{ __('web.quenmatkhau') }}</span>
                </div>
                <form class="form-user validation-member" novalidate method="post" action="{{ url('member.forgotpass') }}"
                    enctype="multipart/form-data">
                    <div class="input-group input-user">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                        </div>
                        <input type="text" class="form-control text-sm" id="username" name="username"
                            placeholder="{{ __('web.taikhoan') }}" required>
                        <div class="invalid-feedback">{{ __('web.vuilongnhaptaikhoan') }}</div>
                        @error('username')
                            <div class="text-danger text-sm mt-1">{!! $messageforgot !!}</div>
                        @enderror
                    </div>
                    <div class="input-group input-user">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control text-sm" id="email" name="email"
                            placeholder="{{ __('web.nhapemail') }}" required>
                        <div class="invalid-feedback">{{ __('web.vuilongnhapdiachiemail') }}</div>
                        @error('email')
                            <div class="text-danger text-sm mt-1">{!! $messageforgot !!}</div>
                        @enderror
                    </div>
                    <div class="button-user">
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-primary btn-login" name="forgot-password-user"
                            value="{{ __('web.laymatkhau') }}">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
