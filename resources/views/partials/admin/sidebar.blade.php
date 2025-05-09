<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    {{-- border bottom 0 --}}
    <div class="app-sidebar-logo px-6 border-bottom-0" id="kt_app_sidebar_logo">
        <a href="{{route('dashboard.index')}}">
            <img alt="Logo" src="{{asset('assets/img/about-sumbar.png')}}" class=" app-sidebar-logo-default w-150px" />
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('dashboard.index') ? 'active' : '' }}" href="{{route('dashboard.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-house fs-3"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                @if(Auth::user()->group_id == 4)
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('menu-public.*') ? 'active' : '' }}" href="{{route('menu-public.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-house fs-3"></i>
                        </span>
                        <span class="menu-title">Menu Publik</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('list-link.*') ? 'active' : '' }}" href="{{route('list-link.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-link fs-3"></i>
                        </span>
                        <span class="menu-title">Link Terkait</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('bidang.*') ? 'active' : '' }}" href="{{route('bidang.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-link fs-3"></i>
                        </span>
                        <span class="menu-title">Bidang</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('news.*') ? 'active' : '' }}" href="{{route('news.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-newspaper fs-3"></i>
                        </span>
                        <span class="menu-title">Berita</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('banner.*') ? 'active' : '' }}" href="{{route('banner.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-newspaper fs-3"></i>
                        </span>
                        <span class="menu-title">Banner</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('page-system.*') ? 'active' : '' }}" href="{{route('page-system.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-newspaper fs-3"></i>
                        </span>
                        <span class="menu-title">Halaman Informasi</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('user.*') ? 'active' : '' }}" href="{{route('user.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-newspaper fs-3"></i>
                        </span>
                        <span class="menu-title">User</span>
                    </a>
                </div>
                @endif
                
                @if(Auth::user()->group_id == 3)
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('op-news.*') ? 'active' : '' }}" href="{{route('op-news.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-newspaper fs-3"></i>
                        </span>
                        <span class="menu-title">Berita</span>
                    </a>
                </div>
                @endif

                @if(Auth::user()->group_id == 1)
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('k-news.*') ? 'active' : '' }}" href="{{route('k-news.index')}}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-newspaper fs-3"></i>
                        </span>
                        <span class="menu-title">Berita</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
