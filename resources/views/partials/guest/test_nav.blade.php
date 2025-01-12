<div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
id="kt_app_header_menu" data-kt-menu="true">

    @foreach ($menus as $menu)
        <div class="menu-item">
            <a class="fw-normal menu-link nav-link  py-3 px-4 px-xxl-6" 
                href="{{ $menu->url ?? '#' }}"
                data-kt-scroll-toggle="true" 
                data-kt-drawer-dismiss="true"
            >
            {{ $menu->name }}
            </a>
        
        </div>
    @endforeach
    
    <div class="d-lg-none py-3 px-4">
        <button type="button" class="btn rounded-4 btn-outline-primary btn-outline py-4">
        Masuk
        </button>
    </div>
</div>


{{-- @if ($menu->_children->isNotEmpty())
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                            @include('partials.guest.menu_children', ['children' => $menu->_children])
                        </div>
                    @endif --}}
                    

                    {{-- @if ($menu->_children->isNotEmpty())
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
                                @foreach ($menu->_children as $child)
                                <div class="menu-item">
                                    <a class="menu-link" href="{{ $child->url ?? '' }}">
                                        <span class="menu-title">{{$child->name}}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif --}}