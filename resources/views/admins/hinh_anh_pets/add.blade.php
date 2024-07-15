@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('anh-pet.store') }}" method="POST" class="m-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="link_anh">Hình ảnh:</label>
                    <input type="file" class="form-control-file" id="link_anh" name="link_anh">
                </div>
                <div class="form-group">
                    <label for="pet_id">Tên pet:</label>
                    <select name="pet_id" class="form-control form-select" id="pet_id">
                        <option selected>-- Vui lòng chọn tên pet --</option>
                        @foreach ($petName as $item)
                            <option value="{{ $item->id }}">{{ $item->ten_pet }}</option>
                        @endforeach
                    </select>
                </div>

                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Thêm mới</button>

                <a href="{{ route('anh-pet.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
