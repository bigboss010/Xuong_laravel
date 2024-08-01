<?php

use App\Http\Controllers\Admins\BinhLuanController;
use App\Http\Controllers\Admins\ChucVuController;
use App\Http\Controllers\Admins\CTGioHangController;
use App\Http\Controllers\Admins\TrangThaiDonHangController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\Admins\DonHangController;
use App\Http\Controllers\Admins\GioHangController;
use App\Http\Controllers\Admins\HinhAnhPetController;
use App\Http\Controllers\Admins\PetController;
use App\Http\Controllers\Admins\PhuongThucThanhToanController;
use App\Http\Controllers\Admins\ChiTietDonHangController;
use App\Http\Controllers\Admins\DashBoardController;
use App\Http\Controllers\Admins\ProfileController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\clients\PetControllerView;
use App\Models\DonHang;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthenController::class, 'login'])->name('login');
Route::post('/login', [AuthenController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenController::class, 'logout'])->name('logout');
Route::get('/register', [AuthenController::class, 'register'])->name('register');
Route::post('/postRegister', [AuthenController::class, 'postRegister'])->name('postRegister');
// Route::get('/auth', [AuthenController::class, 'getAuth'])->name('auth');


Route::get('admins/khachhang/trash', [UserController::class, 'trash']);
Route::post('admins/khachhang/delete', [UserController::class, 'delete'])->name('admin.khachhang.delete');
Route::post('admins/khachhang/restore', [UserController::class, 'restore'])->name('admin.khachhang.restore');
Route::get('admins/donhang/trash', [DonHangController::class, 'trash']);
Route::post('admins/donhang/delete', [DonHangController::class, 'delete'])->name('admin.donhang.delete');
Route::post('admins/donhang/restore', [DonHangController::class, 'restore'])->name('admin.donhang.restore');
Route::get('admins/donhang/trash', [DonHangController::class, 'trash']);
Route::post('admins/danh-mucs/delete', [DanhMucController::class, 'delete'])->name('admin.danh-mucs.delete');
Route::post('admins/danh-mucs/restore', [DanhMucController::class, 'restore'])->name('admin.danh-mucs.restore');
Route::get('admins/danh-mucs/trash', [DanhMucController::class, 'trash']);
Route::post('admins/pets/delete', [PetController::class, 'delete'])->name('admin.pets.delete');
Route::post('admins/pets/restore', [PetController::class, 'restore'])->name('admin.pets.restore');
Route::get('admins/pets/trash', [PetController::class, 'trash']);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'checkAdmin'
], function () {
    Route::resource('/', DashBoardController::class);
    Route::resource('users', UserController::class);
    Route::resource('chuc_vus', ChucVuController::class);
    Route::resource('trang_thai_don_hangs', TrangThaiDonHangController::class);
    Route::resource('phuong_thuc_thanh_toans', PhuongThucThanhToanController::class);
    Route::resource('don_hangs', DonHangController::class);
    Route::resource('chi_tiet_don_hangs', ChiTietDonHangController::class);
    Route::resource('danh-muc', DanhMucController::class);
    Route::resource('pet', PetController::class);
    Route::resource('gio-hang', GioHangController::class);
    Route::resource('chi-tiet-gio-hang', CTGioHangController::class);
    Route::resource('binh-luan', BinhLuanController::class);
    Route::resource('profile', ProfileController::class);
});

Route::group([
    'prefix' => '/',
    'as' => '/.'
], function () {
    Route::get('/', [PetControllerView::class, 'index'])->name('index');
    Route::get('/shop', [PetControllerView::class, 'shop'])->name('shop');
    Route::get('/shop-single/{id}', [PetControllerView::class, 'shopSingle'])->name('shop-single');
    // Route::get('/add-to-cart/{id}/{so_luong}', [PetControllerView::class, 'addPetToCart'])->name('addPetToCart');
    // Route::get('/shop-cart', [PetControllerView::class, 'showCart'])->name('cart');
    // Route::delete('/delete-pet-cart', [PetControllerView::class, 'deletePetCart'])->name('delete.pet.cart');
    Route::get('/add-to-cart/{id}/{so_luong}', [PetControllerView::class, 'addPetToCart'])->name('addPetToCart');
    Route::get('/shop-cart', [PetControllerView::class, 'showCart'])->name('cart');
    Route::delete('/delete-pet-cart', [PetControllerView::class, 'deletePetCart'])->name('delete.pet.cart');

    Route::get('/profile', [PetControllerView::class, 'showProfile'])->name('profile');
    Route::get('/donhang', [PetControllerView::class, 'showDonHang'])->name('donhang');
    Route::post('/binh-luan', [BinhLuanController::class, 'load_comment'])->name('load_comment');
    Route::post('/send-binh-luan', [PetControllerView::class, 'send_comment'])->name('send_comment');
    Route::get('/shop-dog', [PetControllerView::class, 'shopDog'])->name('dog');
    Route::get('/shop-cat', [PetControllerView::class, 'shopCat'])->name('cat');


    Route::get('/checkout', function () {
        return view('layouts.clients.checkout');
    })->name('checkout');
});
