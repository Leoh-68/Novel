@php
    $kind = !empty($kind) ? '.' . $kind : '';

@endphp

    <a class="text-primary mr-3" href="{{ url('slugweb', ['slug' => $slug]) }}" target="_blank"><i
            class="ti ti-eye-check mr-1"></i>View</a>
    <a class="text-memberHome mr-3"
        href="{{ url('memberHome.edit', ['com' => $com, 'act' => 'edit', 'type' => $type], $params ?? []) }}"><i
            class="ti ti-edit mr-1"></i>Edit</a>

{!! $slot !!}