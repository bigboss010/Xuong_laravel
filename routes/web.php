<?php

use App\Http\Controllers\Admins\ChucVuController;
use App\Http\Controllers\Admins\TrangThaiDonHangController;
use App\Http\Controllers\Admins\UserController;
use App\Models\ChucVu;
use App\Models\TrangThaiDonHang;
use Illuminate\Support\Facades\DB;
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