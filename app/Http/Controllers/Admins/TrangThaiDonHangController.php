<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\TrangThaiDonHang;
use Illuminate\Http\Request;

class TrangThaiDonHangController extends Controller
{
    protected $trang_thai_don_hang;

    public function __construct()
    {
        $this->trang_thai_don_hang = new TrangThaiDonHang();
    }
    public function index()
    {
        $title ="Danh sách trạng thái";
        $list = $this->trang_thai_don_hang ->getList();
        return view('admins.trangthaidonhang.index',[
            'title' => $title,
            'list' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ="Danh sách trạng thái";
       
        return view('admins.trangthaidonhang.create',[
            'title' => $title,
         
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
            $this->trang_thai_don_hang->createTrangThai($params);
            return redirect()->route('trang_thai_don_hangs.index')->with('success','Thêm trạng thái mới thành công');
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
