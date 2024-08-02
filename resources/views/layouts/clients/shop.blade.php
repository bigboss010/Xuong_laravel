@extends('layouts.clients.master')

@section('css')
    <style>
 .block-4-image {
    padding-top: 100%; 
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat; 
}

.product-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%; /* Set a fixed height if needed */
    text-align: center;
    width: 100%; /* Ensure it takes full width */
}

.product-card .block-4-text {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    text-align: center;
    flex-grow: 1; /* Ensure it takes available space */
}

.product-card h3, .product-card p {
    margin: 0;
    padding: 0.5rem 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 100%; /* Ensure it takes full width */
}

.product-card h3 {
    max-width: 100%; /* Ensure it takes full width */
}

.product-card p {
    max-width: 100%; /* Ensure it takes full width */
}

.product-card h3, .product-card p {
    margin: 0;
    padding: 0.5rem 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Number of lines to show */
    -webkit-box-orient: vertical;
    width: 100%; /* Ensure it takes full width */
}


    </style>
@endsection

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a> 
                    <span class="mx-2 mb-0">/</span> 
                    <strong class="text-black">Cửa hàng</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-9 order-2">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Cửa hàng</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Mới nhất
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuReference" data-toggle="dropdown">Sắp xếp</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" href="#">Tên, A to Z</a>
                                        <a class="dropdown-item" href="#">Tên, Z to A</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Giá, thấp đến cao</a>
                                        <a class="dropdown-item" href="#">Giá, cao đến thấp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        @foreach ($list->take(9) as $item)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border product-card">
                                    <div class="block-4-image">
                                        <img src="{{ Storage::url($item->image) }}"
                                            alt="Image placeholder" class="img-fluid product-image">
                                    </div>
                                    <div class="block-4-text p-4">
                                        <h3 class="text-truncate">
                                            <a href="{{ route('/.shop-single', $item->id) }}">{{ $item->ten_pet }}</a>
                                        </h3>
                                        <p class="mb-0 text-truncate">{{ $item->mota }}</p>
                                        <p class="text-primary font-weight-bold">{{ number_format($item->gia_pet, 0, ',' ,'.') }} VNĐ</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            <div class="site-block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-1">
                        <div class="mt-4">
                            <h3 class="mb-1 h6 text-uppercase text-black d-block">Tìm kiếm theo giá</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                                disabled="" />
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.clients.components.categories', ['danhMucs' => $danhMucs])
        </div>
    </div>
@endsection


