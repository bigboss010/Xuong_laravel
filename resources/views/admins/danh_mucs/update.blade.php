@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('danh-muc.update', $danhMuc->id) }}" method="POST" class="m-3"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="hinh_anh">Hình ảnh:</label>
                    <input type="file" class="form-control-file" id="hinh_anh" name="hinh_anh"
                        value="{{ $danhMuc->hinh_anh }}">
                    <div class="text-center">
                        <img src="{{ Storage::url($danhMuc->hinh_anh) }}" alt="{{ $danhMuc->hinh_anh }}" class="w-25">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ten_danh_muc">Tên danh mục:</label>
                    <input type="text" class="form-control" id="ten_danh_muc" name="ten_danh_muc"
                        value="{{ $danhMuc->ten_danh_muc }}">
                </div>
                <div class="form-group">
                    <label for="mo_ta">Mô tả:</label>
                    <textarea class="form-control" name="mo_ta" id="mo_ta" cols="30" rows="3">{{ $danhMuc->mo_ta }}</textarea>
                </div>


                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Sửa</button>

                <a href="{{ route('danh-muc.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
