@extends('layouts.clients.master')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('/.index') }}">Trang chủ</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Đơn hàng</strong>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <br>
    <h1 class="text-center">Đơn hàng</h1>
    <div class="site-section">
        <div class="container">
            <div class="row">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-name">Mã đơn hàng</th>
                                    <th class="product-name">Họ và tên</th>
                                    <th class="product-name">Email</th>
                                    <th class="product-name">Số điện thoại</th>
                                    <th class="product-name">Địa chỉ</th>
                                    <th class="product-name">Ngày đặt</th>
                                    <th class="product-name">Tổng tiền</th>
                                    <th class="product-name">Ghi chú</th>
                                    <th class="product-name">Phương thức thanh toán</th>
                                    <th class="product-name">Trạng thái</th>
                                    <th class="product-name">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($donHang as $item)
                               <tr>    
                                <td class="h5 text-black">{{ $item->ma_don_hang}}</td>
                                <td class="h5 text-black">{{ $item->ten_nguoi_nhan}}</td>
                                <td class="h5 text-black">{{ $item->email_nguoi_nhan}}</td>
                                <td class="h5 text-black">{{ $item->so_dien_thoai_nguoi_nhan}}</td>
                                <td class="h5 text-black">{{ $item->dia_chi_nguoi_nhan}}</td>
                                <td class="h5 text-black">{{ $item->ngay_dat}}</td>
                                <td class="h5 text-black">{{ $item->tong_tien}}</td>
                                <td class="h5 text-black">{{ $item->ghi_chu}}</td>
                                <td class="h5 text-black">{{ $item->ten_phuong_thuc}}</td>
                                <td class="h5 text-black">{{ $item->ten_trang_thai}}</td>
                                <td class="h5 text-black">Xem chi tiết</td>
                            </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>            
            </div>
        </div>
    </div>
@endsection

@yield('scripts')
