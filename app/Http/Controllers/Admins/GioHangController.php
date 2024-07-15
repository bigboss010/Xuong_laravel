<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\GioHang;
use App\Models\KhachHang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
    public $gioHangs;

    public function __construct()
    {
        $this->gioHangs = new GioHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách giỏ hàng';
        $gioHangs = $this->gioHangs->getGioHang();
        return view('admins.gio_hangs.index', compact('title', 'gioHangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(KhachHang $users)
    {
        $title = 'Thêm mới giỏ hàng';
        $users = $users->getList();
        return view('admins.gio_hangs.add', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = [
                'user_id' => $request->user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $this->gioHangs->createGioHang($data);
            return redirect()->route('gio-hang.index');
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
