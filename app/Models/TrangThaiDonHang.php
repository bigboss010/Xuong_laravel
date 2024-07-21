<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrangThaiDonHang extends Model
{
    use HasFactory;

    public function getList()  {
        $list = DB::table('trang_thai_don_hangs')->get();
        return $list;
    }

    public function createTrangThai($data){
        DB::table('trang_thai_don_hangs')->insert($data);
    }

    public function updateTrangThai($data, $id){
        DB::table('trang_thai_don_hangs')->where('id',$id)->update($data);
    }
}
