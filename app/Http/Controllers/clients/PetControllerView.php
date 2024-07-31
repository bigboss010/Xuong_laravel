<?php

namespace App\Http\Controllers\clients;

use App\Models\Pet;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HinhAnhPet;

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
    $pet = Pet::findOrFail($id);
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['so_luong'] += $so_luong; // Tăng số lượng tùy chỉnh
    } else {
        $cart[$id] = [
            'ten_pet' => $pet->ten_pet,
            'gia_pet' => $pet->gia_pet,
            'so_luong' => $so_luong, // Đặt số lượng tùy chỉnh
            'image' => $pet->image
        ];
    }
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Thêm pet vào giỏ hàng thành công');
}


    
        public function showCart()
{
    $list = session()->get('cart', []);
    $total = array_reduce($list, function($sum, $item) {
        return $sum + ($item['gia_pet'] * $item['so_luong']);
    }, 0);

    return view('layouts.clients.cart', compact('list','total'));
}
      
    
    public function deletePetCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
              
            }
        }
        session()->flash('success', 'Xóa pet khỏi giỏ hàng thành công.');
    }
    
   
}
