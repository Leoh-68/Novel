<input type="checkbox"
    class="switch-input custom-control-input show-checkbox"
    id="show-checkbox-{{ $keyC }}-{{ $idC }}" data-table="{{ $tableC }}"
    data-id="{{ $idC }}" data-attr="{{ $keyC }}" data-url="{{ url('member.status') }}"
    {{ in_array($keyC, $status_arrayC) ? 'checked' : '' }}>
<span class="switch-toggle-slider">
    <span class="switch-on"><i class="ti ti-check"></i></span>
    <span class="switch-off"><i class="ti ti-x"></i></span>
</span>
