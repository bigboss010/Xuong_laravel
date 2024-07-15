<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BinhLuan extends Model
{
    use HasFactory;

    public function getBinhluan()
    {
        $binhLuans = DB::table('binh_luans as bl')
            ->join('users', 'bl.user_id', '=', 'users.id')
            ->join('pets', 'bl.pet_id', '=', 'pets.id')
            ->select(
                'bl.id',
                'bl.noi_dung',
                'bl.thoi_gian',
                'bl.trang_thai',
                'bl.created_at',
                'bl.updated_at',
                'users.name',
                'pets.ten_pet'
            )
            ->orderBY('bl.id')
            ->get();
        return $binhLuans;
    }

    public function createBL($data)
    {
        DB::table('binh_luans')->insert($data);
    }
}
