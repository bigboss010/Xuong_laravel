<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang as ModelsChiTietDonHang;
use App\Models\GioHang;
use App\Models\Pet;
use Illuminate\Http\Request;

class ChiTietDonHang extends Controller
{
    protected $ct_don_hang;
    public $pets;
    public $gioHangs;

    public function __construct()
    {
        $this->ct_don_hang = new ModelsChiTietDonHang();
        $this->pets = new Pet();
        $this->gioHangs = new GioHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách chi tiết đơn hàng";
        $list = $this->ct_don_hang->getList();
        return view('admins.chitietdonhang.index',[
            'title'=>$title,
            'list'=>$list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add chi tiết đơn hàng";
        $listP = $this->pets->getPet();
        $listGH = $this->gioHangs->getGioHang();
        return view('admins.chitietdonhang.create',[
            'title'=>$title,
            'listP'=>$listP,
            'listGH'=>$listGH,
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
            $this->ct_don_hang->createChiTietDonHang($params);
            return redirect()->route('chi_tiet_don_hangs.index')->with('success','Thêm thành công');
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
