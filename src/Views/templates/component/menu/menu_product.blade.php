@push('styles')
    {!! cssminify()->set('css/menu/menu_product.css');!!}
@endpush

<div class="menu-head-left" x-data="{ open: false }" x-on:mouseover="open = true" x-on:mouseleave="open = false">
    <span class="title-menu"><i class="fa-solid fa-bars me-2"></i> Tất cả danh mục <i
            class="fa-solid fa-caret-down ms-2"></i></span>
    <div class="menu-product-list" x-cloak x-show="open" x-transition>
        <ul>
            @foreach ($listProductMenu ?? [] as $vlist)
                <li x-data="{ open: false }" x-on:mouseover="open = true" x-on:mouseleave="open = false">
                    <a class="transition group-hover:text-[#fed402]"
                        href="{{ url('slugweb', ['slug' => $vlist['slugvi']]) }}"
                        title="{{ $vlist['namevi'] }}">{{ $vlist['namevi'] }}
                        {!! $vlist->getCategoryCats()->get()->isNotEmpty() ? '<span class="icon-down">&#8250;</span>' : '' !!}</a>
                    @if ($vlist->getCategoryCats()->get()->isNotEmpty())
                        <ul x-show="open" x-transition>
                            @foreach ($vlist->getCategoryCats()->get() ?? [] as $vcat)
                                <li>
                                    <a class="transition group-hover:text-[#fed402]"
                                        href="{{ url('slugweb', ['slug' => $vcat['slugvi']]) }}"
                                        title="{{ $vcat['namevi'] }}">{{ $vcat['namevi'] }} <span>Xem tất cả
                                            &#8250;</span></a>
                                    <ul>
                                        @foreach ($vcat->getCategoryItems()->get() ?? [] as $vitem)
                                            <li>
                                                <a class="transition group-hover:text-[#fed402]"
                                                    href="{{ url('slugweb', ['slug' => $vitem['slugvi']]) }}"
                                                    title="{{ $vitem['namevi'] }}">{{ $vitem['namevi'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="menu">
    <ul class="flex flex-wrap items-center justify-between ulmn gap-10">
        @foreach ($catProductMenu ?? [] as $vcat)
            <li class="group"><a
                    class="transition group-hover:text-[#fed402] {{ ($idCat ?? 0) == $vcat['id'] ? 'active' : '' }}"
                    href="{{ url('slugweb', ['slug' => $vcat['slugvi']]) }}"
                    title="{{ $vcat['namevi'] }}">{{ $vcat['namevi'] }}</a></li>
        @endforeach
    </ul>
</div>

