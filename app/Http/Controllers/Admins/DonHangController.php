<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\KhachHang;
use App\Models\PhuongThucThanhToan;
use App\Models\TrangThaiDonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    protected $users;
    protected $don_hang;
    protected $phuong_thuc_thanh_toan;
    protected $trang_thai;

    public function __construct()
    {
        $this->don_hang = new DonHang();
        $this->users = new KhachHang();
        $this->phuong_thuc_thanh_toan = new PhuongThucThanhToan();
        $this->trang_thai = new TrangThaiDonHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách đơn hàng";
        $list=$this->don_hang->getDH();
        return view('admins.donhang.index',[
            'title' => $title,
            'list' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới đơn hàng";
        $list = $this->users->getListHD();
        $listPTDH = $this->phuong_thuc_thanh_toan->getList();
        $listTT = $this->trang_thai->getList();
        return view('admins.donhang.create',[
            'title' => $title,
            'list' => $list,
            'listPTDH' => $listPTDH,
            'listTT' => $listTT
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $params = $request->post();
            unset($params['_token']);
            $this->don_hang->createDonHang($params);
            return redirect()->route('admin.don_hangs.index')->with('success','Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $title = "Thông tin đơn hàng";
    $order = $this->don_hang->with(['khachHang', 'phuongThucThanhToan', 'trangThai'])->find($id);

    if (!$order) {
        return redirect()->route('admin.don_hangs.index')->with('error', 'Đơn hàng không tồn tại.');
    }

    return view('admins.donhang.show', [
        'title' => $title,
        'order' => $order
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, KhachHang $khachHang, PhuongThucThanhToan $PhuongThucThanhToan, TrangThaiDonHang $trangThaiDonHang) 
    {
        $title="Sửa đơn hàng";
        $list = $this->don_hang->find($id);
        $khachHangs = $khachHang->getListHD();
        $PhuongThucThanhToans = $PhuongThucThanhToan->getList();
        $TrangThaiDonHangs = $trangThaiDonHang->getList();

        if(!$list){
            return redirect()->route('admin.don_hangs.index')->with('errors','Không có đơn hàng này!');
        }
        return view('admins.donhang.update',[
            'list'=>$list,
            'title'=>$title,
            'khachHangs'=>$khachHangs,
            'PhuongThucThanhToans'=>$PhuongThucThanhToans,
            'TrangThaiDonHangs'=>$TrangThaiDonHangs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('PUT')){
            $data = $request->except('_token','_method');
            $this->don_hang->updateDonHang($data,$id);
            return redirect()->route('admin.don_hangs.index')->with('success','Sửa thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = $this->don_hang->find($id);
        $list->delete();
        return redirect()->route('admin.don_hangs.index')->with('success','Xóa thành công!');

    }
}
