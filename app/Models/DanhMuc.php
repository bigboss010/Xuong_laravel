<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DanhMuc extends Model
{
    use HasFactory;

    protected $fillable = [
        'hinh_anh',
        'ten_danh_muc',
        'mo_ta'
    ];
    
    public function pet() {
        return $this->hasMany(Pet::class);
    }

    public function getDanhMuc()
    {
        $listDanhmucs = DB::table('danh_mucs')->orderBy('id')->get();
        return $listDanhmucs;
    }

    public function createDanhMuc($data)
    {
        DB::table('danh_mucs')->insert($data);
    }

    public function updateDanhMuc($data, $id)
    {
        DB::table('danh_mucs')->where('id', $id)->update($data);
    }
}
