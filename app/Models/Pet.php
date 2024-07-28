<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pet extends Model
{
    use HasFactory;
    protected $table ='pets';
    public function getPet()
    {
        $listPets = DB::table('pets')
            ->join('danh_mucs', 'pets.danh_muc_id', '=', 'danh_mucs.id')
            ->select(
                'pets.id',
                'pets.ten_pet',
                'pets.so_luong',
                'pets.gia_pet',
                'pets.gia_khuyen_mai',
                'pets.ngay_nhap',
                'pets.mota',
                'pets.trang_thai',
                'danh_mucs.ten_danh_muc'
            )
            ->orderBy('pets.id')
            ->get();
        return $listPets;
    }

    public function createPet($data)
    {
        DB::table('pets')->insert($data);
    }

    public function updatePet($data, $id)
    {
        DB::table('pets')->where('id', $id)->update($data);
    }
}
