@extends('master')
@section('content')
    <div class="d-sm align-items-center justify-content-between mb-5">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>
  

    <form action="{{route('phuong_thuc_thanh_toans.update',$list->id )}}" class="mt-5" method="POST">
        {{-- Làm việc với form trong laravel --}}

        {{-- 
            CSRF field: là một trường ẩn bắt buộc phải có trong form khi sử dụng laravel 
        --}}
        {{-- cái này đặt ở đâu cũng được miễn là trong thẻ form --}}
        @csrf
        @method('put')
        

        <div class="form-group" >
            <label for="ten_phuong_thuc">Tên Phương thức thanh toán:</label>
            <input type="text" class="form-control" id="ten_phuong_thuc" name="ten_phuong_thuc" value="{{$list->ten_phuong_thuc}}">
        </div>
        <br>

        <input class="btn btn-outline-warning mr-2" type="submit" value="Update">

        <a href="{{ route('phuong_thuc_thanh_toans.index') }}"><button type="button" class="btn btn-info">Danh sách</button></a>
    </form>
@endsection
