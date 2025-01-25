@extends('master')
@section('contentmaster')
    @if (($com ?? '') == 'trang-chu')
        @include('layout.seo')
    @endif
    @include('layout.header')
    {{-- @includeWhen(!empty($slider), 'layout.slider') --}}
    @includeWhen(\NINA\Core\Support\Str::isNotEmpty(BreadCrumbs::get()), 'layout.breadcrumbs')
    @yield('content')
    @include('layout.footer')
    @include('layout.extensions')
    @include('layout.strucdata')
@endsection
