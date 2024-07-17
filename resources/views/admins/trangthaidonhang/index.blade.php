@extends('master')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
        <br><br>
        <a href="{{ route('trang_thai_don_hangs.create') }}"><button type="button" class="btn btn-info">Thêm</button></a>
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
                <th scope="col">Tên Trạng Thái</th>
                <th scope="col">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $index => $value)
                <tr>
                    <td>{{ $index + 1 }} </td>
                    <td>{{ $value->ten_trang_thai }} </td>


                    <td>
                        <a href="{{ route('trang_thai_don_hangs.edit', $value->id) }}"><button type="button"
                                class="btn btn-warning">Sửa</button></a>
                        <form action="{{ route('trang_thai_don_hangs.destroy', $value->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href=""><button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?')">Xóa</button></a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
