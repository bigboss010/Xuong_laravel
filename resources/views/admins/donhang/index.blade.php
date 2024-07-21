@extends('admins.master')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
        <br><br>
        <a href="{{ route('don_hangs.create') }}"><button type="button" class="btn btn-info">Thêm</button></a>
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
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">ID tài khoản</th>
                    <th scope="col">Tên người nhận</th>
                    <th scope="col">Email người nhận</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Ngày đặt</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Phương thức thanh toán</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $index=>$value)
                
                    <tr>
                        <td>{{$index +1}}  </td>
                        <td>{{$value->ma_don_hang}}  </td>
                        <td>{{$value->tai_khoan_id }}  </td>
                        <td>{{$value->ten_nguoi_nhan}}  </td>
                        <td>{{$value->email_nguoi_nhan}}  </td>
                        <td>{{$value->so_dien_thoai_nguoi_nhan}}  </td>
                        <td>{{$value->dia_chi_nguoi_nhan}}  </td>
                        <td>{{(new DateTime($value->ngay_dat))->format('d-m-y')}}  </td>
                        <td>{{$value->tong_tien}}  </td>
                        <td>{{$value->ghi_chu}}  </td>
                        <td>{{$value->ten_phuong_thuc }}  </td>
                        <td>{{$value->ten_trang_thai  }}  </td>
                        
                 
                        <td>
                            <a href="{{route('don_hangs.edit', $value->id)}}"><button type="button"
                                    class="btn btn-warning">Sửa</button></a>
                            <form action="{{route('don_hangs.destroy', $value->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?')">Xóa</button></a>
                            </form>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
   
@endsection