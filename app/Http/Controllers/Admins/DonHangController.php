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
        $title = "Add đơn hàng";
        $list = $this->users->getList();
        $listPTDH = $this->phuong_thuc_thanh_toan->getList();
        $listTT = $this->trang_thai -> getList();
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
            return redirect()->route('don_hangs.index')->with('success','Thêm thành công');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
