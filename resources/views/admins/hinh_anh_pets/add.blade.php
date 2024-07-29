@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.anh-pet.store') }}" method="POST" class="m-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="link_anh">Hình ảnh:</label>
                    <input type="file" class="form-control-file" id="link_anh" name="link_anh"
                        onchange="showImage(event)">
                    <div class="text-center mt-3">
                        <img id="img" src="" alt="Hình ảnh" class="img-thumbnail"
                            style="width:150px; display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="link_anh">Album hình ảnh:</label>
                    <i id="add-row" class="fas fa-plus ml-2" style="cursor: pointer;"></i>
                    <table class="table table-bordered table-hover table-striped mb-0">
                        <tbody id="image-table-body">
                            <tr>
                                <td class="d-flex align-items-center">
                                    <img id="preview_0"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                                        alt="Hình ảnh" style="width:50px;" class="mr-2 img-thumbnail">
                                    <input type="file" class="form-control-file ml-2" id="link_anh"
                                        name="list_hinh_anh[id_0]" onchange="previewImage(this, 0)">
                                </td>
                                <td class="text-center align-middle">
                                    <i class="fas fa-trash" style="cursor: pointer;"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

                <a href="{{ route('admin.anh-pet.index') }}"><button type="button" class="btn btn-info">Danh
                        sách</button></a>
            </form>
        </div>
    </div>
@endsection

@section('js')
   
    {{-- Show hình ảnh --}}
    <script>
        function showImage(event) {
            const img = document.getElementById('img');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                img.src = reader.result;
                img.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    {{-- Thêm album ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;

            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body');

                var newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                            alt="Hình ảnh" style="width:50px;" class="mr-2 img-thumbnail">
                        <input type="file" class="form-control-file ml-2" id="link_anh" name="list_hinh_anh[id_${rowCount}]"
                            onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td class="text-center align-middle">
                        <i class="fas fa-trash" style="cursor: pointer;" onclick="deleteRow(this)"></i>
                    </td>
                `;

                tableBody.appendChild(newRow);
                rowCount++;
            });
        });

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }

        function deleteRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
