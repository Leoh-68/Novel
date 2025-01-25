@if (!empty($branchTab)) 
    {!! Func::decodeHtmlChars($branchTab['descvi']) !!}
@else
    <div class="alert alert-warning w-100" role="alert">
        <strong>Không tìm thấy kết quả</strong>
    </div>
@endif