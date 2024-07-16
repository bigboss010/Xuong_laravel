<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KhachHang extends Model
{
    use HasFactory;

    public function getList()
    {
        $listUsers = DB::table('users')
            ->join('chuc_vus', 'users.chuc_vu_id', '=', 'chuc_vus.id')
            ->select('users.*', 'chuc_vus.ten_chuc_vu')
            ->orderBy('users.id')
            ->get();
        return $listUsers;
    }

    public function createUser($data){
        DB::table('users')->insert($data);
    }
    public function updateUser($data, $id){
        DB::table('users')->where('id',$id)->update($data);
    }
    public function deleteUser($id) {
        DB::table('users')->where('id',$id)->delete();
    }
}
