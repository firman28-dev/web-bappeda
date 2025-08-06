@extends('partials.guest.index')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">


@endsection

@section('content') 

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            {{-- {{$category->title}} --}}
            <span class="span-custom"></span>
        </h1>
    </div>
    <div class="container mt-10">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>GALLERY BAPPEDA</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-gallery grid gallery" id="aniimated-thumbnials" itemscope="">
                            @foreach($galleries as $item)
                                <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                                    <a href="{{ asset('uploads/gallery/' . $item->image) }}" itemprop="contentUrl" data-size="1600x950">
                                        <img class="img-thumbnail"
                                            src="{{ asset('uploads/gallery/' . $item->image) }}"
                                            itemprop="thumbnail"
                                            alt="{{ $item->name }}">
                                    </a>
                                    <figcaption itemprop="caption description">{{ $item->name }}</figcaption>
                                </figure>
                            @endforeach
                        </div>
                        <!-- Root element of PhotoSwipe. Must have class pswp.-->
                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                           
                            <div class="pswp__bg"></div>
                            <div class="pswp__scroll-wrap">
                                <div class="pswp__container">
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                </div>
                                <div class="pswp__ui pswp__ui--hidden">
                                    <div class="pswp__top-bar">
                                        <div class="pswp__counter"></div>
                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                        <div class="pswp__preloader">
                                            <div class="pswp__preloader__icn">
                                                <div class="pswp__preloader__cut">
                                                    <div class="pswp__preloader__donut"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                        <div class="pswp__share-tooltip"></div>
                                    </div>
                                    <button class="pswp__button pswp__button--arrow--left"
                                        title="Previous (arrow left)"></button>
                                    <button class="pswp__button pswp__button--arrow--right"
                                        title="Next (arrow right)"></button>
                                    <div class="pswp__caption">
                                        <div class="pswp__caption__center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('script')
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
    <script src="{{ asset('assets/js/masonry-gallery.js') }}"></script>
@endsection