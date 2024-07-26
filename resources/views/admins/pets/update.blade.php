@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.pet.update', $pet->id) }}" method="POST" class="m-3">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="ten_pet">Tên pet:</label>
                    <input type="text" class="form-control" id="ten_pet" name="ten_pet" value="{{ $pet->ten_pet }}">
                </div>
                <div class="form-group">
                    <label for="danh_muc_id">Tên danh mục:</label>
                    <select name="danh_muc_id" class="form-control form-select" id="danh_muc_id">
                        <option selected>-- Vui lòng chọn danh mục --</option>
                        @foreach ($danhMucs as $item)
                            <option {{ $pet->danh_muc_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="so_luong">Số lượng:</label>
                    <input type="number" class="form-control" min="1" id="so_luong" name="so_luong"
                        value="{{ $pet->so_luong }}">
                </div>
                <div class="form-group">
                    <label for="gia_pet">Giá gốc:</label>
                    <input type="text" class="form-control" id="gia_pet" name="gia_pet" value="{{ $pet->gia_pet }}">
                </div>
                <div class="form-group">
                    <label for="gia_khuyen_mai">Giá khuyến mại:</label>
                    <input type="text" class="form-control" id="gia_khuyen_mai" name="gia_khuyen_mai"
                        value="{{ $pet->gia_khuyen_mai }}">
                </div>
                <div class="form-group">
                    <label for="ngay_nhap">Ngày nhập:</label>
                    <input type="date" class="form-control" id="ngay_nhap" name="ngay_nhap"
                        value="{{ $pet->ngay_nhap }}">
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả:</label>
                    <textarea class="form-control" name="mota" id="mota" cols="30" rows="3">{{ $pet->mota }}</textarea>
                </div>
                <div class="form-group">
                    <label for="trang_thai">Trạng thái:</label>
                    <input type="text" class="form-control" id="trang_thai" name="trang_thai"
                        value="{{ $pet->trang_thai }}">
                </div>


                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Sửa</button>

                <a href="{{ route('admin.pet.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
