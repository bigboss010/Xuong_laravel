@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('chi-tiet-gio-hang.store') }}" method="POST" class="m-3">
                @csrf
                <div class="form-group">
                    <label for="gio_hang_id">Tên tài khoản:</label>
                    <select name="gio_hang_id" class="form-control form-select" id="gio_hang_id">
                        <option selected>-- Vui lòng chọn tên tài khoản --</option>
                        @foreach ($gioHangs as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pet_id">Tên pet:</label>
                    <select name="pet_id" class="form-control form-select" id="pet_id">
                        <option selected>-- Vui lòng chọn tên pet --</option>
                        @foreach ($pets as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_pet }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="so_luong">Số lượng:</label>
                    <input type="number" class="form-control" min="1" id="so_luong" name="so_luong">
                </div>

                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Thêm mới</button>

                <a href="{{ route('chi-tiet-gio-hang.index') }}"><button type="button" class="btn btn-info">Danh
                        sách</button></a>
            </form>
        </div>
    </div>
@endsection