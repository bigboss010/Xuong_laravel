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
    public function index(DanhMuc $danhMuc) {
        $list = $this->pet->getPet();
        $danhMucs = $danhMuc->getDanhMuc();
        

        return view('layouts.clients.index',compact('list','danhMucs'));
    }
    public function shop(DanhMuc $danhMuc) {
        $list = $this->pet->getPet();
        $danhMucs = $danhMuc->getDanhMuc();

        return view('layouts.clients.shop',compact('list','danhMucs'));
    }
    public function shopSingle(string $id) {
        $list = $this->pet->find($id);
        $featuredProducts = $this->pet->take(6)->get(); // Truy xuất danh sách sản phẩm nổi bật
    
        return view('layouts.clients.shop-single', compact('list', 'featuredProducts'));
    }
}
