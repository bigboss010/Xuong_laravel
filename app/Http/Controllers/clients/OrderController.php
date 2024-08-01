<?php

namespace App\Http\Controllers\clients;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = Auth::user()->donHang;
        return view('layouts.clients.donhang', compact('donHangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng');
        }

        $cartKey = 'cart_' . $userId;
        $cartItems = session()->get($cartKey, []);
        if (!empty($cartItems)) {
            $subtotal = 0;
            $total = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item['gia_pet'] * $item['so_luong'];
            }
            $total = $subtotal;
            return view('layouts.clients.checkout', compact('cartItems', 'subtotal', 'total'));
        } else {
            return redirect()->route('/.cart');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {

        if ($request->isMethod('post')) {

            DB::beginTransaction();
            try {
                $params = $request->except('_token');
                $params['ma_don_hang'] = $this->generateUniqueOrderCode();
                $donHang = DonHang::query()->create($params);
                $donHangId = $donHang->id;
                $carts = session()->get('cart', []);
                foreach ($carts as $key => $item) {
                    $thanhTien = $item['gia'] * $item['so_luong'];
                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $donHangId,
                        'pet_id' => $key,
                        'thanh_tien' => $thanhTien,
                        'gia' => $item['gia'],
                        'so_luong' => $item['so_luong'],
                    ]);
                }
                
                DB::commit();
                session()->put('cart', []);
                return redirect()->route('donhangs.index')->with('success', 'Đơn hàng đã được tạo thành công');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('/.cart')->with('error', 'Có lỗi khi tạo đơn hàng, vui lòng thử lại sau');
            }
          
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
    function generateUniqueOrderCode()
    {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());
        return $orderCode;
    }
}
