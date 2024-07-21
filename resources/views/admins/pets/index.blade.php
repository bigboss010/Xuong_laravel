@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>

        <a href="{{ route('pet.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
    </div>
    @if (session('errors'))
        <div class="text-center alert alert-danger mb-3">
            <span style="color: red">{{ session('errors') }}</span>
        </div>
    @endif
    @if (session('success'))
        <div class="text-center alert alert-success mb-3">
            <span style="color: green">{{ session('success') }}</span>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($listPets) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Pet</th>
                                <th>Số lượng</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mại</th>
                                <th>Ngày nhập</th>
                                <th>Mô tả</th>
                                <th>Danh mục Pet</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tên Pet</th>
                                <th>Số lượng</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mại</th>
                                <th>Ngày nhập</th>
                                <th>Mô tả</th>
                                <th>Danh mục Pet</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($listPets as $index => $pet)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pet->ten_pet }}</td>
                                    <td>{{ $pet->so_luong }}</td>
                                    <td>{{ $pet->gia_pet }}</td>
                                    <td>{{ $pet->gia_khuyen_mai }}</td>
                                    <td>{{ (new DateTime($pet->ngay_nhap))->format('d/m/Y') }}</td>
                                    <td>{{ $pet->mota }}</td>
                                    <td>{{ $pet->ten_danh_muc }}</td>
                                    <td>{{ $pet->trang_thai }}</td>

                                    <td>
                                        <a href="{{ route('pet.edit', $pet->id) }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Sửa</span>
                                        </a>

                                        <form action="{{ route('pet.destroy', $pet->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Xóa</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có pet nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
