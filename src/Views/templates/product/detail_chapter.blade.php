@extends('layoutChapter')
@push('styles')
    <link rel="stylesheet" href="{{ @assets('assets/css/special/chapter.css') }}">
@endpush

@section('content')
    <section>
        <div class="wrap-detail-chapter padding-main" x-data="{ darkMode: $persist(false).as('darkModeStatus') }" :class="darkMode && 'dark-mode'">
            <div class="tool ">
                <div class="btn-tool " @click="darkMode = !darkMode">
                    <button>
                        <i :class="darkMode ? 'fa fa-sun' : 'fa fa-moon'"></i>
                    </button>
                </div>
            </div>
            <div class="wrap-content-chapter">
                <div class="title-chapter">
                    <h1>Chương {{ $rowDetail['numb'] }} {{ $rowDetail['namevi'] }}</h1>
                </div>
                <div class="content">
                    {!! Func::decodeHtmlChars($rowDetail['contentvi']) !!}
                </div>
            </div>
            <div class="tool">

            </div>
        </div>
    </section>
@endsection
