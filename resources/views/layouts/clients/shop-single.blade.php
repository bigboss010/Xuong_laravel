@extends('layouts.clients.master')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a> 
                    <span class="mx-2 mb-0">/</span> 
                    <strong class="text-black">{{ $list->ten_pet }}</strong>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ Storage::url($list->image) }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $list->ten_pet }}</h2>
                    <p>{{ $list->mota }}</p>
                    <p><strong class="text-primary h4">{{ number_format($list->gia_pet, 0, ',', '.') }} VNĐ</strong></p>
                   
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="number" id="so_luong" class="form-control text-center" value="1" min="1" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>

                    <a href="#" id="add-to-cart" class="buy-now btn btn-sm btn-primary">Add To Cart</a>

                </div>
            </div>
        </div>
    </div>
   
    @include('layouts.clients.components.featured-product', ['list' => $featuredProducts])

    <script>
        document.getElementById('add-to-cart').addEventListener('click', function(event) {
            event.preventDefault();
            var soLuong = document.getElementById('so_luong').value;
            var url = "{{ url('/add-to-cart/' . $list->id) }}" + "/" + soLuong;
            window.location.href = url;
        });
    </script>
@endsection
