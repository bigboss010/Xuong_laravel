@extends('admins.master')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
        <br><br>
        <a href="{{ route('phuong_thuc_thanh_toans.create') }}"><button type="button" class="btn btn-info">Thêm</button></a>
        {{-- hiển thị thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif
    </div><br>
  
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Phương Thức</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $index=>$value)
                
                    <tr>
                        <td>{{$index +1}}  </td>
                        <td>{{$value->ten_phuong_thuc}}  </td>
                        
                 
                        <td>
                            <a href="{{route('phuong_thuc_thanh_toans.edit', $value->id)}}"><button type="button"
                                    class="btn btn-warning">Sửa</button></a>
                            <form action="{{route('phuong_thuc_thanh_toans.destroy', $value->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <a href=""><button type="submit"
                                    class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?')">Xóa</button></a>
                            </form>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
   
@endsection