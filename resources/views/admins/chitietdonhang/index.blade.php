@extends('master')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
        <br><br>
        <a href="{{ route('chi_tiet_don_hangs.create') }}"><button type="button" class="btn btn-info">Thêm</button></a>
        {{-- hiển thị thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div><br>
  
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID giỏ</th>
                    <th scope="col">Chó</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $index=>$value)
                    @php
                        $value->thanh_tien = $value->so_luong * $value->gia;
                    @endphp
                    <tr>
                        <td>{{$index +1}}  </td>
                        <td>{{$value->user_id}}  </td>
                        <td>{{$value->user_id}}  </td>
                        <td>{{$value->so_luong}}  </td>
                        <td>{{$value->gia}}  </td>
                        <td>{{$value->thanh_tien}}  </td>
                 
                        <td>
                            <a href=""><button type="button"
                                    class="btn btn-warning">Sửa</button></a>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
   
@endsection