@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <style>
        th{
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>

        <div class="div">
            {{-- <a href="{{ route('admin.khachhang.importFile') }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-file-upload"></i>
                </span>
                <span class="text">Upload file Excel</span>
            </a> --}}
            <form action="{{ route('admin.khachhang.importFile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button type="submit" class="btn btn-success  btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-file-upload"></i>
                    </span>
                <span class="text">Upload file Excel</span>
                </button>
            </form>
            <br>
            <a href="{{ route('admin.khachhang.exportFile') }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-file-download"></i>
                </span>
                <span class="text">Download file Excel</span>
            </a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
            <a href="{{ url('admins/khachhang/trash') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Thùng rác</span>
            </a>
        </div>
    </div>
    @if (session('errors'))
        <div class="text-center alert alert-danger mb-3">
            <span style="color: red">{{ session('errors') }}</span>
        </div>
    @endif
    @if (session('success'))
        <div class="text-center alert alert-success mb-3">
            <span style="color: green">{{ session('success') }}</span>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (count($listUsers) > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Xác thực email </th>
                                {{-- <th>Mật khẩu</th> --}}
                                <th>Chức vụ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Xác thực email </th>
                                {{-- <th>Mật khẩu</th> --}}
                                <th>Chức vụ</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            
                            @foreach ($listUsers as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }} </td>
                                <td>{{ $value->name }} </td>
                                <td>{{ $value->email }} </td>
                                <td>{{ ($value->email_verified_at) ? (new DateTime($value->email_verified_at))->format('d/m/y') : 'Chưa xác thực'  }} </td>
                                {{-- <td>{{ bcrypt($value->password) }} </td> --}}
                                <td>{{ $value->ten_chuc_vu }} </td>

                                <td>
                                    <a href="{{route('admin.users.show', $value->id)}}" class="btn btn-primary">
                                        <span class="icon text-white-50">
                                            <i class="far fa-eye"></i>
                                        </span>
                                    </a>
                                    {{-- <a href="{{ route('admin.users.edit', $value->id) }}"
                                        class="btn btn-warning">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                      
                                    </a> --}}

                                    <form action="{{ route('admin.khachhang.delete') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$value->id }}">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                    {{-- <form action="{{ url('admins/khachhang/delete',$value->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                     
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?!??')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>  
                    {{$listUsers->links("pagination::bootstrap-5")}}
                @else
                    <div class="d-flex justify-content-center align-items-center">
                        <p>Không có khách hàng nào được tìm thấy.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
