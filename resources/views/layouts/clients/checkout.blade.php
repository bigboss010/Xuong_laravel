@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a> <span class="mx-2 mb-0">/</span>
                    <a href="{{ route('/.cart') }}">Giỏ hàng</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Hóa đơn</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Thông tin chi tiết hóa đơn</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">Họ và tên <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname"
                                    value="{{ Auth::user()->name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Địa chỉ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" name="c_address"
                                    value="{{ Auth::user()->address }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_email_address" class="text-black">Email <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_email_address" name="c_email_address"
                                    value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-12">
                                <label for="c_phone" class="text-black">Số điện thoại <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" name="c_phone"
                                    value="{{ Auth::user()->phone }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Ghi chú</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="Viết ghi chú của bạn ở đây ....."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Mã giảm giá</h2>
                            <div class="p-3 p-lg-5 border">
                                <!-- Coupon code input here -->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Hóa đơn của bạn</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <tr>
                                            <th>Pet</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($cartItems))
                                        @foreach ($cartItems as $id => $details)
                                            <tr rowId="{{ $id }}">
                                                <td class="product-thumbnail">
                                                    <img src="{{ Storage::url($details['image']) }}" alt="Image" class="img-fluid">
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black">{{ $details['ten_pet'] }}</h2>
                                                </td>
                                                <td>{{ number_format($details['gia_pet'], 0, ',', '.') }} VNĐ</td>
                                                <td>
                                                    <div class="input-group mb-3" style="max-width: 120px;">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                                        </div>
                                                        <input type="text" class="form-control text-center" value="{{ $details['so_luong'] }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($details['gia_pet'] * $details['so_luong'], 0, ',', '.') }} VNĐ</td>
                                                <td class="actions">
                                                    <a class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o">X</i></a>
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

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg py-3 btn-block"
                                        onclick="window.location='thankyou.html'">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
