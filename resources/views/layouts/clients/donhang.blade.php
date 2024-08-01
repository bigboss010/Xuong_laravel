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
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <h1 class="text-center mb-4">Đơn hàng</h1>
    <div class="site-section">
        <div class="site-blocks-table">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="product-name">Mã đơn hàng</th>
                        <th class="product-name">Ngày đặt</th>
                        <th class="product-name">Tổng tiền</th>
                        <th class="product-name">Trạng thái</th>
                        <th class="product-name">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donHangs as $item)
                    <tr>
                        <td class="h5 text-black">{{ $item->ma_don_hang }}</td>
                        <td class="h5 text-black">{{ $item->ngay_dat }}</td>
                        <td class="h5 text-black">{{ $item->tong_tien }}</td>
                        <td class="h5 text-black">{{ $item->ten_trang_thai }}</td>
                        <td class="h5 text-black">
                            <a href="{{ route('/.showDetailDonHang', $item->id) }}" class="btn btn-primary">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Add any additional scripts here -->
@endsection
