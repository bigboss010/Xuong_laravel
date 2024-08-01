@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Home</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong>
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
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Hình ảnh</th>
                                    <th class="product-name">Tên thú cưng</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-total">Tổng tiền</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('cart'))
                                    @foreach (session('cart') as $id => $details)
                                        <tr rowId="{{ $id }}">
                                            <td class="product-thumbnail">
                                                <img src="{{ Storage::url($details['image']) }}" alt="Image"
                                                    class="img-fluid">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $details['ten_pet'] }}</h2>
                                            </td>
                                            <td>{{ number_format($details['gia_pet'], 0, ',', '.') }} VNĐ</td>
                                            <td>
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-primary js-btn-minus"
                                                            type="button">&minus;</button>
                                                    </div>
                                                    <input type="text" class="form-control text-center"
                                                        value="{{ $details['so_luong'] }}" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary js-btn-plus"
                                                            type="button">&plus;</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($details['gia_pet'] * $details['so_luong'], 0, ',', '.') }}
                                                VNĐ</td>
                                            <td class="actions">
                                                <a class="btn btn-outline-danger btn-sm delete-product"><i
                                                        class="fa fa-trash-o">X</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Your cart is empty!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">

                        <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-sm btn-block"><a
                                    href="{{ route('/.shop') }}">Continue Shopping</a></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Tổng giỏ hàng</h3>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Tổng tiền</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                                </div>
                            </div>

                            <div class="row">
                                @if (Auth::user())
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg py-3 btn-block"><a
                                                href="{{ route('/.checkout') }}" style="color: white">Proceed To
                                                Checkout</a></button>
                                    </div>
                                @elseif(!Auth::user())
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg py-3 btn-block"><a
                                                href="#" id="checkout" onclick="showAlert3()" style="color: white">Proceed To
                                                Checkout</a></button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.js') }}"></script>
<script>
    function showAlert3() {
            event.preventDefault();
            Swal.fire({
                title: 'Thông báo',
              text: 'Vui lòng đăng nhập để vào mục này!',
              icon: 'error',
              confirmButtonText: 'OK'
            });
        }
</script>
@yield('scripts')

