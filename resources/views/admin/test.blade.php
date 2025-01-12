<div class="row m-4 text-center">
    <h1 class="display-6">Link Terkait</h1>
    @foreach ($list_link as $item)
        <div class="col-xl-3 col-md-6 mb-4 aos-init aos-animate d-flex align-items-stretch" data-aos="fade-up" data-aos-duration="1000">
            <a href="{{$item->link}}" target="_blank" class="d-flex align-items-stretch">
                <div class="card w-100 d-flex align-items-center">
                    <div class="card-body d-flex align-items-center justify-content-center card-custom">
                        <img src="{{ asset('uploads/list_link/' . $item->path) }}" alt="File Image" class="w-25">
                    </div>
                </div>
            </a>
        
        </div>
    
    @endforeach
</div>