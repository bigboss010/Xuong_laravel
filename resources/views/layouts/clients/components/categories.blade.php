<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row">
            @foreach ($danhMucs->take(2) as $item)
            <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                <a class="block-2-item" href="#">
                    <figure class="image">
                        <img src="{{Storage::url($item->hinh_anh)}}" width="250px" height="200px" alt="" class="img-fluid">
                    </figure>
                    <div class="text">
                        <h3>{{$item->ten_danh_muc}}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>