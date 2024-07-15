@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>

        <a href="{{ route('gio-hang.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>
    </div>
    @if (isset($_SESSION['errors']))
        <div class="text-center mb-3">
            <span style="color: red">{{ $_SESSION['errors'] }}</span>
        </div>
    @endif
    @if (isset($_SESSION['success']))
        <div class="text-center mb-3">
            <span style="color: green">{{ $_SESSION['success'] }}</span>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($gioHangs) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($gioHangs as $index => $gioHang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $gioHang->name }}</td>
                                    <td>{{ $gioHang->email }}</td>
                                    <td>{{ (new DateTime($gioHang->created_at))->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ (new DateTime($gioHang->updated_at))->format('d/m/Y H:i:s') }}</td>


                                    <td>
                                        <a href="{{ route('gio-hang.edit', $gioHang->id) }}"
                                            class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Sửa</span>
                                        </a>

                                        <form action="{{ route('gio-hang.destroy', $gioHang->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Xóa</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có giỏ hàng nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
