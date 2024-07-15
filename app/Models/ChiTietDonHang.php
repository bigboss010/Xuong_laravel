<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChiTietDonHang extends Model
{
    use HasFactory;

    public function getList()  {
        $list = DB::table('chi_tiet_don_hangs')
        ->join('pets', 'pets.id','=','chi_tiet_don_hangs.pet_id')
        ->join('gio_hangs','gio_hangs.id','=','chi_tiet_don_hangs.gio_hang_id')
        ->select('chi_tiet_don_hangs.*','pets.ten_pet','pets.gia_pet','gio_hangs.user_id')
        ->get();
        return $list;
    }

    public function createChiTietDonHang($data) {
        DB::table('chi_tiet_don_hangs')->insert($data);
    }
}
