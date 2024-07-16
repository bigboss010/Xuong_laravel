@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
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
                    <input type="file" class="form-control-file" id="link_anh" name="link_anh" onchange="showImage(event)">
                    <br>
                    <div class="text-center">
                        <img id="img" src="{{ Storage::url($anhPet->link_anh) }}" alt="Hình ảnh" style="width:150px;">
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

@section('js')
    <script>
        function showImage(event){
            const img = document.getElementById('img');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                img.src = reader.result;
               
            }
            if(file){
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

