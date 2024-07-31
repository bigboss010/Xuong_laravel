<?php

namespace App\Http\Controllers\clients;

use App\Models\Pet;
use App\Models\DanhMuc;
use App\Models\HinhAnhPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PetControllerView extends Controller
{
    protected $pet;
    protected $pet_hinhanh;
    public function __construct()
    {
        $this->pet = new Pet();
        //    $this->pet_hinhanh = new HinhAnhPet(); 
    }
    public function index(DanhMuc $danhMuc)
    {
        $list = $this->pet->getPet();
        $danhMucs = $danhMuc->getDanhMuc();


        return view('layouts.clients.index', compact('list', 'danhMucs'));
    }
    public function shop(DanhMuc $danhMuc)
    {
        $list = $this->pet->getPet();
        $danhMucs = $danhMuc->getDanhMuc();

        return view('layouts.clients.shop', compact('list', 'danhMucs'));
    }
    public function shopSingle(string $id)
    {
        $list = $this->pet->find($id);
        $featuredProducts = $this->pet->take(6)->get(); // Truy xuất danh sách sản phẩm nổi bật
        return view('layouts.clients.shop-single', compact('list', 'featuredProducts'));
    }
    public function addPetToCart(string $id, int $so_luong = 1)
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->back()->with('error', 'You need to be logged in to add items to the cart');
        }
        $pet = Pet::findOrFail($id);
        $cartKey = 'cart_' . $userId;
        $cart = session()->get($cartKey, []);

        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] += $so_luong;
        } else {
            $cart[$id] = [
                'ten_pet' => $pet->ten_pet,
                'gia_pet' => $pet->gia_pet,
                'so_luong' => $so_luong,
                'image' => $pet->image
            ];
        }
        $existingCartItem = DB::table('gio_hangs')
            ->where('user_id', $userId)
            ->where('id', $id)
            ->first();

        if ($existingCartItem) {
            DB::table('gio_hangs')
                ->where('user_id', $userId)
                ->where('id', $id)
                ->update(['so_luong' => $existingCartItem->so_luong + $so_luong]);
        } else {
            DB::table('gio_hangs')->insert([
                'id' => $id,
                'user_id' => $userId,
                'so_luong' => $so_luong
            ]);
        }
        session()->put($cartKey, $cart);
        return redirect()->back()->with('success', 'Thêm pet vào giỏ hàng thành công');
    }
    public function deletePetCart(Request $request)
    {
        $userId = auth()->id(); 
        if (!$userId) {
            return response()->json(['error' => 'You need to be logged in to modify the cart'], 403);
        }
        if ($request->id) {
            $cartKey = 'cart_' . $userId; 
            $cart = session()->get($cartKey, []);
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]); 
                session()->put($cartKey, $cart); 

                DB::table('gio_hangs')
                    ->where('user_id', $userId)
                    ->where('id', $request->id)
                    ->delete();
            }
        }

        return response()->json(['success' => 'Xóa pet khỏi giỏ hàng thành công.']);
    }

    public function showCart()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view the cart');
        }
        $cartItems = DB::table('gio_hangs')
            ->where('user_id', $userId)
            ->get();
        $list = [];
        foreach ($cartItems as $item) {
            $pet = Pet::find($item->id); 
            if ($pet) {
                $list[$item->id] = [
                    'ten_pet' => $pet->ten_pet,
                    'gia_pet' => $pet->gia_pet,
                    'so_luong' => $item->so_luong,
                    'image' => $pet->image
                ];
            }
        }
        $total = array_reduce($list, function ($sum, $item) {
            return $sum + ($item['gia_pet'] * $item['so_luong']);
        }, 0);  
        return view('layouts.clients.cart', compact('list', 'total'));
    }
    


    public function showProfile()
    {
        return view('layouts.clients.profile');
    }
}
