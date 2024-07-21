<?php

use App\Http\Controllers\Admins\BinhLuanController;
use App\Http\Controllers\Admins\ChucVuController;
use App\Http\Controllers\Admins\CTGioHangController;
use App\Http\Controllers\Admins\TrangThaiDonHangController;
use App\Http\Controllers\Admins\UserController;
use App\Models\ChucVu;
use App\Models\TrangThaiDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\Admins\DonHangController;
use App\Http\Controllers\Admins\GioHangController;
use App\Http\Controllers\Admins\HinhAnhPetController;
use App\Http\Controllers\Admins\PetController;
use App\Http\Controllers\Admins\PhuongThucThanhToanController;
use App\Http\Controllers\ChiTietDonHang;
use App\Http\Controllers\ChiTietDonHangController;
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

Route::get('/', function () {
    return view('master');

});
 Route::resource('users', UserController::class);
 Route::resource('chuc_vus', ChucVuController::class);
 Route::resource('trang_thai_don_hangs', TrangThaiDonHangController::class);
 Route::resource('phuong_thuc_thanh_toans', PhuongThucThanhToanController::class);
 Route::resource('don_hangs', DonHangController::class);
 Route::resource('chi_tiet_don_hangs', ChiTietDonHangController::class);
Route::resource('danh-muc', DanhMucController::class);
Route::resource('pet', PetController::class);
Route::resource('anh-pet', HinhAnhPetController::class);
Route::resource('gio-hang', GioHangController::class);
Route::resource('chi-tiet-gio-hang', CTGioHangController::class);
Route::resource('binh-luan', BinhLuanController::class);
