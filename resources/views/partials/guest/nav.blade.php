<div class="app-container container d-flex align-items-stretch justify-content-between"
    id="kt_app_header_container">
    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
        <a href="#">
            <img alt="Logo" src="{{asset('assets_global/img/about-sumbar.png')}}"
            class="text-black h-50px app-sidebar-logo-default theme-light-show" />
        </a>
    </div>
    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
        <div class="app-header-menu ms-auto me-auto app-header-mobile-drawer align-items-stretch" id="navPage"
            data-kt-drawer="true" data-kt-drawer-name="app-header-menu"
            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
            data-kt-drawer-width="250px" data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
            data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
            
            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
            id="kt_app_header_menu" data-kt-menu="true">
            @php
                $menu_public = \App\Models\Menu_Public::where('status_id', 1)
                    ->whereNull('parent_id')
                    ->with('_children')
                    ->orderBy('order_no', 'asc')
                    ->get();
            @endphp

            @foreach ($menu_public as $menu)
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                    @if ($menu->_children->isNotEmpty())
                        <a href="{{ $menu->url ? route('guest.page-system', ['id' => $menu->url]) : '#' }}" class="menu-link">
                        {{-- <a href="{{ $menu->url ?? '#' }}" class="menu-link"> --}}
                            <span class="menu-title">{{$menu->name}}</span>
                            @if ($menu->_children->isNotEmpty())
                                <span class="menu-arrow"></span>
                            @endif
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

            <div class="d-lg-none py-3 px-4">
                <a href="{{ route('login.show') }}" class="btn rounded-4 btn-outline-primary btn-outline py-4">
                    Masuk
                </a>
            </div>
            
            </div>
        </div>

        <div class="app-navbar">
            <div class="app-navbar-item ms-1 ms-lg-3 d-none d-lg-block d-md-block d-sm-block m-auto"
            id="kt_app_header_menu">
                <a href="{{ route('login.show') }}" class="btn rounded-4 btn-outline-primary btn-outline py-4">
                    Masuk
                </a>
            </div>

            <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
                <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                    <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                        fill="currentColor" />
                        <path opacity="0.3"
                        d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                        fill="currentColor" />
                    </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>