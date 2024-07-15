<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    protected $chuc_vu;

    public function __construct()
    {
        $this->chuc_vu = new ChucVu();
    }
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->chuc_vu ->getList();
        $title = "Danh Sách chức vụ";
        return view('admins.chucvu.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = $this->chuc_vu ->getList();
        $title = "Add chức vụ";
      
        return view('admins.chucvu.create',compact('title','list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $params = $request->post();
            unset($params['_token']);

            $this->chuc_vu->createChucVu($params);
            return redirect()->route('chuc_vus.index')->with('success','Thêm sản phẩm thành công');
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
