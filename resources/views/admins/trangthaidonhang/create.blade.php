@extends('layouts.master')
@section('content')
    <div class="d-sm align-items-center justify-content-between mb-5">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>
  

    <form action="{{route('trang_thai_don_hangs.store')}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        
        

        <div class="form-group" >
            <label for="ten_trang_thai">Tên Trạng thái:</label>
            <input type="text" class="form-control" id="ten_trang_thai" name="ten_trang_thai">
        </div>
        <br>

        <input class="btn btn-outline-warning mr-2" type="submit" value="Add">

        <a href="{{ route('trang_thai_don_hangs.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
