<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use App\Models\KhachHang;
use App\Models\Pet;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    public $binhLuans;

    public function __construct()
    {
        $this->binhLuans = new BinhLuan();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách bình luận';
        $binhLuans = $this->binhLuans->getBinhluan();
        return view('admins.binh_luans.index', compact('title', 'binhLuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(KhachHang $users, Pet $pets)
    {
        $title = 'Thêm mới bình luận';
        $users = $users->getListHD();
        $pets = $pets->getPet();
        return view('admins.binh_luans.add', compact('title', 'users', 'pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = [
                'user_id' => $request->user_id,
                'pet_id' => $request->pet_id,
                'noi_dung' => $request->noi_dung,
                'thoi_gian' => $request->thoi_gian,
                'trang_thai' => $request->trang_thai,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ];
            $this->binhLuans->createBL($data);
            return redirect()->route('admin.binh-luan.index')->with('success', 'Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, KhachHang $users, Pet $pets)
    {
        $title = 'Sửa bình luận';
        $binhLuan = $this->binhLuans->find($id);
        if(!$binhLuan){
            return redirect()->route('binh-luan.index')->with('errors', 'Bình luận này không tồn tại!');
        }
        $users = $users->getList();
        $pets = $pets->getPet();
        return view('admins.binh_luans.update', compact('title', 'binhLuan', 'users', 'pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('PUT')){
            $data = [
                'user_id' => $request->user_id,
                'pet_id' => $request->pet_id,
                'noi_dung' => $request->noi_dung,
                'thoi_gian' => $request->thoi_gian,
                'trang_thai' => $request->trang_thai,
                'updated_at' => Carbon::now()
            ];
            $this->binhLuans->updateBL($data, $id);
            return redirect()->route('admin.binh-luan.index')->with('success', 'Sửa thành công!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $binhLuan = $this->binhLuans->find($id);
        if(!$binhLuan){
            return redirect()->route('binh-luan.index')->with('errors', 'Bình luận này không tồn tại!');
        }
        $binhLuan->delete();
        return redirect()->route('admin.binh-luan.index')->with('success', 'Xóa thành công!');
    }
}
