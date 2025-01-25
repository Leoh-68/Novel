@extends('master')
@section('contentmaster')
    @if (($com ?? '') == 'trang-chu')
        @include('layout.seo')
    @endif
    @include('layout.header')
    @includeWhen(\NINA\Core\Support\Str::isNotEmpty(BreadCrumbs::get()), 'layout.breadcrumbs')
    @yield('content')
    @include('layout.strucdata')
@endsection
