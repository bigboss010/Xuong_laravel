<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhuongThucThanhToan extends Model
{
    use HasFactory;

    public function getList(){
        $list = DB::table('phuong_thuc_thanh_toans')->get();
        return $list;
    }

    public function createPhuongThuc($data) {
        DB::table('phuong_thuc_thanh_toans')->insert($data);
    }
}
