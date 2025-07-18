 <!-- Page Sidebar Start-->
 <div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
     <div>
         <div class="logo-wrapper">
            <a href="{{route('dashboard.index')}}">
                <img class="img-fluid for-light" src="{{ asset('assets_global/img/BAPPEDA SUMBAR HTM.png') }}" alt="" style="width: 90px">
                <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="">
            </a>
             <div class="back-btn">
                <i class="fa-solid fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
            </div>
         </div>
         <div class="logo-icon-wrapper">
            <a href="">
                <img class="img-fluid" src="{{ asset('logo/B BAPPEDA.png') }}" alt="" style="width: 30px">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa-solid fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('dashboard.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-charts') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-charts') }}"></use>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->group_id == 4)
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('menu-public.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg>
                            <span>Menu Public</span>
                        </a>
                    </li>

                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('list-link.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-reports') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-reports') }}"></use>
                            </svg>
                            <span>Link Terkait</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('pejabat.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg>
                            <span>Pejabat Bappeda</span>
                        </a>
                    </li>

                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('bidang.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-task') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-task') }}"></use>
                            </svg>
                            <span>Bidang Bappeda</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-blog') }}"></use>
                            </svg>
                            <span >Berita </span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('category.index') }}">Tag Konten</a></li>
                            <li><a href="{{ route('news.index') }}">Konten</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-gallery') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-gallery') }}"></use>
                            </svg>
                            <span >Fitur </span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('faq.index') }}">FAQ</a></li>
                            <li><a href="{{ route('banner.index') }}">Infografis</a></li>
                            <li><a href="{{ route('sosial-media.index') }}">Sosial Media</a></li>
                            <li><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                            <li><a href="{{ route('magang.index') }}">Pengajuan Magang</a></li>



                        </ul>
                    </li>
                    {{-- <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('banner.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-gallery') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-gallery') }}"></use>
                            </svg>
                            <span>Infografis</span>
                        </a>
                    </li> --}}
                    
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('page-system.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-learning') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-learning') }}"></use>
                            </svg>
                            <span>Halaman Informasi</span>
                        </a>
                    </li>
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('user.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg>
                            <span>User</span>
                        </a>
                    </li>
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('maintenance.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-job-search') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-job-search') }}"></use>
                            </svg>
                            <span>Maintenance</span>
                        </a>
                    </li>

                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('indikator.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-job-search') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-job-search') }}"></use>
                            </svg>
                            <span>Indikator Makro</span>
                        </a>
                    </li>
                    
                    @endif

                    @if(Auth::user()->group_id == 3)
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('op-news.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-blog') }}"></use>
                            </svg>
                            <span>Berita Bappeda</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->group_id == 1)
                    <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('k-news.index')}}" >
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-blog') }}"></use>
                            </svg>
                            <span>Berita Bappeda</span>
                        </a>
                    </li>
                    @endif



                   
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
     </div>
 </div>
 <!-- Page Sidebar Ends-->
