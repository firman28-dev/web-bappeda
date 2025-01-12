@foreach ($menus as $menu)
    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
        @if ($menu->_children->isNotEmpty())
                <a class="menu-link" href="{{ $menu->url ?? '#' }}">
                    <span class="menu-title">{{ $menu->name }}</span>
                    <span class="menu-arrow" ></span>
                </a>
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                @include('partials.guest.menu_nested', ['menus' => $menu->_children])
            </div>
        @else
            <div class="menu-item">
                <a class="menu-link" href="{{ $menu->url ?? '#' }}">
                    <span class="menu-title">{{ $menu->name }}</span>
                </a>
            </div>
        @endif
    </div>
@endforeach
