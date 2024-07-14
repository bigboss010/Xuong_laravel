@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">Danh sách danh mục</h1>
            <p class="mb-4">
                Danh mục
                <a target="_blank" href="https://datatables.net">Admin</a>.
            </p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('anh-pet.update', $anhPet->id) }}" method="POST" class="m-3"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="link_anh">Hình ảnh:</label>
                    <input type="file" class="form-control-file" id="link_anh" name="link_anh">
                    <div class="text-center">
                        <img src="{{ Storage::url($anhPet->link_anh) }}" alt="{{ $anhPet->link_anh }}" class="w-20">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pet_id">Tên pet:</label>
                    <select name="pet_id" class="form-control form-select" id="pet_id">
                        <option selected>-- Vui lòng chọn tên pet --</option>
                        @foreach ($petName as $item)
                            <option {{ $anhPet->pet_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->ten_pet }}</option>
                        @endforeach
                    </select>
                </div>

                <br>
                <button type="submit" class="btn btn-outline-success mr-2">Sửa</button>

                <a href="{{ route('anh-pet.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
            </form>
        </div>
    </div>
@endsection
