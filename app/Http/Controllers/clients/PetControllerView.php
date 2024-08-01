<?php

namespace App\Http\Controllers\clients;

use App\Models\Pet;
use App\Models\DanhMuc;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\BinhLuan;
use App\Models\DonHang;
use App\Models\HinhAnhPet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PetControllerView extends Controller
{
    protected $pet;
    protected $pet_hinhanh;

    public function __construct()
    {
        $this->pet = new Pet();
        //    $this->pet_hinhanh = new HinhAnhPet(); 
    }

    protected function getUniquePetsCount()
    {
        $userId = auth()->id();
        if (!$userId) {
            return 0;
        }
        $cartItems = DB::table('gio_hangs')->where('user_id', $userId)->get();
        $uniquePetIds = [];
        foreach ($cartItems as $item) {
            $pet = Pet::find($item->id);
            if ($pet && !in_array($pet->id, $uniquePetIds)) {
                $uniquePetIds[] = $pet->id;
            }
        }
        return count($uniquePetIds);
    }

    public function index(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet();
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
            $searchResults = $query->get();
            if ($searchResults->isNotEmpty()) {
                return redirect()->route('/.shop', ['search' => $search]);
            } else {
                return view('layouts.clients.index', compact('danhMucs', 'uniquePetsCount', 'search'));
            }
        } else {
            $list = $query->get();
            return view('layouts.clients.index', compact('list', 'danhMucs', 'uniquePetsCount'));
        }
    }

    public function shop(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet();
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
        }
        $list = $query->get();

        return view('layouts.clients.shop', compact('list', 'danhMucs', 'uniquePetsCount', 'search'));
    }


    public function shopSingle(string $id)
    {
        $list = $this->pet->find($id);
        $featuredProducts = $this->pet->take(6)->get(); // Truy xuất danh sách sản phẩm nổi bật
        $uniquePetsCount = $this->getUniquePetsCount();

        return view('layouts.clients.shop-single', compact('list', 'featuredProducts', 'uniquePetsCount'));
    }

    public function addPetToCart(string $id, int $so_luong = 1)
{
    $userId = auth()->id();
    if (!$userId) {
        return redirect()->back()->with('error', 'bạn phải đăng nhập trước khi add');
    }
    $pet = Pet::findOrFail($id);
    $cartKey = 'cart_' . $userId;
    $cart = session()->get($cartKey, []);
    dd($cart[$id]);

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

    $existingCartItem = DB::table('gio_hangs')->where('user_id', $userId)->where('id', $id)->first();
    if ($existingCartItem) {
        DB::table('gio_hangs')->where('user_id', $userId)->where('id', $id)
            ->update(['so_luong' => $existingCartItem->so_luong + $so_luong]);
    } else {
        DB::table('gio_hangs')->insert([
            'id' => $id,
            'user_id' => $userId,
            'so_luong' => $so_luong
        ]);
    }

    session()->put($cartKey, $cart);
    // dd(session()->get($cartKey)); // Kiểm tra giỏ hàng trong session
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

                DB::table('gio_hangs')->where('user_id', $userId)->where('id', $request->id)->delete();
                return response()->json(['success' => 'Xóa pet khỏi giỏ hàng thành công.']);
            }
        }

        return response()->json(['success' => 'Xóa pet khỏi giỏ hàng thành công.']);
    }

    public function showCart()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng');
        }

        $cartKey = 'cart_' . $userId;
        $cartItems = session()->get($cartKey, []);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['gia_pet'] * $item['so_luong'];
        }

        return view('layouts.clients.cart', compact('cartItems', 'total'));
    }


    // public function checkout()
    // {
    //     $userId = auth()->id();
    //     if (!$userId) {
    //         return redirect()->route('login')->with('error', 'Bạn cần đăng nhập rồi mới được thanh toán');
    //     }

    //     $cartKey = 'cart_' . $userId;
    //     $cartItems = session()->get($cartKey, []);
     
    //     $subtotal = 0;
    //     $total = 0;

    //     if (!empty($cartItems)) {
    //         foreach ($cartItems as $item) {
    //             $subtotal += $item['gia_pet'] * $item['so_luong'];
    //         }
    //         $total = $subtotal;
    //     }

    //     return view('layouts.clients.checkout', compact('cartItems', 'subtotal', 'total'));
    // }


    public function showProfile()
    {
        return view('layouts.clients.profile');
    }
    // public function showDonHang()
    // {
    //     $donHangs = Auth::user()->donHang;
    //     return view('layouts.clients.donhang', compact('donHangs'));
    // }

    public function showDetailDonHang($id){
        $donHangDetail = DonHang::query()->findOrFail($id);
        return view('layouts.clients.donhang_detail', compact('donHangDetail'));
    }

    public function shopDog(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet()->where('ten_danh_muc', 'like', "%Chó%");
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
        }
        $list = $query->get();

        return view('layouts.clients.shop-dog', compact('list', 'danhMucs', 'uniquePetsCount', 'search'));
    }
    public function shopCat(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet()->where('ten_danh_muc', 'like', "%Mèo%");
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
        }
        $list = $query->get();

        return view('layouts.clients.shop-dog', compact('list', 'danhMucs', 'uniquePetsCount', 'search'));
    }

    public function send_comment(Request $request)
    {  
        $user_id = $request->user_id;
        $pet_id = $request->pet_id;
        $noi_dung = $request->noi_dung;
        $thoi_gian = Carbon::now();
        $comment = New BinhLuan();  
        $comment->noi_dung = $noi_dung;
        $comment->user_id = $user_id;
        $comment->pet_id = $pet_id;
        $comment->thoi_gian = $thoi_gian;
        $comment->save();
    }

   
}
