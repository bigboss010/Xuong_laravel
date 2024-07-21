@extends('admins.master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
        <br><br>
        <a href="{{ route('users.create') }}"><button type="button" class="btn btn-info">Thêm</button></a>
        {{-- hiển thị thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div><br>
    
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Xác thực email </th>
                            <th scope="col">Mật khẩu</th>
                            <th scope="col">Chức vụ</th>
                            <th scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUsers as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }} </td>
                                <td>{{ $value->name }} </td>
                                <td>{{ $value->email }} </td>
                                <td>{{ (new DateTime($value->email_verified_at))->format('d/m/y') }} </td>
                                <td>{{ bcrypt($value->password) }} </td>
                                <td>{{ $value->ten_chuc_vu }} </td>

                                <td>
                                    <a href="{{ route('users.edit', $value->id) }}"><button type="button"
                                            class="btn btn-warning">Sửa</button></a>
                                    <form action="{{route('users.destroy', $value->id)}}" method="POST">
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
